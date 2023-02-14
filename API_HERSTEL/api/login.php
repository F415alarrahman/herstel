<?php

// memanggil file interkoneksi database
require '../config/connect.php';


// memanggil file method API yang digunakan
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    #code...

    $response = array();

    $email = $_POST['email'];

    $cekEmail = mysqli_query($con, "SELECT * FROM `users` WHERE email='$email'");
    if (mysqli_num_rows($cekEmail) > 0) {
        #codde...
        $data = mysqli_fetch_array($cekEmail);

        $response['id'] = $data['id'];
        $response['email'] = $data['email'];
        $response['phone'] = $data['phone'];
        $response['nama_lengkap'] = $data['nama_lengkap'];
        $response['photo'] = $data['photo'];
        $response['tgl_registrasi'] = $data['tgl_registrasi'];
        $response['status_code'] = 200;
        $response['message'] = "SUCCESS";
        echo json_encode($response);
    } else {
        #codde...
        $response['status_code'] = 201;
        $response['message'] = "EMAIL TIDAK DITEMUKAN";
        echo json_encode($response);
    }
} else {
    $response = array();
    $response['status_code'] = 401;
    $response['message'] = "METHOD NOT ALLOWED";
    echo json_encode($response);
}