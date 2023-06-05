<?php
    session_start();
    include 'db_bukawarung.php';
    if($_SESSION['status_login'] != true){
    echo '<script>window.location="login.php"</script>';
    }
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
            <li><a href="data-produk.php">Product Data</a></li>
            <li><a href="logout.php">Logout</a></li>
            </ul>
            </div>
    </header>

    <!-- content -->
    <div class="section">
        <div class="container">
            <h3>Add Category Data</h3>
            <div class="box">
                <form action="" method="POST">
                    <input type="text" name="nama" placeholder="Category Name" class="input-control" required>
                    <input type="submit" name="submit" value="Add Category Data" class="btn">
                </form>
                <?php 
                    if(isset($_POST['submit'])){

                        $nama= ucwords($_POST['nama']);

                        $insert = mysqli_query($rae, " INSERT INTO tb_kategori VALUES (
                                            null,
                                            '".$nama."') ");
                    if($insert){
                        echo '<script>alert("Add Data Successfully")</script>';
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