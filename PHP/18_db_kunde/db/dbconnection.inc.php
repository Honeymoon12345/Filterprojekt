<?php
function db_connection() : PDO
{
    try{
        //try: möglicher Fehler, z.B. kein Internet, falsches Passwort ...
        $host = '127.0.0.1';
        $dbName = 'kunden080422';
        $user = 'root';
        $password = '';
        // Datenbankverbindung aufbauen
        $connection = new PDO("mysql:dbname=$dbName; host=$host", $user, $password);
        // Alle Fehlermeldungen bei der Datenbank anzeigen
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //Datenbankverbindung zurückgeben
        return $connection;
    } catch(PDOException $e)
    {
        // catch-Block catch() <-- Fehlertyp auf den wir reagieren möchten
        // wird nur ausgeführt wenn im try-Block ein Fehler ist
        // beende das Script und gibt die Fehlermeldung aus
        exit($e->getMessage());
    }
}
?>