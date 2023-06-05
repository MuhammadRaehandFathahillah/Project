<?php
    error_reporting(0);
    include 'db_bukawarung.php';
    $kontak = mysqli_query($rae, "SELECT Admin_telp, Admin_email, Admin_address FROM tb_admin
    WHERE Admin_id = 1");
    $a = mysqli_fetch_object($kontak);

    $produk = mysqli_query($rae, "SELECT * FROM  tb_produk WHERE Produk_id = '".$_GET['id']."' " );
    $p = mysqli_fetch_object($produk);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Warungku</title>
    <link rel="stylesheet" type="text/css"  href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
</head>
<body>
    <!-- header -->
    <header>
        <div class="container">
            <h1><a href="index.php">Warungku</a></h1>
            <ul>
                <li><a href="produk.php">Product</a></li>
            </ul>
        </div>
    </header>

    <!-- search -->
    <div class="search">
        <div class="container">
            <form action="produk.php">
                <input type="text" name="search" placeholder="Search Product" value="<?php echo $_GET['search'] ?>">
                <input type="hidden" name="kat" value="<?php echo $_GET['kat'] ?>">
                <input type="submit" name="cari" value="Search">
            </form>
        </div>
    </div>

    <!-- Produk Detail -->
    <div class="section">
        <div class="container">
            <h3>Product Detail</h3>
            <div class="box">
                <div class="col-2">
                    <img src="produk/<?php echo $p->Produk_image ?>" width="100%">
                </div>
                <div class="col-2">
                    <h3><?php echo $p-> Produk_name ?></h3>
                    <h4>Rp. <?php echo number_format( $p->Produk_price) ?></h4>
                    <p>Description :<br>
                        <?php echo $p->Produk_description ?>
                    </p>
                    <p><a href="https://api.whatsapp.com/send?phone=<?php echo $a->Admin_telp ?>&text=Hai, Saya Tertarik Dengan Produk Anda." target="_blank">
                    Contact Via Whatsapp 
                    <img src="img/ikon wa.png" width="80px"</a>
                </p>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <div class="footer">
        <div class="container">
            <h4>Alamat</h4>
            <p><?php echo $a->Admin_address ?></p>

            <h4>Email</h4>
            <p><?php echo $a->Admin_email ?></p>

            <h4>No HP</h4>
            <p><?php echo $a->Admin_telp ?></p>
            <small>Copyright &copy; 2023 - Warungku. </small>
        </div>
    </div>
</body>
</html>