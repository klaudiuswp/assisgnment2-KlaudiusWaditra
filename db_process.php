<?php

require 'function.php';

$conn = getConn();

$cekPerintah = $_POST['perintah'];

if ($cekPerintah == 'create') {
    if (!isset($_POST['nama_user']) || !isset($_POST['role']) || !isset($_POST['availability']) || !isset($_POST['age']) || !isset($_POST['lokasi']) || !isset($_POST['pengalaman']) || !isset($_POST['email'])) {
        header("Location: http://localhost:8080?error=form%20masih%20kosong");
        exit;
    }

    $nama = $_POST['nama_user'];
    $role = $_POST['role'];
    $availability = $_POST['availability'];
    $age = $_POST['age'];
    $lokasi = $_POST['lokasi'];
    $pengalaman = $_POST['pengalaman'];
    $email = $_POST['email'];

    if ($age <= 0) {
        header("Location: http://localhost:8080?error=umur%20tidak%20boleh%20kurang%20dari%200");
        exit;
    }

    if (!filter_var($age, FILTER_VALIDATE_INT) || !filter_var($pengalaman, FILTER_VALIDATE_INT)) {
        header("Location: http://localhost:8080?error=umur%20dan%20pengalaman%20harus%20angka");
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: http://localhost:8080?error=email%20tidak%20valid");
        exit;
    }

    create_data($conn, $nama, $role, $availability, $age, $lokasi, $pengalaman, $email);
}

if ($cekPerintah == 'delete') {
    delete_data($conn, $_POST['id']);
}

header("Location: http://localhost:8080");
