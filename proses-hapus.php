<?php

    include 'db_bukawarung.php';

    if(isset($_GET['idk'])){
        $delete = mysqli_query($rae, "DELETE FROM tb_kategori WHERE Kategori_id = '".$_GET['idk']."' ");
        echo '<script>window.location="data-kategori.php"</script>';
    }

   if(isset($_GET['idp'])){
        $produk = mysqli_query($rae,"SELECT Produk_image FROM tb_produk WHERE Produk_id = '".$_GET['idp']."' ");
        $p = mysqli_fetch_object($produk);

        unlink('./produk/'.$p->Produk_image);
        $delete = mysqli_query($rae, "DELETE FROM tb_produk WHERE Produk_id = '".$_GET['idp']."' ");
        echo '<script>window.location="data-produk.php"</script>';
   } 
?>