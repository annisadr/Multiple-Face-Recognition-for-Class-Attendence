<?php 

include "../config/koneksi.php";

$jadwal = $_POST['idjadwal'];
$idkelas = $_POST['idkelas'];

 $sql = "
      SELECT a.* , 
      CASE
          WHEN b.statushadir = 'A' THEN 'Alfa'
          WHEN b.statushadir = 'I' THEN 'Izin'
          WHEN b.statushadir = 'H' THEN 'Hadir'
          WHEN b.statushadir = 'S' THEN 'Sakit'
          ELSE 'Alfa'
      END as status 
      FROM akademik.ak_krs a 
      LEFT OUTER JOIN (
        SELECT nim, statushadir
        FROM akademik.ak_absensimhs
        WHERE idjadwal = ".$jadwal."
            )b ON a.nim = b.nim
      WHERE idkelas='".$idkelas."'

";

$hasil = pg_exec($sql);
$no = 1;
  while($data=pg_fetch_array($hasil)){
    $var[] = [
      'no' => $no,
      'nim' => $data['nim'],
      'status' => $data['status'],
    ];
    $no++;
  }
echo json_encode($var)

?>