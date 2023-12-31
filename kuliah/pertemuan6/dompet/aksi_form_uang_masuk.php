<?php
include "koneksi.php";

$lampiran = "";
if($_FILES['lampiran']['name'] != "")
{
    // script upload file lampiran
    $namaFile = str_replace("'","",$_FILES['lampiran']['name']);
    $namaSementara = $_FILES['lampiran']['tmp_name'];

    // tentukan lokasi file akan dipindahkan
    $dirUpload = "uploads/";

    // pindahkan file
    $terupload = move_uploaded_file($namaSementara, $dirUpload.$namaFile);
    if (!$terupload) {
    //    echo "Upload berhasil!<br/>";
    //    echo "Link: <a href='".$dirUpload.$namaFile."'>".$namaFile."</a>";
    // } else {
    echo "Upload Gagal!";
        exit();
    }
    $lampiran = $dirUpload.$namaFile;
}


$tanggal = $_POST['tanggal'];
$kategori = $_POST['kategori'];
$nominal = $_POST['nominal'];
$keterangan = $_POST['keterangan'];

$sql = "INSERT INTO transaksi (tanggal, kategori, nominal, keterangan, lampiran, tanggal_input) VALUES ('$tanggal', '$kategori', '$nominal', '$keterangan', '$lampiran', '".date('Y-m-d H:i:s')."')";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Uang Masuk</title>
    <?php include('_include/head.php');?>
</head>
<body>
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col col-lg-7">
                <div class="box">
                    <div class="box-head">
                        <strong>FORM UANG MASUK</strong>
                    </div>
                    <div class="p-4">
                        <div class="mb-3">
                            <?php if (mysqli_query($conn, $sql)) { ?>
                            <div class="alert alert-success" role="alert">
                                New record created successfully
                            </div>
                            <?php } else { ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo "Error: " .mysqli_error($conn); ?>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-3">Tanggal</label>
                            <label class="col-9">: <?php echo $_POST['tanggal']; ?></label>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-3">Kategori</label>
                            <label class="col-9">: <?php echo $_POST['kategori']; ?></label>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-3">Nominal</label>
                            <label class="col-9">: <?php echo $_POST['nominal']; ?></label>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-3">Keterangan</label>
                            <label class="col-9">: <?php echo $_POST['keterangan']; ?></label>
                        </div>
                        <?php if ($lampiran != "") { ?>
                        <div class="mb-3 row">
                            <label class="col-3">Lampiran</label>
                            <label class="col-9">: <a href="<?php echo $lampiran; ?>">Berkas</a></label>
                        </div>
                        <?php } ?>
                        <div class="mb-3 row">
                            <a href="tabel_transaksi.php" class="btn btn-secondary">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>