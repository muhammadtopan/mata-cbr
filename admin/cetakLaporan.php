<html>
<head>
<title>Cetak Laporan</title>
<link rel="stylesheet" type="text/css" href="../jquery-ui.css">
<script type="text/javascript" src="../jquery.min.js"></script>
<script type="text/javascript" src="../jquery-ui.js"></script>
<script type="text/javascript" src="../jquery.printElement.js"></script>
<script type="text/javascript">
		$(document).ready(function(){
			$("#tabel1").printElement();
			});
</script>
</head>
<body>
<div class="CSSTableGenerator">

<table id="tabel1" width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#22B5DD">
  <tr style="background:linear-gradient(to top, #9CF, #9FF);"> 
    <td colspan="11"><div align="center"><strong>LAPORAN DATA PENGGUNA</strong></div></td>
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
	$tglawal=$_GET['awal']; 
	$tglakhir=$_GET['akhir'];
	$sql = "SELECT * FROM pasien WHERE tanggal BETWEEN '$tglawal' AND '$tglakhir' ORDER BY idpasien DESC";
	$qry = mysqli_query($con,$sql)  or die ("SQL Error".mysqli_error());
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
    <td><?php echo $data['tanggal']; ?>&nbsp;</td>
  </tr>
  <?php
  }
  ?>
</table>
</div>
</body>
</html>