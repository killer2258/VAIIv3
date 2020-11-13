<?php
$db = mysqli_connect('localhost', 'root', '', 'semestralka');

if(!$db) {
    die ("Chyba: ".mysqli_connect_error());
}