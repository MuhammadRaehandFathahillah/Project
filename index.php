<?php
    include 'db_bukawarung.php';
    $kontak = mysqli_query($rae, "SELECT Admin_telp, Admin_email, Admin_address FROM tb_admin
    WHERE Admin_id = 1");
    $a = mysqli_fetch_object($kontak);
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
                <input type="text" name="search" placeholder="Search Product">
                <input type="submit" name="cari" value="Search">
            </form>
        </div>
    </div>

    <!-- Kategori -->
    <div class="section">
        <div class="container">
            <h3>Category</h3>
            <div class="box">
                <?php
                    $kategori = mysqli_query($rae, "SELECT * FROM tb_kategori ORDER BY Kategori_id DESC");
                    if(mysqli_num_rows($kategori) > 0){
                        while($K = mysqli_fetch_array($kategori)){
                ?>
                    <a href="produk.php?kat=<?php echo $K['Kategori_id']?>">
                        <div class="col-5">
                            <img src="img/ikon kategori.png" width="50px" style="margin-bottom:5px;">
                            <p><?php echo $K ['Kategori_name'] ?></p>
                        </div>
                    </a>
                <?php }}else{ ?>
                    <p>Category Not Found</p>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- New Produk -->
    <div class="section">
        <div class="container">
            <h3>NEW PRODUCT</h3>
            <div class="box">
                <?php 
                    $produk = mysqli_query($rae, "SELECT * FROM tb_produk WHERE Produk_status = 1 ORDER BY Produk_id DESC LIMIT 4");
                    if(mysqli_num_rows($produk) > 0){
                        while($p = mysqli_fetch_array($produk)){
                    ?>
                    <a href="detail-produk.php?id=<?php echo $p['Produk_id'] ?>">
                        <div class="col-4">
                            <img src="produk/<?php echo $p['Produk_image'] ?>" style="height: 180px;object-fit: cover;">
                            <p class="nama"><?php echo substr($p['Produk_name'], 0,25)  ?></p>
                            <p class="harga">Rp. <?php echo number_format($p['Produk_price']) ?></p>
                        </div>
                    </a>
                <?php }}else{ ?>
                    <p> Product Not Found</p>
                <?php } ?>
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