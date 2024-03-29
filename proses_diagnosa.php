<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Diagnosa Mata</title><br />
<style type="text/css">
p{ padding-left:2px; text-indent:0px;}
.konten p{ font-family:Arial, Helvetica, sans-serif; font-size:12pt;}
.kasusLama { border:1px solid #069; width:375px; float:left; min-height:210px; max-height:210px; overflow:scroll;}
.kasusLama p { background-color:#0CC;}
.kasusBaru { border:1px solid #069; width:375px; float:left; margin-left:2px; min-height:210px; max-height:210px; overflow:scroll; }
.kasusBaru p { background-color:#F90;}
.Cleared { position:fixed; width:750px; background:linear-gradient(to top, #9CC, #9CF);}

.morecontent span {
    display: none;
}
.morelink {
    display: block;
}
.rumus1 { display:none;}
</style>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="jquery.truncatable.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    // Configure/customize these variables.
    var showChar = 100;  // How many characters are shown by default
    var ellipsestext = "...";
    var moretext = "Detail&raquo;&raquo;";
    var lesstext = "TampilSedikit";
    

    $('.more').each(function() {
        var content = $(this).html();
 
        if(content.length > showChar) {
 
            var c = content.substr(0, showChar);
            var h = content.substr(showChar, content.length - showChar);
 
            var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
 
            $(this).html(html);
        }
 
    });
 
    $(".morelink").click(function(){
        if($(this).hasClass("less")) {
            $(this).removeClass("less");
            $(this).html(moretext);
        } else {
            $(this).addClass("less");
            $(this).html(lesstext);
        }
        $(this).parent().prev().toggle();
        $(this).prev().toggle();
        return false;
    });
	//show hide detail
	$("#tampilRumus").click(function(){
		$("#rumus1").fadeIn();
		});
});
</script>
</head>
<body>
<div class="konten">
<table width="100%" border="0" bgcolor="#0099FF" cellspacing="1" cellpadding="4" bordercolor="#0099FF">
  <tr bgcolor="#ffffff">
    <td height="32"  style="color:#C60;"><div style="text-align:center; background-color:#7500EA; color:#ffffff; font-family:Calibri; border-radius:50px 50px; height:25px; margin-bottom:8px;">
<a style="background-color:#CCC; cursor:pointer;" href="index.php?top=konsultasifm.php"><strong>ULANG DIAGNOSA</strong></a>
<a style="background-color:#CCC;" href="index.php?top=pasien_add_fm.php"><strong>BACK HOME</strong></a></div></td>
  </tr>
  <tr bgcolor="#ffffff">
    <td height="32"  style="color:#C60;"><table width="100%" border="1">
  <tr>
    <td width="27%"><div style='border-radius:50px 50px;background-color:#0099FF; padding:2px 2px 2px 5px; color:#ffffff;'><strong>IDENTITAS PENGGUNA</strong></div>
    <?php
    include "koneksi.php";
	$query_pasien=mysqli_query($con,"SELECT * FROM pasien ORDER BY idpasien DESC");
	$data_pasien=mysqli_fetch_array($query_pasien);
	echo "Nama : <br>". $data_pasien['nama'] . "<br>";
	echo "<hr>Jenis Kelamin :<br> ";
	$lk=$data_pasien['kelamin']; if($lk=="L"){ echo "Laki-laki"; }else { echo "Perempuan";}; echo "<br>";
	echo "<hr>Umur : <br>". $data_pasien['umur']. "<br>";
	echo "<hr>Alamat : <br>". $data_pasien['alamat']. "<br>";
	echo "<hr>Email : <br>". $data_pasien['email']. "<br>";
	echo "<hr>";
	?></td>
    <td width="73%">    <?php
    include "koneksi.php";
	echo "<div style='border-radius:50px 50px;background-color:#0099FF; padding:2px 2px 2px 5px; color:#ffffff;'><strong>GEJALA YANG DIALAMI</strong></div>";
	$query_gejala_input=mysqli_query($con,"SELECT gejala.gejala AS namagejala,tmp_gejala.kd_gejala FROM gejala,tmp_gejala WHERE tmp_gejala.kd_gejala=gejala.kd_gejala");
	$nogejala=0;
	while($row_gejala_input=mysqli_fetch_array($query_gejala_input)){
		$nogejala++;
		echo "<li style='list-style:none; font-size:9pt;'><img src='images/checkbox.jpg' width='20' height='20'><strong>".$row_gejala_input['kd_gejala']."|".$row_gejala_input['namagejala']. "</strong></li>";
		}
	?>
    <p></p></td>
  </tr>
</table>
</td>
  </tr>
  <tr bgcolor="#ffffff">
    <td height="32" style="font-family:'Courier New', Courier, monospace;">
     <div id="rumus1" class="rumus1"><div>
    <?php
    echo "<h3>Proses Perhitungan Dengan Case Based Reasoning (CBR)</h3><hr>";
	echo "<p>Mencari Data Relasi Dari Gejala Yang dipilih, adalah sebagai berikut : </p>";
	$queryGKasusBaru=mysqli_query($con,"SELECT * FROM tmp_gejala");
	$arrKasusBaru=array();
	$arrSumBobotBaru=array();
	$arrNtotal=array();
	while($dataGKasusBaru=mysqli_fetch_array($queryGKasusBaru)){
		$arrKasusBaru[]=$dataGKasusBaru['kd_gejala'];
		}
	$arrBobotLama=array();
	echo "<div style='border:1px solid blue;'>";
	echo "<p>Berikut ini adalah gejala yang dipilih, ini dinamakan dengan kasus baru :</p>";
	foreach($arrKasusBaru as $kdGejala){
		print_r($kdGejala); echo "<br>";
		} echo "</div>";
	$query_relasi=mysqli_query($con,"SELECT * FROM relasi WHERE kd_gejala IN(SELECT kd_gejala FROM tmp_gejala) GROUP BY kd_penyakit ASC");
	while($dataRelasi=mysqli_fetch_array($query_relasi)){
		echo "<p><strong>Data Kerusakan Yang Memiliki Relasi Ke Gejala Yang Terpilih Adalah : </strong></p>";
		echo $dataRelasi['kd_penyakit']."<br>";
		echo "<p>Cari Data Gejala dan Bobot di Kasus Lama Pada Jenis Kerusakan $dataRelasi[kd_penyakit]</p>";
			$queryGKasusLama=mysqli_query($con,"SELECT * FROM relasi WHERE kd_penyakit='$dataRelasi[kd_penyakit]' ORDER BY kd_penyakit ASC");
			echo "<div class='kasusLama'>";
			echo "<p>Kasus Lama (basis pengetahuan pakar)</p>";
			while($dataGKasusLama=mysqli_fetch_array($queryGKasusLama)){
				echo $dataGKasusLama['kd_gejala']." | bobot[$dataGKasusLama[bobot]]"."<br>";
				$arrBobotLama[$dataGKasusLama['kd_gejala']]=$dataGKasusLama['bobot'];
				$kdGLama=$dataGKasusLama['kd_gejala']; 
				}
			echo "</div>";		
			echo "<div class='kasusBaru'>";
			echo "<p>Kasus Baru (gejala dipilih)</p>";
				foreach($arrKasusBaru as $kdGejala){
				print_r($kdGejala); echo "<br>";
				}
			echo "</div>";
			echo "<div class='Cleared'>";
				$sumBobotLama=array_sum($arrBobotLama);
				echo "<p>Jumlah Bobot Kasus Lama = ".$sumBobotLama."</p>"; 
			echo "</div>";
			echo "<p>Menghitung Nilai Similarity :</p>";
			echo "<img width='400' style='border:1px solid #ccffcc;' src='images/rumus.jpg'><br>";
			echo "<p>Similarity(X,$dataRelasi[kd_penyakit])="; $kd_penyakit=$dataRelasi['kd_penyakit'];
					$arrayKeys = array_keys($arrBobotLama);
					$lastArrayKey = array_pop($arrayKeys);
					echo "<span style='border-bottom:1px solid #000000;'><strong>[</strong>";
					foreach($arrBobotLama as $kdG=>$bobotLama){
							if(in_array($kdG,$arrKasusBaru)){
								$kaliBobot=1*$bobotLama; $arrSumBobotBaru[]=$kaliBobot;
								if($kdG == $lastArrayKey) {
									echo "(1*$bobotLama)";
									 }else{ echo "(1*$bobotLama)+"; }
								
							}else { 
								$kaliBobot=0*$bobotLama; $arrSumBobotBaru[]=$kaliBobot;
								if($kdG == $lastArrayKey) {
									echo "(0*$bobotLama)";
									 }else{ echo "(0*$bobotLama)+"; }
							}
						} 
						$jumlahAtas=array_sum($arrSumBobotBaru);
						echo "<strong>]</strong> = $jumlahAtas</span><br>";
						echo "<span style='margin-left:200px;'>";
								foreach($arrBobotLama as $gBaru=>$bobotBaru){
									if($gBaru == $lastArrayKey) {
									echo "$bobotBaru";
									 }else{ echo "$bobotBaru+"; }
									}
						echo "</span> ";
						$jumlahBawah=array_sum($arrBobotLama);
						echo "= $jumlahBawah<br>";
						$totalNilai=$jumlahAtas/$jumlahBawah;
						echo "<span style='margin-left:145px;'>= $totalNilai</span>";
			echo "</p>";
			$arrNtotal[$kd_penyakit]=$totalNilai;
			unset($arrBobotLama); unset($sumBobotLama);	unset($arrSumBobotBaru);
		}
	?> </div></div> 
    </td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td align="center">
    <span><a id="tampilRumus" href="#"><strong>Tampilkan Detail Manual CBR</strong></a></span>
    <div style='border-radius:50px 50px;background-color:#0099FF; text-align:center; padding:2px 2px 2px 5px; color:#ffffff;'><strong>HASIL DIAGNOSA PENYAKIT MATA</strong></div>
<p style="color:#06F; font-weight:bold;">BERDASARKAN HASIL DIAGNOSA PENYAKIT MATA MAKA DIPEROLEH HASIL YANG TERDETEKSI PENYAKIT ADALAH :</p>
<?php
$query_temp=mysqli_query($con,"SELECT * FROM pasien ORDER BY idpasien DESC") or die(mysqli_error());
			$row_pasien=mysqli_fetch_array($query_temp)or die(mysqli_error());
			$idpasien=$row_pasien['idpasien'];
			$nama=$row_pasien['nama'];
			$kelamin=$row_pasien['kelamin'];
			$umur=$row_pasien['umur'];
			$alamat=$row_pasien['alamat'];
			$email=$row_pasien['email'];
			$tanggal =$row_pasien['tanggal'];
arsort($arrNtotal);
$TotalAkhir=array_sum($arrNtotal);
//echo $TotalAkhir;
foreach($arrNtotal as $kdK=>$Nilai){
	$queryK=mysqli_query($con,"SELECT * FROM penyakit_solusi WHERE kd_penyakit='$kdK' ");
	$dataK=mysqli_fetch_array($queryK);
	$persen=$Nilai/$TotalAkhir*100;
	echo "[$kdK]<strong>".$dataK['nama_penyakit']."</strong> dengan Nilai = ".substr($Nilai,0,5).", Persentase ".substr($persen,0,5)."%<br>";
	echo "<p class='more'>Definisi Penyakit : $dataK[definisi]</p>";
	echo "<p class='more'>Solusi : $dataK[solusi]</p><hr>";
	$query_hasil="INSERT INTO analisa_hasil(idpasien,kd_penyakit,persentase,tanggal) VALUES ('$idpasien','$kd_penyakit','$persen','$tanggal')";
			$res_hasil=mysqli_query($con,$query_hasil)or die(mysqli_error());
	}
	unset($arrNtotal);
	
?>
</td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td><a href="index.php?top=pasien_add_fm.php"><strong>&laquo;&laquo;Kembali</strong></a>
    </td>
  </tr>
</table>
</div>
</body>
</html>