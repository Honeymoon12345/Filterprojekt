<?php
session_start();

if(!isset($_SESSION['numbers']))
{
    $_SESSION['numbers'] = [];
}

if(isset($_POST['bt_add_number']))
{
    $number = $_POST['number'];
    $_SESSION['numbers'][] = $number;
    header('Location: session_array_sum.php');
    return;
  
}
?>

<!DOCTYPE html>
 <html>
 <head>
     <meta charset='utf-8'>
     <meta http-equiv='X-UA-Compatible' content='IE=edge'>
     <title>Page Title</title>
     <meta name='viewport' content='width=device-width, initial-scale=1'>
     <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
     <script src='main.js'></script>
 </head>
 <body>
     <h1>Berechnet die Summe der Zahlen in der Liste</h1>
     <p>Die Liste wird in einer Session-Variable gespeichert.</p>

     <form action="session_array_sum.php" method="POST">
         <label>Zahl:</label><br>
         <input type="text" name="number"><br>
         <button name="bt_add_number">Zahl hinzufügen</button>

         <h2>Alle bisher gespeicherten Zahlen</h2>
         <?php 
         for($i = 0; $i < count($_SESSION['numbers']); $i++)
         {
             $number = $_SESSION['numbers'][$i];
             echo htmlspecialchars($number);

             if($i != count($_SESSION['numbers']) - 1)
             {
                 echo ', ';
             }
         }
         ?>

         <h2>Die Summe aller gespeicherten Zahlen</h2>
         <?php
        $summe = 0;
        for($i = 0; $i < count($_SESSION['numbers']); $i++)
        {
            $number = $_SESSION['numbers'][$i];
            $summe += $number;
        }
        echo 'Summe der Zahlen: ' . htmlspecialchars($summe);
         ?>
     </form>
     
 </body>
 </html>