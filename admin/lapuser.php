<html>
<head>
<link rel="stylesheet" type="text/css" href="../jquery-ui.css">
<script type="text/javascript" src="../jquery-1.10.2.js"></script>
<script type="text/javascript" src="../jquery-ui.js"></script>
<script type="text/javascript" src="../jquery.printElement.js"></script>
<script type="text/javascript">
$(function() {
    $( "#tglawal" ).datepicker({showOn: "both", buttonImage: "../images/calendar.png", buttonImageOnly: true, nextText: "", prevText: "", changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd"});
	$( "#tglakhir" ).datepicker({showOn: "both", buttonImage: "../images/calendar.png", buttonImageOnly: true, nextText: "", prevText: "", changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd"});
  });
function konfirmasi(id_user){
	var kd_hapus=id_user;
	var url_str;
	url_str="hapus_user.php?id_user="+kd_hapus;
	var r=confirm("Yakin ingin menghapus data..?"+kd_hapus);
	if (r==true){   
		window.location=url_str;
		}else{
			//alert("no");
			}
	}
	function print_tabel(){
	$("#tabel1").printElement();
	}
</script>
</head>
<body>
<h2>Laporan Data Pengguna</h2>
<form name="form1" method="post"><span>Mulai Tanggal</span>
<input type="text" placeholder="Tanggal Awal" name="tglawal" id="tglawal" size="10">
<form name="form1"><span>Sampai Dengan</span>
<input type="text" placeholder="Sampai Dengan" name="tglakhir" id="tglakhir" size="10">&nbsp;&nbsp;&nbsp;
<input type="submit" name="submit" value="Cari Data">
<a target="_blank" href="cetakLaporan.php?awal=<?php echo $_POST['tglawal'];?>&akhir=<?php echo $_POST['tglakhir'];?>">Cetak Laporan</a>
</form><br>
<div class="CSSTableGenerator">

<table id="tabel1" width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#22B5DD">
  <tr style="background:linear-gradient(to top, #9CF, #9FF);"> 
    <td colspan="11"><div align="center"><strong>Laporan Pengguna </strong></div></td>
  </tr>
  <tr style="background:linear-gradient(to top, #9CF, #9FF);"> 
    <td width="28"><div align="center"><strong>No</strong></div></td>
    <td width="137"><div align="center"><b>Nama</b></div></td>
    <td width="139"><strong>Kelamin</strong></td>
    <td width="140"><strong>Umur</strong></td>
    <td width="70"><div align="center"><strong>Email</strong></div></td>
    <td width="155" align="center"><div align="center"><strong>Alamat</strong></div></td>
    <td width="251" align="center"><div align="center"><strong>Penyakit Yang diderita </strong></div></td>
    <td width="115" align="center"><strong>Tanggal Diagnosa</strong> </td>
  </tr>
  <?php 
  include "../koneksi.php";
  			if(isset($_POST['submit'])){ echo "post";}else{ echo "not";}
			if(isset($_POST['submit'])){
	$tglawal=$_POST['tglawal']; 
	$tglakhir=$_POST['tglakhir'];
	$sql = "SELECT * FROM pasien WHERE tanggal BETWEEN '$tglawal' AND '$tglakhir' ORDER BY idpasien DESC";
	$qry = mysqli_query($con,$sql)  or die ("SQL Error".mysqli_error());
	}else {
		$sql="SELECT * FROM pasien ORDER BY idpasien DESC";
		$qry = mysqli_query($con,$sql)  or die ("SQL Error".mysqli_error());
		}
	
	$no=0;
	while ($data=mysqli_fetch_array($qry)) {
	$no++;
  ?>
  <tr bgcolor="#FFFFFF"> 
    <td><?php echo $no; ?></td>
    <td><?php echo $data['nama'];?></td>
    <td><?php echo $data['kelamin'];?></td>
    <td><?php echo $data['umur'];?></td>
    <td><?php echo $data['email'];?></td>
    <td><?php echo $data['alamat'];?></td>
    <td><?php
	$id_pasien=$data['idpasien'];
    $strHasil=mysqli_query($con,"SELECT * FROM analisa_hasil,penyakit_solusi WHERE analisa_hasil.idpasien='$id_pasien' AND analisa_hasil.kd_penyakit=penyakit_solusi.kd_penyakit ORDER BY analisa_hasil.persentase DESC ");
	while($dataHasil=mysqli_fetch_array($strHasil)){
		echo "(".$dataHasil['kd_penyakit'].")"." ".$dataHasil['nama_penyakit']."(".$dataHasil['persentase'].")<br>";
		}
	?></td>
    <td><?php echo $data['tanggal']; ?>&nbsp;|<a title="hapus pengguna" style="cursor:pointer;" onClick="return konfirmasi('<?php echo $data['idpasien'];?>')"><img src="image/hapus.jpeg" width="16" height="16" ></a></td>
  </tr>
  <?php
  }
  ?>
</table>
</div>
</body>
</html>