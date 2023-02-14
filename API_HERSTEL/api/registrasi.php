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

    $cekEmail = mysqli_query($con, "SELECT * FROM `users` WHERE  email='$email'");
    if (mysqli_num_rows($cekEmail)>0) {
        #code...
        $response['status_code'] = 201;
        $response['message'] = "EMAIL SUDAH TERDAFTAR";
        echo json_encode($response);
    } else {
        $cekPhone = mysqli_query($con, "SELECT * FROM `users` WHERE  phone='$phone'");
        if (mysqli_num_rows($cekPhone)>0) {
            #code...
            $response['status_code'] = 200;
            $response['message'] = "NOMOR SUDAH TERDAFTAR";
            echo json_encode($response);
        } else {

            $cekId = mysqli_query($con, "SELECT * FROM `users` ORDER by id desc limit 1");
            $da = mysqli_fetch_array($cekId);
            $id_Users = $da['id']+1;

            #code...
            $insert = "INSERT INTO users VALUES(NULL,'$email','$phone','$nama_lengkap','default.jpg','$tglSekarang ','N')";

            if (mysqli_query($con, $insert)) {
                #code...
                $response['id'] = (string)$id_Users;
                $response['email'] = $email;
                $response['phone'] = $phone;
                $response['nama_lengkap'] = $nama_lengkap;
                $response['photo'] = "default.jpg";
                $response['tgl_registrasi'] = $tglSekarang;
                $response['status_code'] = 200;
                $response['message'] = "SUCCES";
                echo json_encode($response);
            } else {
                #code...
                $response['status_code'] = 201;
                $response['message'] = "FAILED!";
                echo json_encode($response);
            }
        }
    }
}
else {
    
    $response = array();
    $response['status_code'] = 200;
    $response['message'] = "METHOD NOT ALLOWED";
    echo json_encode($response);
}