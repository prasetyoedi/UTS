<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper {
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>

<body>

    <?php
    $nim = $_GET['nim'];
    $kode_mk = $_GET['kode_mk'];
    ?>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Update nilai mahasiswa</h2>
                    </div>
                    <form action="updateMahasiswaDo.php?nim=<?php echo $nim ?>&kode_mk=<?php echo $kode_mk ?>"
                        method="post">
                        <div class="form-group">
                            <label>Nilai</label>
                            <input type="text" name="nilai" class="form-control">
                        </div>

                        <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>