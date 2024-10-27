<?php
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dpname = 'ifto_conect';

     $conect = new mysqli($servername, $username, $password, $dpname);

     if ($conect->connect_errno){
        die("ERRO: " . $conect->connect_error);
     }
?>