<?php
    session_start();
    include 'db_bukawarung.php';
    if($_SESSION['status_login'] != true){
    echo '<script>window.location="login.php"</script>';
    }

    $produk = mysqli_query($rae, "SELECT * FROM tb_produk WHERE Produk_id = '".$_GET['id']."' ");
    if(mysqli_num_rows($produk) ==0){
        echo '<script>window.location="data-produk.php"</script>';
    }
    $p = mysqli_fetch_object($produk);
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
    <script src="https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>
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
            <h3>Edit Data Product</h3>
            <div class="box">
                <form action="" method="POST" enctype="multipart/form-data">
                    <select class="input-control" name="kategori" required>
                        <option value="">--Choose--</option>
                        <?php 
                            $kategori = mysqli_query($rae, "SELECT * FROM tb_kategori ORDER BY Kategori_id DESC");
                            while($r = mysqli_fetch_array($kategori)){
                        ?>
                        <option value="<?php echo $r['Kategori_id']?>" <?php echo ($r['Kategori_id'] == $p->Kategori_id)? 'selected': ''; ?>><?php echo $r['Kategori_name']?></option>
                        <?php } ?>
                    </select>

                    <input type="text" name="nama" class="input-control" placeholder="Product Name" value= "<?php echo $p->Produk_name ?>" required>
                    <input type="text" name="price" class="input-control" placeholder="Price" value= "<?php echo $p->Produk_price ?>" required>


                    <img src="produk/<?php echo $p->Produk_image ?>" width="250px">
                    <input type="hidden" name="foto" value="<?php echo $p->Produk_image ?>">
                    <input type="file" name="gambar" class="input-control">
                    <textarea class="input-control" name="deskripsi" placeholder="Description">"<?php echo $p->Produk_description ?>"</textarea><br>
                    <select class="input-control" name="status">
                        <option value="">--Choose--</option>
                        <option value="1" <?php echo ($p->Produk_status == 1)? 'selected':'';?>>--Active--</option>
                        <option value="0" <?php echo ($p->Produk_status == 0)? 'selected':'';?>>--Non Active--</option>
                    </select>
                    <input type="submit" name="submit" value="Submit" class="btn">
                </form>
                <?php 
                    if(isset($_POST['submit'])){
                        // data inputan dari form
                        $kategori   = $_POST['kategori'];
                        $nama       = $_POST['nama'];
                        $price      = $_POST['price'];
                        $deskripsi  = $_POST['deskripsi'];
                        $status     = $_POST['status'];
                        $foto       = $_POST['foto'];

                        // data gambar yang baru
                        $filename = $_FILES['gambar']['name'];
                        $tmp_name = $_FILES['gambar']['tmp_name'];

                        

                        // jika admin ganti gambar
                        if($filename != ''){
                            $type1 = explode('.', $filename);
                            $type2 = $type1[1];

                            $newname = 'produk'.time().'.'.$type2;
                        // Menampung Data Format File Yang Diizinkan
                        $tipe_diizinkan = array('jpg','jpeg','png','gif');
                            // Validasi Format File
                            if(!in_array($type2,$tipe_diizinkan)){
                                // jika format file tidak ada di dalam tipe diizinkan
                                echo '<script>alert("File format not allowed")</script>';
                            }else{
                                unlink('./produk/'.$foto);
                                move_uploaded_file($tmp_name,'./produk/'.$newname);
                                $namagambar = @$newname;

                            }
                        }else{
                            // jika admin tidak ganti gambar
                            $namagambar = $foto;

                        }

                        // query update data produk
                        $update = mysqli_query($rae, "UPDATE tb_produk SET 
                                                Kategori_id = '".$kategori."',
                                                Produk_name = '".$nama."',
                                                Produk_price = '".$price."',
                                                Produk_description = '".$deskripsi."',
                                                Produk_image = '".$namagambar."',
                                                Produk_status = '".$status."'
                                                WHERE Produk_id = '".$p->Produk_id."'  ");
                        
                        if($update){
                            echo '<script>alert("data change successfully")</script>';
                            echo '<script>window.location="data-produk.php"</script>';
                        }else{
                            echo 'fail'.mysqli_error($rae);
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
    <script>
      CKEDITOR.replace( 'deskripsi' );
    </script>
</body>
</html>