<?php
require_once "core/init.php";

if( !isset($_SESSION['user']) ){
  die('0');
}

// echo $_POST['isi_komentar'] . ", ini dari php";
if( $_POST['type'] == "insert" ){

  if(tambah_komentar(3, $_POST['isi_komentar'])){
    $lastId = $conn->lastInsertId();
    // echo $lastId;
    // echo "<p>".$_POST['isi_komentar']."</p>";
    /* ubah bagian dibawah ini dan sama kan dengan bagian frontend nya, agar masalah saat menambah data teratasi (text nya akan mempunyai tombol edit) */
    echo "
    <p id='komentar_". $lastId ."'>" .$_POST['isi_komentar']. "
      <button type='button' class='hapus_komentar' data-id='". $lastId ."'>Hapus</button>
    </p>";
  }else{
    echo "error";
  }
}

if( $_POST['type'] == "delete" ){

  if(hapus_komentar($_POST['id_komentar'])){
    echo "1";
  }else{
    echo "-1";
  }
}

if( $_POST['type'] == "update" ){

  if(update_komentar($_POST['id_komentar'], $_POST['isi_komentar'])){
    echo "1";
  }else {
    echo "-1";
  }
}




?>
