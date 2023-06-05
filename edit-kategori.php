<?php
    session_start();
    include 'db_bukawarung.php';
    if($_SESSION['status_login'] != true){
    echo '<script>window.location="login.php"</script>';
    }

    $kategori = mysqli_query($rae, "SELECT * FROM tb_kategori WHERE Kategori_id ='".$_GET['id']."' ");
    if(mysqli_num_rows($kategori)== 0){
        echo '<script>window.location="data-kategori.php"</script>';
    }
    $k = mysqli_fetch_object($kategori);
    // var_dump($_SESSION['a_global']->Admin_id);
    // var_dump("SELECT * FROM tb_admin WHERE admin_id = '".$_SESSION['id']."' ");
    // var_dump($d);
    // die;
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
            <h3>Edit Data Category</h3>
            <div class="box">
                <form action="" method="POST">
                    <input type="text" name="nama" placeholder="Category Name" class="input-control" value="<?php echo $k-> Kategori_name ?>" required>
                    <input type="submit" name="submit" value="Edit Category Data" class="btn">
                </form>
                <?php 
                    if(isset($_POST['submit'])){

                        $nama= ucwords($_POST['nama']);

                        $update = mysqli_query($rae, "UPDATE tb_kategori SET 
                                                Kategori_name = '".$nama."'
                                                WHERE Kategori_id = '".$k->Kategori_id."' ");
                    if($update){
                        echo '<script>alert("Edit Data Successfully")</script>';
                        echo '<script>window.location="data-kategori.php"</script>';
                    }else{
                        echo 'gagal'.mysqli_error($rae);
                    }
                    }
                ?>
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