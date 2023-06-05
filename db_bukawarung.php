<?php
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $dbname   = 'db_bukawarung';
    
    $rae = mysqli_connect($hostname, $username, $password, $dbname) or die ('Gagal Terhubung ke database')
    ?>