<?php

$host ="localhost";
$user ="root";
$pass ="";
$db="najla_native";

$koneksi=mysqli_connect($host,$user,$pass,$db);

if(!$koneksi){
    die("gagal terhubung: " . mysqli_connect_error());
}

?>