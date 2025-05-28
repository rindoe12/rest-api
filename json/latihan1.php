<?php

$mahasiswa =[
    [
         "nama" => "Rindu Arifa Rahill",
         "nrp" => "2217020100",
         "email" => "rindurahill@gmail.com"
    ],
     [
         "nama" => "Restu Arifa",
         "nrp" => "2217020167",
        "email" => "restu@gmail.com"
     ]
 ];

$dbh = new PDO('mysql:host=localhost;dbname=phpdasar', 'root');
$db = $dbh->prepare('SELECT * FROM mahasiswa');
$db->execute();
$mahasiswa = $db->fetchAll(PDO::FETCH_ASSOC);


header('Content-Type: application/json');
$data = json_encode($mahasiswa);
echo $data;

?>