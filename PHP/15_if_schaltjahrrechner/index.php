<!DOCTYPE html>
 <html>
 <head>
     <meta charset='utf-8'>
     <meta http-equiv='X-UA-Compatible' content='IE=edge'>
     <title>Schaltjahrrechner</title>
     <meta name='viewport' content='width=device-width, initial-scale=1'>
     <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
     <script src='main.js'></script>
 </head>
 <body>
     <h1>Schaltjahrrechner</h1>

    <form action="index.php" method="POST">
        <label for="jahr">Jahr:</label><br>
        <input type="text" id="jahr" name="jahr"><br>
        <button name="bt_calculate">Berechnen</button>
    </form>

    <?php

        if($jahr == 400)
        {

        }

     ?>
     
 </body>
 </html>