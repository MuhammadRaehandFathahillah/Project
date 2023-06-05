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
            <h3>Category Data</h3>
            <div class="box">
                <p><a href="Tambah-kategori.php">Add Data</a></p>
                <br>
                <table border ="1" cellspacing = "0" class="table" >
                    <thead>
                        <tr>
                            <th width="40px">No</th>
                            <th>Category</th>
                            <th width="150px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no =1;
                            $kategori = mysqli_query($rae,"SELECT * FROM tb_kategori ORDER BY Kategori_id DESC");
                            if(mysqli_num_rows($kategori) > 0){
                            while ($row = mysqli_fetch_array($kategori)) {
                        ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $row['Kategori_name']?></td>
                            <td>
                                <a href="edit-kategori.php?id=<?php echo $row['Kategori_id']?>">Edit</a> || <a href="proses-hapus.php?idk=<?php echo $row['Kategori_id']?>" onclick="return confirm('Are You Sure ?')">Hapus</a>
                            </td>
                        </tr>
                        <?php }}else{ ?>
                            <tr>
                                <td colspan="3">No Data</td>
                            </tr>
                            <?php } ?>
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