<?php

if (isset($_POST['submit'])) {
    $nim = $_POST['nim'];
    $kode_mk = $_POST['kode_mk']; 
    $nilai = $_POST['nilai'];

    $url = 'http://localhost/UTS/api/mahasiswa_api.php';
    $ch = curl_init($url);
    $jsonData = array(
        'nim' => $nim,
        'kode_mk' => $kode_mk,
        'nilai' => $nilai
    );

    $jsonDataEncoded = json_encode($jsonData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    $result = curl_exec($ch);
    $result = json_decode($result, true);

    curl_close($ch);

    print ("<center><br>status :  {$result["status"]} ");
    print ("<br>");
    print ("message :  {$result["message"]} ");
    echo "<br>Sukses terkirim ke ubuntu server !";
    echo "<br><a href=selectMahasiswaView.php> OK </a>";
}
?>