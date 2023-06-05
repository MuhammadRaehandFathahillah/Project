<?php
    session_start();
    include 'db_bukawarung.php';
    if($_SESSION['status_login'] != true){
    echo '<script>window.location="login.php"</script>';
    }

    $query = mysqli_query($rae, "SELECT * FROM tb_admin WHERE admin_id = '".$_SESSION['a_global']->Admin_id."' ");
    $d = mysqli_fetch_object($query);
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
            <h3>Profil</h3>
            <div class="box">
                <form action="" method="POST">
                    <input type="text" name="nama" placeholder="Full Name" class="input-control" value="<?php echo $d->Admin_name ?>" required>
                    <input type="text" name="user" placeholder="Username" class="input-control" value="<?php echo $d->Username ?>" required>
                    <input type="text" name="hp" placeholder="No HP" class="input-control" value="<?php echo $d->Admin_telp ?>" required>
                    <input type="email" name="email" placeholder="Email" class="input-control" value="<?php echo $d->Admin_email ?>" required>
                    <input type="text" name="alamat" placeholder="Address" class="input-control" value="<?php echo $d->Admin_address ?>" required>
                    <input type="submit" name="submit" value="Change Profil" class="btn">
                </form>
                <?php
                    if(isset($_POST['submit'])){
                        $nama   = ucwords($_POST['nama']);
                        $user   = $_POST['user'];
                        $hp     = $_POST['hp'];
                        $email  = $_POST['email'];
                        $alamat = ucwords($_POST['alamat']);

                        $update = mysqli_query($rae,"UPDATE tb_admin SET 
                                        Admin_name ='".$nama."',
                                        Username ='".$user."',
                                        Admin_telp ='".$hp."',
                                        Admin_email ='".$email."',
                                        Admin_address ='".$alamat."'
                                        WHERE Admin_id = '".$d->Admin_id."' ");
                        if($update){
                            echo '<script>alert("Change Data Successful")</script>';
                            echo '<script>window.location="profil.php"</script>';
                        }else{
                            echo 'gagal '.mysqli_error($rae);
                        }
                    }
                ?>
            </div>

            <h3>Change Password</h3>
            <div class="box">
                <form action="" method="POST">
                    <input type="password" name="pass1" placeholder="New Password" class="input-control" required>
                    <input type="password" name="pass2" placeholder="Confirm Password" class="input-control" required>
                    <input type="submit" name="change_password" value="Change Password" class="btn">
                </form>
                <?php
                    if(isset($_POST['change_password'])){

                        $pass1   = $_POST['pass1'];
                        $pass2   = $_POST['pass2'];

                        if($pass2 != $pass1){
                            echo '<script>alert("Confirm the new password does not match")</script>';
                        }else{
                            $u_pass = mysqli_query($rae,"UPDATE tb_admin SET
                                        password ='".MD5($pass1)."'
                                        WHERE Admin_id = '".$d->Admin_id."' ");
                            if($u_pass){
                                echo '<script>alert("Change Data Successful")</script>';
                                echo '<script>window.location="profil.php"</script>';
                            }else{
                                echo 'gagal '.mysqli_error($rae);
                            }
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