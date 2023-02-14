<?php

//memanggil file interkoneksi database
require '../config/connect.php';

//memanggil filemethod API yang digunakan
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    #code...

    $response = array();

    $id = $_POST['id'];
    $insert = "UPDATE users
    SET is_deleted = 'Y',
    WHERE id = '$id'";

    if (mysqli_query($con, $insert)) {
        #code...
        $response['status_code'] = 200;
        $response['message'] = "BERHASIL DIHAPUS";
        echo json_encode($response);
    } else {
        #code...
        $response['status_code'] = 201;
        $response['message'] = "GAGAL DIHAPUS";
        echo json_encode($response);
    }
} else {
    $response = array();
    $response['status_code'] = 401;
    $response['message'] = "METHOD NOT ALLOWED";
    echo json_encode($response);
}