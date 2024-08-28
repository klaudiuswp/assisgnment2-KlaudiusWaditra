<?php
function getConn()
{
    $servername = "localhost:3306";
    $username = "root";
    $password = "n124";
    $dbname = "data_karyawan";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Koneksi Gagal: " . $conn->connect_error);
    }
    return $conn;
}
function read_data($conn)
{
    $query = "SELECT * FROM data_karyawan.data_form";
    $result = $conn->query($query);
    return $result;
}
function create_data($conn, $nama, $role, $availability, $age, $lokasi, $pengalaman, $email)
{
    $query = $conn->prepare("INSERT INTO data_karyawan.data_form (nama,role,availability,age,lokasi,pengalaman,email) values(?,?,?,?,?,?,?)");
    $query->bind_param("sssisss", $nama, $role, $availability, $age, $lokasi, $pengalaman, $email);

    if ($query->execute()) {
        return "berhasil tambah";
    } else {
        return "gagal";
    }
}
function delete_data($conn, $id)
{
    $id_to_delete = $id;
    $query = "SELECT $id_to_delete FROM data_karyawan.data_form ORDER BY id DESC limit 1";
    if ($conn->query($query) == TRUE) {
        $query = "DELETE FROM data_karyawan.data_form WHERE id = $id_to_delete";
        if ($conn->query($query) == TRUE) {
            echo "berhasil hapus";
        } else {
            echo "gagal";
        }
    } else {
        echo "gagal";
    }
}
