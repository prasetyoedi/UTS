<?php

require 'config.php';

$request_method = $_SERVER["REQUEST_METHOD"];

switch ($request_method) {
    case 'GET':
        if (!empty($_GET["nim"])) {
            $nim = $_GET["nim"];
            get_mahasiswa_by_nim($nim);
        } else {
            get_semua_mahasiswa();
        }
        break;
    case 'POST':
        insert_nilai_baru();
        break;
    case 'PUT':
        update_data_mahasiswa();
        break;
    case 'DELETE':
        delete_nilai();
        break;
    default:
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}

function get_semua_mahasiswa()
{
    global $conn;
    $sql = "SELECT * FROM perkuliahan p JOIN mahasiswa m ON p.nim = m.nim JOIN matakuliah mk ON p.kode_mk = mk.kode_mk";
    $result = $conn->query($sql);
    $nilai_mahasiswa = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $nilai_mahasiswa[] = $row;
        }
    }
    echo json_encode($nilai_mahasiswa);
}


function get_mahasiswa_by_nim($nim)
{
    global $conn;
    $query = "SELECT * FROM perkuliahan WHERE nim='$nim'";
    $result = $conn->query($query);
    $perkuliahan = array();
    while ($row = $result->fetch_assoc()) {
        $perkuliahan[] = $row;
    }
    echo json_encode($perkuliahan);
}

function insert_nilai_baru()
{
    global $conn;
    $data = json_decode(file_get_contents('php://input'), true);
    $nim = $data["nim"];
    $kode_mk = $data["kode_mk"];
    $nilai = $data["nilai"];
    $query = "INSERT INTO perkuliahan (nim, kode_mk, nilai) VALUES ('$nim', '$kode_mk', $nilai)";
    if ($conn->query($query) === TRUE) {
        $response = array(
            'status' => 1,
            'message' => 'Nilai mahasiswa berhasil ditambahkan.'
        );
    } else {
        $response = array(
            'status' => 0,
            'message' => 'Gagal menambahkan nilai mahasiswa.'
        );
    }
    echo json_encode($response);
}

function update_data_mahasiswa()
{
    global $conn;
    $nim = $_GET["nim"];
    $kode_mk = $_GET["kode_mk"];
    $data = json_decode(file_get_contents('php://input'), true);
    $nilai = $data["nilai"];
    $query = "UPDATE perkuliahan SET nilai=$nilai WHERE nim='$nim' AND kode_mk='$kode_mk'";
    if ($conn->query($query) === TRUE) {
        $response = array(
            'status' => 1,
            'message' => 'Nilai mahasiswa berhasil diperbarui.'
        );
    } else {
        $response = array(
            'status' => 0,
            'message' => 'Gagal memperbarui nilai mahasiswa.'
        );
    }
    echo json_encode($response);
}

function delete_nilai()
{
    global $conn;
    $data = json_decode(file_get_contents('php://input'), true);
    $nim = $_GET["nim"];
    $kode_mk = $_GET["kode_mk"];
    $query = "DELETE FROM perkuliahan WHERE nim='$nim' AND kode_mk='$kode_mk'";
    if ($conn->query($query) === TRUE) {
        $response = array(
            'status' => 1,
            'message' => 'Nilai mahasiswa berhasil dihapus.'
        );
    } else {
        $response = array(
            'status' => 0,
            'message' => 'Gagal menghapus nilai mahasiswa.'
        );
    }
    echo json_encode($response);
}

$conn->close();