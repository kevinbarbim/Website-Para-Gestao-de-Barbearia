<?php
 $host = "localhost";
 $user = "root";
 $pass = "";
 $bd = "bd_TCC";

 $mysqli = new mysqli($host, $user, $pass, $bd);

 // checa a conexao

 if ($mysqli->connect_errno){
    echo "Connect failed: ". $mysqli->connect_error;
    exit();
 }