<?php

if (isset($_POST['submit'])) {
    $nim = $_GET['nim'];
    $kode_mk = $_GET['kode_mk'];


    $url = 'http://localhost/UTS/api/mahasiswa_api.php?nim=' . $nim . '&kode_mk=' . $kode_mk . '';
    $ch = curl_init($url);

    $jsonData = array(
        'nilai' => $_POST['nilai']
    );

    $jsonDataEncoded = json_encode($jsonData);


    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    $result = curl_exec($ch);
    $result = json_decode($result, true);
    curl_close($ch);

    print ("<center><br>status :  {$result["status"]} ");
    print ("<br>");
    print ("message :  {$result["message"]} ");
    echo "<br>Sukses mengupdate data di ubuntu server !";
    echo "<br><a href=selectMahasiswaView.php> OK </a>";
}
?>