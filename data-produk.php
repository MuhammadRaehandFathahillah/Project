<?php
session_start();
include 'db_bukawarung.php';
if($_SESSION['status_login'] != true){
    echo '<script>window.location="login.php"</script>';
}
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
            <h1><a href="dashboard.php">Warungku</a></h1>
            <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="profil.php">Profil</a></li>
            <li><a href="data-kategori.php">Category Data</a></li>
            <li><a href="data-produk.php"> Product Data</a></li>
            <li><a href="logout.php">Logout</a></li>
            </ul>
            </div>
    </header>

    <!-- content -->
    <div class="section">
        <div class="container">
            <h3>Product Data</h3>
            <div class="box">
                <p><a href="Tambah-produk.php">Add Data</a></p>
                <br>
                <table border ="1" cellspacing = "0" class="table" >
                    <thead>
                        <tr>
                            <th width="40px">No</th>
                            <th>Category</th>
                            <th>Produk Name</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th width="150px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no =1;
                            $produk = mysqli_query($rae,"SELECT * FROM tb_produk LEFT JOIN tb_kategori USING (Kategori_id)
                            ORDER BY Produk_id DESC");
                            if(mysqli_num_rows($produk) > 0){
                            while ($row = mysqli_fetch_array($produk)) {
                        ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $row['Kategori_name']?></td>
                            <td><?php echo $row['Produk_name']?></td>
                            <td>Rp. <?php echo number_format($row['Produk_price']) ?></td>
                            <td><a href="produk/<?php echo $row['Produk_image']?>" target="_blank"> <img src="produk/<?php echo $row['Produk_image']?>"width="50px"></a></td>
                            <td><?php echo ($row['Produk_status']==0)? 'No Active':'Active';?></td>
                            <td>
                                <a href="edit-produk.php?id=<?php echo $row['Produk_id']?>">Edit</a> || <a href="proses-hapus.php?idp=<?php echo $row['Produk_id']?>" onclick="return confirm('Are You Sure ?')">Hapus</a>
                            </td>
                        </tr>
                        <?php }}else{ ?>
                            <tr>
                                <td colspan="7">No Data</td>
                            </tr>
                        
                        
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- Footer -->
    <footer>
        <div class="container">
            <small>Copyright &copy; 2023 - Warungku.</small>
        </div>
    </footer>
</body>
</html>