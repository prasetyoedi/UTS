<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>SIA</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .wrapper {
            width: 90%;
            margin: 50px auto;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .table th {
            background-color: #000;
            color: #fff;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f2f2f2;
        }

        .table-striped tbody tr:hover {
            background-color: #e9ecef;
        }

        .table-actions a {
            color: #007bff;
            margin-right: 5px;
        }

        .table-actions a:hover {
            color: #0056b3;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="float-left">Sistem Informasi Akademik</h2>
                        <a href="insertMahasiswaView.php" class="btn btn-success float-right"><i class="fa fa-plus"></i>
                            Add New</a>
                    </div>
                    <div class="table-responsive">
                        <?php
                        $curl = curl_init();
                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($curl, CURLOPT_URL, 'http://localhost/UTS/api/mahasiswa_api.php');
                        $res = curl_exec($curl);
                        $json = json_decode($res, true);

                        echo '<table class="table table-bordered table-striped">';
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th>NIM</th>";
                        echo "<th>Nama</th>";
                        echo "<th>Alamat</th>";
                        echo "<th>Tanggal Lahir</th>";
                        echo "<th>Kode Matkul</th>";
                        echo "<th>Nama Matkul</th>";
                        echo "<th>SKS</th>";
                        echo "<th>nilai</th>";
                        echo "<th class='text-center'>Action</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        for ($i = 0; $i < count($json); $i++) {
                            echo "<tr>";
                            echo "<td> {$json[$i]["nim"]} </td>";
                            echo "<td> {$json[$i]["nama"]} </td>";
                            echo "<td> {$json[$i]["alamat"]} </td>";
                            echo "<td> {$json[$i]["tanggal_lahir"]} </td>";
                            echo "<td> {$json[$i]["kode_mk"]} </td>";
                            echo "<td> {$json[$i]["nama_mk"]} </td>";
                            echo "<td> {$json[$i]["sks"]} </td>";
                            echo "<td> {$json[$i]["nilai"]} </td>";
                            echo "<td class='table-actions text-center'>";
                            echo '<a href="updateMahasiswaView.php?nim=' . $json[$i]["nim"] . '&kode_mk=' . $json[$i]["kode_mk"] . '" title="Update Record" data-toggle="tooltip"><i class="fa fa-pencil"></i></a>';
                            echo '<a href="deleteMahasiswaDo.php?nim=' . $json[$i]["nim"] . '&kode_mk=' . $json[$i]["kode_mk"] . '" title="Delete Record" data-toggle="tooltip"><i class="fa fa-trash"></i></a>';
                            echo "</td>";
                            echo "</tr>";
                        }
                        echo "</tbody>";
                        echo "</table>";

                        curl_close($curl);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</body>

</html>