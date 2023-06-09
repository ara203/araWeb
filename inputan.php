<?php
include 'koneksi.php';

$antrian        = "";
$nama       = "";
$berat     = "";
$paket   = "";
$sukses     = "";
$error      = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}
if($op == 'delete'){
    $id         = $_GET['id'];
    $sql1       = "DELETE FROM tb_pelanggan where id = '$id'";
    $q1         = mysqli_query($conn,$sql1);
    if($q1){
        $sukses = "Berhasil hapus data";
    }else{
        $error  = "Gagal melakukan delete data";
    }
}
if ($op == 'edit') {
    $id         = $_GET['id'];
    $sql1       = "SELECT * FROM tb_pelanggan where id = '$id'";
    $q1         = mysqli_query($conn, $sql1);
    $r1         = mysqli_fetch_array($q1);
    $antrian      = $r1['antrian'];
    $nama       = $r1['nama'];
    $berat     = $r1['berat'];
    $paket   = $r1['paket'];

    if ($antrian == '') {
        $error = "Data tidak ditemukan";
    }
}
if (isset($_POST['simpan'])) { //untuk create
    $antrian        = $_POST['antrian'];
    $nama       = $_POST['nama'];
    $berat     = $_POST['berat'];
    $paket   = $_POST['paket'];

    if ($antrian && $nama && $berat && $paket) {
        if ($op == 'edit') { //untuk update
            $sql1       = "UPDATE tb_pelanggan set antrian = '$antrian',nama='$nama',berat = '$berat', paket='$paket' where id = '$id'";
            $q1         = mysqli_query($conn, $sql1);
            if ($q1) {
                $sukses = "Data berhasil diupdate";
            } else {
                $error  = "Data gagal diupdate";
            }
        } else { //untuk insert
            $sql1   = "INSERT INTO tb_pelanggan(antrian,nama,berat,paket) values ('$antrian','$nama','$berat','$paket')";
            $q1     = mysqli_query($conn, $sql1);
            if ($q1) {
                $sukses     = "Berhasil memasukkan data baru";
            } else {
                $error      = "Gagal memasukkan data";
            }
        }
    } else {
        $error = "Silakan masukkan semua data";
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Inputan Customer</title>
        <link rel="stylesheet" href="css/inputan.css">
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        
        <style>
        .mx-auto {
            width: 800px
        }

        .card {
            margin-top: 10px;
        }
        </style>

    </head>
    <body>
        <div class="body"></div>
        <div class="text">
            <h1>Inputan Pesanan Laundry </h1>
        
            <div class="mx-auto">
        <!-- untuk memasukkan data -->
        <div class="card">
            <div class="card-header">
                Create / Edit Data
            </div>
            <div class="card-body">
                <?php
                if ($error) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php
                    header("refresh:5;url=inputan.php");//5 : detik
                }
                ?>
                <?php
                if ($sukses) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>
                <?php
                    header("refresh:5;url= inputan.php");
                }
                ?>
                <form action="" method="POST">
                    <div class="mb-3 row">
                        <label for="abs" class="col-sm-2 col-form-label">No Antrian</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="antrian" name="antrian" value="<?php echo $antrian ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama Pelanggan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="alamat" class="col-sm-2 col-form-label">Berat</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="berat" name="berat" value="<?php echo $berat ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="paket" class="col-sm-2 col-form-label" name="paket">Paket</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="paket" id="sektor">
                                <option value="">- Choose Sector -</option>
                                <option value="CB" <?php if ($paket == "CB") echo "selected" ?>>Cuci Basah</option>
                                <option value="CK" <?php if ($paket == "CK") echo "selected" ?>>Cuci Kering</option>
                                <option value="S" <?php if ($paket == "S") echo "selected" ?>>Setrika</option>
                                <option value="CS" <?php if ($paket == "CS") echo "selected" ?>>Cuci Setrika</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary" />
                    </div>
                </form>
            </div>
        </div>

        <!-- untuk mengeluarkan data -->
        <div class="card">
            <div class="card-header text-white bg-secondary">
                Data Pelanggan
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Antrian</th>
                            <th scope="col">Name Pelanggan</th>
                            <th scope="col">Berat</th>
                            <th scope="col">Paket</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql2   = "select * from tb_pelanggan order by id desc";
                        $q2     = mysqli_query($conn, $sql2);
                        $urut   = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id         = $r2['id'];
                            $antrian        = $r2['antrian'];
                            $nama       = $r2['nama'];
                            $berat     = $r2['berat'];
                            $paket   = $r2['paket'];

                        ?>
                            <tr>
                                <th scope="row"><?php echo $urut++ ?></th>
                                <td scope="row"><?php echo $antrian ?></td>
                                <td scope="row"><?php echo $nama ?></td>
                                <td scope="row"><?php echo $berat ?></td>
                                <td scope="row"><?php echo $paket ?></td>
                                <td scope="row">
                                    <a href="inputan.php?op=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                                    <a href="inputan.php?op=delete&id=<?php echo $id?>" onclick="return confirm('Yakin mau delete data?')"><button type="button" class="btn btn-danger">Delete</button></a>            
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    
                </table>
            </div>
        </div>
    </div>

        <br><div class="button"></br>
           <a href="inputan.php"><button>Print</button></a>
        </div>
        <br>
        <br>
        <br>
    </body>
</html>