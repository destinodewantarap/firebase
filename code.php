<?php
session_start();
include('includes/dbconfig.php');
    if(isset($_POST['input_data']))
    {
        $ph = $_POST['ph'];
        $suhu = $_POST['suhu'];
        $kelembaban = $_POST['kelembaban'];

        $data = [
            'ph' => $ph,
            'suhu' => $suhu,
            'kelembaban' => $kelembaban
        ];

        $ref = "datatanaman/";
        $postdata = $database->getReference($ref)->push($data);

        if($postdata){
            $_SESSION['status'] = "Data tanaman berhasil di input";
             header("Location: index.php");
    
        }else{
            $_SESSION['status'] = "Data tanaman gagal !!";
            header("Location: index.php");
        }
    }