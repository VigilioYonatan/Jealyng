<?php
const host = 'localhost';
const user = 'VIGILIO98';
const password = 'vigilio98';
const db = 'jealyng';

$cnx = mysqli_connect(host, user, password, db);

if (!$cnx) {
    echo "<script>alert('Error en la base de datos')</script>";
}

mysqli_query($cnx, "SET NAMES 'utf8'");