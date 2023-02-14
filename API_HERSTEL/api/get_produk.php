<?php

//memanggil file interkoneksi database
require '../config/connect.php';

//memanggil filemethod API yang digunakan
if ($_SERVER['REQUEST_METHOD'] == "POST") {
      #code...
      $response = array();
      $limit = $_POST['limit'];
      $offset = $_POST['offset'];

      if (empty($_POST['limit']) ){
        # code... 
        $response['status_code'] = 401;
      $response['message'] = "limit tidak boleh kosong";
      echo json_encode($response);
      }elseif ($offset == ""){
        # code... 
        $response['status_code'] = 401;
      $response['message'] = "offset tidak boleh kosong";
      echo json_encode($response);
      }else{
        $response['produk'] = array();
        $cek = mysqli_query($con, "SELECT * FROM `produk` ORDER BY id DESC limit $offset, $limit");
        while ($a = mysqli_fetch_array($cek)) {
          #code..
          $response['produk'][] = array(
              "id" => $a ['id'],
              "nama" => $a ['nama'],
              "kategori" => $a ['kategori'],
              "harga" => $a ['harga'],
              "photo" => $a ['photo'],
              
          );
        }
        $response['status_code'] = 200;
        $response['message'] = "Berhasil";
        echo json_encode($response);
      }

      
     
} else {
    $response=array();
    $response['status_code'] = 401;
    $response['message'] = "NO";
    echo json_encode($response);
}