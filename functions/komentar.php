<?php

function tampilkan()
{
  global $conn;
  $rows = [];
  $sql = $conn->prepare("SELECT * FROM komentar ORDER BY id_komentar DESC");
  $sql->execute();
  // $rows = $sql->fetch(PDO::FETCH_ASSOC);
  while($data = $sql->fetch(PDO::FETCH_ASSOC)){
    $rows[] = $data;
  }
  return $rows;
  // die(var_dump($rows));
}

function tambah_komentar($id, $komentar)
{
  global $conn;

  $params = [
        ':id'  => $id,
        ':isi' => $komentar
  ];

  $sql = "INSERT INTO komentar (id_user, isi_komentar) VALUES (:id, :isi)";
  $status = $conn->prepare($sql)->execute($params);

  if ($status) return true;
    else return false;
}

function hapus_komentar($id)
{
  global $conn;

  $where = [':id' => $id];

  $sql = "DELETE FROM komentar WHERE id_komentar =:id";
  $status = $conn->prepare($sql)->execute($where);

  if($status) return true;
    else return false;
}

function update_komentar($id, $isi)
{
  global $conn;

  $row = [
    ':id' => $id,
    ':isi' => $isi
  ];

  $sql = "UPDATE komentar SET isi_komentar=:isi WHERE id_komentar=:id";
  // die($sql);
  $status = $conn->prepare($sql)->execute($row);
  if ($status) return true;
    else return false;
}


?>
