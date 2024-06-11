<?php
class EventService
{
    private PDO $conn;
    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }


    // Erstellt einen neuen EventType und gibt die 
    // von der Datenbank vergebene ID des erstellten EventTypes zurück
    public function createEventType(string $name) : int
    {
        $ps = $this->conn->prepare('
            INSERT INTO event_type
            (name)
            VALUES
            (:name)
        ');
        $ps->bindValue('name', $name);
        $ps->execute();
        return $this->conn->lastInsertId();
    }

    // Lädt alle EventTypes aus der Datenbank
    // Gibt ein Array von Objekten der Klasse EventType zurück
    public function getEventTypes() : array 
    {
        $ps = $this->conn->prepare('
            SELECT * 
            FROM event_type
        ');
        $ps->execute();

        $eventTypes = [];
        while($row = $ps->fetch())
        {
            $eventTypes[] = new EventType($row['id'], $row['name']);
        }
        return $eventTypes; 
    }


    // Löscht einen EventType anhand der übergebenen ID aus der Datenbank
    public function deleteEventType(int $id){
        $ps = $this->conn->prepare('
            DELETE FROM event_type 
            WHERE id = :id
        ');
        $ps->bindValue('id', $id);
        $ps->execute();
    }


    // Lädt einen EventType anhand der übergebenen ID aus der Datenbank
    // Gibt ein Objekt der Klasse EventType zurück oder false falls
    // kein EventType mit der ID gefunden wurde
    public function getEventTypeById(int $id) : EventType|false 
    {
        $ps = $this->conn->prepare('
            SELECT * 
            FROM event_type 
            WHERE id = :id
        ');
        $ps->bindValue('id', $id);
        $ps->execute();

        while($row = $ps->fetch())
        {
            return new EventType($row['id'], $row['name']);
        }
        // falls kein EventType gefunden wurde, false zurückgeben
        return false;
    }


    // Aktualisiert einen EventType mit den Daten aus dem übergebenen
    // OBjekt der Klasse EventType in der Datenbank
    public function updateEventType(EventType $eventType)
    {
        $ps = $this->conn->prepare('
            UPDATE event_type 
            SET name = :name 
            WHERE id = :id
        ');
        $ps->bindValue('name', $eventType->name);
        $ps->bindValue('id', $eventType->id);
        $ps->execute();
    }


    /*
    Legt ein neues Event in der Datenbank an und gibt die 
    von der Datenbank zugewiesene ID zurück 
    */
    public function createEvent(string $title, DateTime $eventDate, 
                                int $eventTypeId, string $imgUploadPath,
                                string $imgFilename) : int 
    {
        $ps = $this->conn->prepare('
            INSERT INTO event 
            (title, date_and_time, eventtype_id, img_filename)
            VALUES
            (:title, :dateAndTime, :eventTypeId, :imgFilename)
        ');
        $ps->bindValue('title', $title);
        $ps->bindValue('dateAndTime', $eventDate->format('Y-m-d H:i:s'));
        $ps->bindValue('eventTypeId', $eventTypeId);
        $ps->bindValue('imgFilename', $imgFilename);
        $ps->execute();
        return $this->conn->lastInsertId();
    }


    /*
    Lädt alle Events aus der Datenbank und gibt sie als 
    Array von Objekten der Klasse Event zurück
    */
    public function getEvents() : array {
        $ps = $this->conn->prepare('
            SELECT * 
            FROM event 
        ');
        $ps->execute();

        $events = [];
        while($row = $ps->fetch())
        {
            $events[] = $this->rowToEvent($row);
        }
        return $events;
    }


    /*
    Sucht ein Event anhand der übergebenen ID in der Datenbank
    Gibt das Event als Objekt der Klasse Event zurück,
    oder false falls kein Event mit der ID gefunden wurde.
    */
    public function getEventById(int $id) : Event|false 
    {
        $ps = $this->conn->prepare('
            SELECT * 
            FROM event 
            WHERE id = :id
        ');
        $ps->bindValue('id', $id);
        $ps->execute();
        while($row = $ps->fetch()){
            return $this->rowToEvent($row);
        }
        return false;
    }


    // Wandelt eine $row aus fetch() in ein Objekt der Klasse Event um
    private function rowToEvent($row) : Event {
        $dateAndTime = DateTime::createFromFormat('Y-m-d H:i:s', $row['date_and_time']);
        $event = new Event($row['id'], $row['title'], $dateAndTime, 
                                    $row['eventtype_id'], $row['img_filename']);
        return $event;
    }


    // Löscht ein Event anhand der angegebenen ID aus der Datenbank
    public function deleteEvent(int $id){
        $ps = $this->conn->prepare('
            DELETE FROM event 
            WHERE id = :id
        ');
        $ps->bindValue('id', $id);
        $ps->execute();
    }


    // Aktualisiert ein Event in der Datenbank
    // Übergeben wird ein Objekt der Klasse Event mit den neuen Daten
    public function updateEvent(Event $event)
    {
        $ps = $this->conn->prepare('
            UPDATE event 
            SET title = :title, date_and_time = :dateAndTime, eventtype_id = :eventTypeId, img_filename = :imgFilename 
            WHERE id = :id 
        ');
        $ps->bindValue('title', $event->title);
        $ps->bindValue('dateAndTime', $event->date_and_time->format('Y-m-d H:i:s'));
        $ps->bindValue('eventTypeId', $event->eventtype_id);
        $ps->bindValue('imgFilename', $event->img_filename);
        $ps->bindValue('id', $event->id);
        $ps->execute();
    }


    // Meldet einen User zu einem Event an
    // Übergeben wird die Event-ID sowie die User-ID
    public function participateEvent(int $eventId, int $userId){
        $ps = $this->conn->prepare('
            INSERT INTO participation 
            (user_id, event_id)
            VALUES
            (:userId, :eventId)
        ');
        $ps->bindValue('userId', $userId);
        $ps->bindValue('eventId', $eventId);
        $ps->execute();
    }


    // Sucht Teilneher eines Events
    // Gibt ein Array von Usern zurück
    public function getEventParticipants(int $eventId) : array {
        $ps = $this->conn->prepare('
            SELECT * 
            FROM participation p 
            INNER JOIN user u ON(p.user_id = u.id) 
            WHERE p.event_id = :eventId 
        ');
        $ps->bindValue('eventId', $eventId);
        $ps->execute();

        $users = [];
        while($row = $ps->fetch())
        {
            $birthdate = DateTime::createFromFormat('Y-m-d', $row['birthdate']);
            $users[] = new User($row['id'], $row['firstname'], $row['lastname'], 
                            $row['email'], $row['password'], $birthdate, $row['is_admin']);
        }
        return $users; 
    }



    // Auswertung: Welche ist die beliebteste Veranstaltung?
    public function getEventWithMaxParticipation() : EventParticipationCount|false 
    {
        // Suche für jede Veranstaltung wie viele Mitglieder teilnehmen
        // Ordne anhand der Teilnehmerzahl
        $ps = $this->conn->prepare('
            SELECT e.id AS eventId, e.title AS eventTitle, COUNT(*) AS participationCount
            FROM participation p 
            INNER JOIN event e ON(p.event_id = e.id)
            GROUP BY p.event_id
            ORDER BY participationCount DESC
        ');
        $ps->execute();

        while($row = $ps->fetch()){
            $event = $this->getEventById($row['eventId']);
            $count = $row['participationCount'];
            return new EventParticipationCount($event, $count);
        }

        // Es gibt kein Event mit Teilnehmern, false zurückgeben
        return false; 
    }


    // Auswertung: Welche Veranstaltungen haben noch keine Teilnehmer?
    // Gibt alle Events zurück die noch keine Teilnehmer haben
    // Gibt ein Array von Objekten der Klasse Event zurück
    public function getEventsWithNoParticipants() : array {
        $ps = $this->conn->prepare('
            SELECT e.id AS eventId 
            FROM event e 
            LEFT JOIN participation p ON(e.id = p.event_id) 
            WHERE p.event_id IS NULL 
        ');
        $ps->execute();
        $events = [];

        // Diese Lösung ist nicht elegant, aber sie funktioniert. 
        // für jede gefundene Event-ID ohne Teilnehmer wird extra das Event anhand der ID geladen
        while($row = $ps->fetch()){
            $eventId = $row['eventId'];
            $events[] = $this->getEventById($eventId);
        }
        return $events;
    }  
}

class EventParticipationCount
{
    public Event $event;
    public int $count;
    public function __construct(Event $event, int $count){
        $this->event = $event;
        $this->count = $count;
    }
}
?>