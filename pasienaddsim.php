<?php 
include "koneksi.php";
# Baca variabel Form (If Register Global ON)
$TxtNama 	= $_POST['TxtNama'];
$RbKelamin 	= $_POST['cbojk'];
$TxtUmur	= $_POST['TxtUmur'];
$TxtAlamat 	= $_POST['TxtAlamat'];
$email=$_POST['textemail'];
$NOIP = $_SERVER['REMOTE_ADDR'];
# Validasi Form
if (trim($TxtNama)=="") {
	include "PasienAddFm.php";
	echo "Nama belum diisi, ulangi kembali";
}
elseif (trim($TxtUmur)=="") {
	include "PasienAddFm.php";
	echo "Umur masih kosong, ulangi kembali";
}
elseif (trim($TxtAlamat)=="") {
	include "Pasienaddfm.php";
	echo "Alamat masih kosong, ulangi kembali";
}
else {
    $NOIP = $_SERVER['REMOTE_ADDR'];
	$sql  = " INSERT INTO pasien (nama,kelamin,umur,alamat,email,tanggal) 
		 	  VALUES ('$TxtNama','$RbKelamin','$TxtUmur','$TxtAlamat','$email',NOW())";
	mysqli_query($con,$sql) 
		  or die ("SQL Error 2".mysqli_error());
	
	$sqlhapus = "DELETE FROM tmp_penyakit ";
	mysqli_query($con,$sqlhapus) or die ("SQL Error 1".mysqli_error());
	
	$sqlhapus2 = "DELETE FROM tmp_analisa ";
	mysqli_query($con,$sqlhapus2) or die ("SQL Error 2".mysqli_error());
			
	$sqlhapus3 = "DELETE FROM tmp_gejala ";
	mysqli_query($con,$sqlhapus3) or die ("SQL Error 3".mysqli_error());
#	$sqlhapus4 = "DELETE FROM analisa_hasil WHERE noip='$NOIP'";
#	mysqli_query($sqlhapus4, $koneksi) or die ("SQL Error 4".mysqli_error());	
	echo "<meta http-equiv='refresh' content='0; url=index.php?top=konsultasifm.php'>";
}
?>