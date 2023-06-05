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
            <h3>Add Product</h3>
            <div class="box">
                <form action="" method="POST" enctype="multipart/form-data">
                    <select class="input-control" name="kategori" required>
                        <option value="">--Choose--</option>
                        <?php 
                            $kategori = mysqli_query($rae, "SELECT * FROM tb_kategori ORDER BY Kategori_id DESC");
                            while($r = mysqli_fetch_array($kategori)){
                        ?>
                        <option value="<?php echo $r['Kategori_id']?>"><?php echo $r['Kategori_name']?></option>
                        <?php } ?>
                    </select>
                    <input type="text" name="nama" class="input-control" placeholder="Product Name" required>
                    <input type="text" name="price" class="input-control" placeholder="Price" required>
                    <input type="file" name="gambar" class="input-control"  required>
                    <textarea class="input-control" name="deskripsi" placeholder="Description"></textarea><br>
                    <select class="input-control" name="status">
                        <option value="">--Choose--</option>
                        <option value="1">--Active--</option>
                        <option value="0">--Non Active--</option>
                    </select>
                    <input type="submit" name="submit" value="Add Product" class="btn">
                </form>
                <?php 
                    if(isset($_POST['submit'])){
                        
                        //print_r($_FILES['gambar']);
                        // Menampung Inputan Dari Form
                        $kategori   = $_POST['kategori'];
                        $nama       = $_POST['nama'];
                        $price      = $_POST['price'];
                        $deskripsi  = $_POST['deskripsi'];
                        $status     = $_POST['status'];
                        // Menanpung Data File Yang Diupload
                         $filename = $_FILES['gambar']['name'];
                         $tmp_name = $_FILES['gambar']['tmp_name'];

                         $type1 = explode('.', $filename);
                         // Format File
                         $type2 = $type1[1];

                         $newname = 'produk'.time().'.'.$type2;

                        // Menampung Data Format File Yang Diizinkan
                        $tipe_diizinkan = array('jpg','jpeg','png','gif');
                        // Validasi Format File
                        if(!in_array($type2,$tipe_diizinkan)){
                            // jika format file tidak ada di dalam tipe diizinkan
                            echo '<script>alert("File format not allowed")</script>';
                        }else{
                            // Jika format file sesuai dengan yang ada di dalam array tipe diizinkan
                            // Proses Upload file Sekaligus Insert Ke Database
                            move_uploaded_file($tmp_name,'./produk/'.$newname);

                            $insert = mysqli_query($rae,"INSERT INTO tb_produk VALUES (
                                    null,
                                    '".$kategori."',
                                    '".$nama."',
                                    '".$price."',
                                    '".$deskripsi."',
                                    '".$newname."',
                                    '".$status."',
                                    null
                                        )");

                            if($insert){
                                echo '<script>alert("data save successfully")</script>';
                                echo '<script>window.location="data-produk.php"</script>';
                            }else{
                                echo 'fail'.mysqli_error($rae);
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
    <script>
      CKEDITOR.replace( 'deskripsi' );
    </script>
</body>
</html>