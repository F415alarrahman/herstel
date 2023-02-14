<?php

//memanggil file interkoneksi database
require '../config/connect.php';

//memanggil filemethod API yang digunakan
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    #code...

    $response = array();

    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $id = $_POST['id'];

    $insert = "UPDATE users
    SET nama_lengkap = '$nama_lengkap',
    phone = '$phone',
    email = '$email',
    WHERE id = '$id'";

    if (mysqli_query($con, $insert)) {
        #code...
        $response['status_code'] = 200;
        $response['message'] = "SUCCES";
        echo json_encode($response);
    } else {
        #code...
        $response['status_code'] = 201;
        $response['message'] = "FAILED";
        echo json_encode($response);
    }
} else {
    $response = array();
    $response['status_code'] = 401;
    $response['message'] = "METHOD NOT ALLOWED";
    echo json_encode($response);
}