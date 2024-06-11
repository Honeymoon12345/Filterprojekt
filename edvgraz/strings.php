<?php
$mein_string = "Hello World";

for ( $i = 0; $i < strlen($mein_string); $i ++){
    echo "Index {$i}: " . $mein_string[$i] . '<br>';
}

$name = "Marlene Pucher";
$vorname = strtok($name, /* token: */ " ");
$nachname = strtok(/* string:  */" ");
echo $vorname . " " . $nachname . '<br>';

$mein_vorname = substr($name, /* offset:  */0, /* length:  */7);
echo str_replace($mein_vorname, /* replace:  */'Susanne', $name) . '<br>';

//String => Kleinbuchstaben
$username = "Superadmin";
if(strtolower ($username) == "superadmin"){
    echo "Willkommen Superadmin!";
}else {
    echo "Willkommen Gast!";
}
