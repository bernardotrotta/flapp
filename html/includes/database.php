<?php
$conn = mysqli_connect('db', 'root', 'root', 'flapp');
if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}
