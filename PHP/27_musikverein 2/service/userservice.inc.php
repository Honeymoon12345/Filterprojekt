<?php
class UserService 
{
    private PDO $conn;
    public function __construct(PDO $conn)
    {
        $this->conn = $conn; 
    }


    // Erstellt einen neuen User in der Datenbank
    // Gibt die ID des Users zurück
    public function createUser(string $firstname, string $lastname, 
                                string $email, string $password, 
                                DateTime $birthdate, bool $is_admin) : int 
    {
        $ps = $this->conn->prepare('
            INSERT INTO user 
            (firstname, lastname, email, password, is_admin, birthdate) 
            VALUES 
            (:firstname, :lastname, :email, :password, :is_admin, :birthdate)
        ');
        $ps->bindValue('firstname', $firstname);
        $ps->bindValue('lastname', $lastname);
        $ps->bindValue('email', $email);

        // Password nur als HASH in die Datenbank speichern!
        $ps->bindValue('password', password_hash($password, PASSWORD_DEFAULT));

        $ps->bindValue('is_admin', $is_admin);

        // birthdate muss im Format, das für die DB verständlich ist, übertragen werden
        $ps->bindValue('birthdate', $birthdate->format('Y-m-d'));

        $ps->execute();

        // ID des neuen Users ermitteln
        $userId = $this->conn->lastInsertId();

        // Bestätigungsmail an den neuen User senden
        $mailTo = $email;
        $mailSubject = 'Herzlich willkommen!';
        $mailMessage = "Lieber $firstname $lastname! Wir freuen uns darauf mit dir musizieren zu dürfen!";
        mail($mailTo, $mailSubject, $mailMessage);

        // ID des neuen users zurückgeben
        return $userId;
    }


    // Liest alle User aus der Datenbank aus und gibt sie als Array der Klasse 
    // User zurück 
    public function getUsers() : array 
    {
        $ps = $this->conn->prepare('
            SELECT * 
            FROM user 
        ');
        $ps->execute();

        // Array definieren in dem alle gefundenen User als Objekt der Klasse User
        // gespeichert werden
        $users = []; 

        // Schleife in der wir über jeden gefundenen Datensatz iterieren
        while($row = $ps->fetch())
        {
            $birthdate = DateTime::createFromFormat('Y-m-d', $row['birthdate']);
            // aus einem Datensatz ein Objekt erzeugen
            $users[] = new User($row['id'], $row['firstname'], $row['lastname'],
                                $row['email'], $row['password'], $birthdate, 
                                $row['is_admin']);
        }
        return $users; 
    }


    public function getUserById(int $id) : User|false 
    {
        $ps = $this->conn->prepare('
            SELECT * 
            FROM user 
            WHERE id = :id 
        ');
        $ps->bindValue('id', $id);
        $ps->execute();
        while($row = $ps->fetch()){
            $birthdate = DateTime::createFromFormat('Y-m-d', $row['birthdate']);
            // aus einem Datensatz ein Objekt erzeugen
            $user = new User($row['id'], $row['firstname'], $row['lastname'],
                                $row['email'], $row['password'], $birthdate, 
                                $row['is_admin']);
            return $user;
        }
        // wenn kein User mit der ID gefunden wurde 
        return false;
    }


    // Gibt User als Objekt der Klasse User zurück
    // Sucht User mit übergebener Email in der Datenbank und holt
    // User aus der Datenbank
    // Gibt Objekt der Klasse User zurück oder false falls User nicht gefunden wurde 
    public function getUserByEmail(string $email) : User|false 
    {
        // finde user-id für email
        $ps = $this->conn->prepare('
            SELECT id 
            FROM user 
            WHERE email = :email 
        ');
        $ps->bindValue('email', $email);
        $ps->execute();
        while($row = $ps->fetch()){
            // user id gefunden!
            $userId = $row['id'];

            // finde User anhand der ID
            $user = $this->getUserById($userId);

            // Gebe Objekt der Klasse User oder false (falls nicht gefunden) zurück
            return $user;
        }
        // User anhand email nicht gefunden, false zurückgeben
        return false;
    }


    // Meldet einen User am System an.
    // Gibt true zurück wenn login erfolgreich, ansonsten false
    public function login(string $email, string $password) : bool 
    {
        // finde User anhand der E-Mail
        $user = $this->getUserByEmail($email);

        // wurde User gefunden?
        if($user !== FALSE){
            // Passwort überprüfen
            if(password_verify($password, $user->password)){
                // Alles OK! Am System anmelden

                // User-ID in der Session speichern
                $_SESSION['logged_in_user_id'] = $user->id; 

                // Login erfolgreich, true zurückgeben
                return true; 
            }
        }

        // Login fehlgeschlagen
        return false;
    }


    // Gibt true zurück wenn User angemeldet ist, ansonsten false 
    public function isLoggedIn() : bool {
        if(isset($_SESSION['logged_in_user_id']) && $_SESSION['logged_in_user_id'] != 0){
            return true;
        }
        return false; 
    }


    // Gibt den angemeldeten User als Objekt der Klasse User zurück, 
    // Falls nicht angemeldet wird false zurückgegeben 
    public function getLoggedInUser() : User|false 
    {
        if($this->isLoggedIn()){
            $userId = $_SESSION['logged_in_user_id'];
            return $this->getUserById($userId);
        }
        return false; 
    }


    // Loggt den aktuellen User aus
    public function logout() {
        $_SESSION['logged_in_user_id'] = 0;
        // lösche die Session
        session_destroy();
    }


    // Leitet den User zum Login weiter wenn User nicht angemeldet ist
    public function redirectIfNotLoggedIn(){
        // falls nicht angemeldet ... 
        if(!$this->isLoggedIn())
        {
            header('Location: ./login.php?require_login=true');
            exit();
        }
    }


    // Leitet den User zur Startweite weiter wenn User nicht angemeldet oder nicht Admin ist. 
    public function redirectIfNotAdmin(){
        // falls nicht angemeldet oder nicht Admin
        if(!$this->isLoggedIn() || $this->getLoggedInUser()->is_admin == false)
        {
            header('Location: ./index.php?require_admin=true');
            exit();
        }
    }


    // Auswertung: Wie viele Mitglieder sind jünger als 18 Jahre? 
    public function getNumberOfUsersAgedBelow18() : int {
        // suche User die jünger als 18 Jahre sind
        $ps = $this->conn->prepare('
        SELECT *, TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) AS age 
        FROM user 
        HAVING age < 18
        ');
        $ps->execute();

        // Zähle wie viele Ergebnisse es gab
        $counter = 0;
        while($row = $ps->fetch()){
            // für jeden gefundenen User den Counter erhöhen
            $counter++;
        }
        return $counter;
    }


    // Auswertung: Zeigen Sie das durchschnittliche Alter aller Mitglieder?
    public function getAverageUserAge() : float {
        $ps = $this->conn->prepare('
            SELECT AVG(TIMESTAMPDIFF(YEAR, birthdate, CURDATE())) AS durchschnittsalter
            FROM user
        ');
        $ps->execute();
        while($row = $ps->fetch()){
            return $row['durchschnittsalter'];
        }
        return 0;
    }


    // Auswertung: Wie viele Administratoren gibt es? Zeigen Sie auch deren Name und E-Mail Adresse.
    public function getAdmins() : array {
        // Lade alle User
        $users = $this->getUsers();
        // Filtere Admins heraus
        $admins = [];
        foreach($users as $user){
            if($user->is_admin){
                $admins[] = $user;
            }
        }
        return $admins;
    }

}
?>