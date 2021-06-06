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

<div class="container">
	<div class="row">
		<div class="text-center mt-5 mb-3">
			<a class="btn text-light btn-info rounded-pill" href="index.php?top=konsultasifm.php">ULANG DIAGNOSA</a>
			<a class="btn text-light btn-warning rounded-pill" href="index.php?top=pasien_add_fm.php">BACK HOME</a>
		</div>
		<div class="col-4">
			<div class="col-12 text-light text-center bg-info py-2 px-3">
				<strong class="">IDENTITAS PENGGUNA</strong>
			</div>
			<div class="ml-3">
				<?php
					$query_pasien=mysqli_query($con,"SELECT * FROM pasien ORDER BY idpasien DESC");
					$data_pasien=mysqli_fetch_array($query_pasien);
				?>
				<label>Nama : <?php echo $data_pasien['nama'];?></label><hr>
				<label>Jenis Kelamin : <?php $lk=$data_pasien['kelamin']; if($lk=="L"){ echo "Laki-laki"; }else { echo "Perempuan";};?></label><hr>
				<label>Umur : <?php echo $data_pasien['umur'];?></label><hr>
				<label>Alamat : <?php echo $data_pasien['alamat'];?></label><hr>
				<label>Email : <?php echo $data_pasien['email'];?></label><hr>
			</div>
		</div>
		<div class="col-8">
			<div class="col-12 text-light text-center bg-info py-2 px-3 mb-2">
				<strong class="">GEJALA YANG DIALAMI</strong>
			</div>
			<?php
				$query_gejala_input=mysqli_query($con,"SELECT gejala.gejala AS namagejala,tmp_gejala.kd_gejala FROM gejala,tmp_gejala WHERE tmp_gejala.kd_gejala=gejala.kd_gejala");
				$nogejala=0;
				while($row_gejala_input=mysqli_fetch_array($query_gejala_input)){
					$nogejala++;?>
					<div class="text-secondary">
						<img src='images/checkbox.jpg' width='20' height='20'>
						<b >
							<?php 	echo $row_gejala_input['kd_gejala']; 
									echo " | ";
									echo $row_gejala_input['namagejala'] ;
							?>
						</b>
					</div>
			<?php } ?>
		</div>
		<div id="rumus1" class="rumus1">
			<div>
				<div class="col-12 text-center bg-info py-1 px-3">
					<h3 class="text-light">Proses Perhitungan Dengan Case Based Reasoning (CBR)</h3>
				</div>
				<p>Mencari Data Relasi Dari Gejala Yang dipilih, adalah sebagai berikut : </p>
				<?php
					$queryGKasusBaru=mysqli_query($con,"SELECT * FROM tmp_gejala");
					$arrKasusBaru=array();
					$arrSumBobotBaru=array();
					$arrNtotal=array();
					while($dataGKasusBaru=mysqli_fetch_array($queryGKasusBaru)){
						$arrKasusBaru[]=$dataGKasusBaru['kd_gejala'];
						}
					$arrBobotLama=array();
					?>
					<div style='border:1px solid blue;'>
						<p>Berikut ini adalah gejala yang dipilih, ini dinamakan dengan kasus baru :</p>
						<?php 
						foreach($arrKasusBaru as $kdGejala){
							print_r($kdGejala); echo "<br>";
							} 
						?>
					</div>
					<?php 
					$query_relasi=mysqli_query($con,"SELECT * FROM relasi WHERE kd_gejala IN(SELECT kd_gejala FROM tmp_gejala) GROUP BY kd_penyakit ASC");
					while($dataRelasi=mysqli_fetch_array($query_relasi)){
						echo "<p><strong>Data Kerusakan Yang Memiliki Relasi Ke Gejala Yang Terpilih Adalah : </strong></p>";
						echo $dataRelasi['kd_penyakit']."<br>";
						echo "<p>Cari Data Gejala dan Bobot di Kasus Lama Pada Jenis Kerusakan $dataRelasi[kd_penyakit]</p>";
						$queryGKasusLama=mysqli_query($con,"SELECT * FROM relasi WHERE kd_penyakit='$dataRelasi[kd_penyakit]' ORDER BY kd_penyakit ASC");
						echo "<div class='row'>";
							echo "<div class='col-md-1'>";
							echo "</div>";			
							echo "<div class='kasusLama col-md-5'>";
								echo "<p>Kasus Lama (basis pengetahuan pakar)</p>";
								while($dataGKasusLama=mysqli_fetch_array($queryGKasusLama)){
									echo $dataGKasusLama['kd_gejala']." | bobot[$dataGKasusLama[bobot]]"."<br>";
									$arrBobotLama[$dataGKasusLama['kd_gejala']]=$dataGKasusLama['bobot'];
									$kdGLama=$dataGKasusLama['kd_gejala']; 
									}
							echo "</div>";		
							echo "<div class='kasusBaru col-md-5'>";
								echo "<p>Kasus Baru (gejala dipilih)</p>";
									foreach($arrKasusBaru as $kdGejala){
									print_r($kdGejala); echo "<br>";
									}
							echo "</div>";
						echo "</div>";
						echo "<div class='Cleared'>";
							$sumBobotLama=array_sum($arrBobotLama);
							// echo "<p>Jumlah Bobot Kasus Lama = ".$sumBobotLama."</p>"; 
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
				}?> 
			</div>
		</div>
		<div class="col-12">
			<div class="text-center mb-3"><a id="tampilRumus" href="#"><strong>Tampilkan Detail Manual CBR</strong></a></div>
			<div class="col-12 text-center bg-info py-1 px-3">
				<h3 class="text-light">HASIL DIAGNOSA PENYAKIT MATA</h3>
			</div>
			<p style="color:#06F; font-weight:bold;">
				BERDASARKAN HASIL DIAGNOSA PENYAKIT MATA MAKA DIPEROLEH HASIL YANG TERDETEKSI PENYAKIT ADALAH :
			</p>
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
			?>
			<table class="table table-striped">
				<thead bgcolor="#f5e2ba">
					<tr>
						<th scope="col">No</th>
						<th scope="col">Gejala</th>
						<th scope="col">Nilai</th>
						<th scope="col">Presentase</th>
						<th scope="col">Definisi</th>
						<th scope="col">Solusi</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						foreach($arrNtotal as $kdK=>$Nilai){
							$queryK=mysqli_query($con,"SELECT * FROM penyakit_solusi WHERE kd_penyakit='$kdK' ");
							$dataK=mysqli_fetch_array($queryK);
							$persen=$Nilai/$TotalAkhir*100;
					?>
						<tr>
							<th scope="row">1</th>
							<td>
								<?php echo "[$kdK]" ?><strong><?php echo $dataK['nama_penyakit']; ?></strong> 
							</td>
							<td><?php echo substr($Nilai,0,5); ?></td>
							<td><?php echo substr($persen,0,5); ?></td>
							<td><p class='more'> <?php echo "$dataK[definisi]";?></p></td>
							<td><p class='more'> <?php echo "$dataK[solusi]";?></p></td>
						</tr>
					<?php 
						$query_hasil="INSERT INTO analisa_hasil(idpasien,kd_penyakit,persentase,tanggal) VALUES ('$idpasien','$kd_penyakit','$persen','$tanggal')";
						$res_hasil=mysqli_query($con,$query_hasil)or die(mysqli_error());
						}
						unset($arrNtotal);
					?>
				</tbody>
			</table>
			<div>
				<a class="btn btn-warning rounded-pill text-light" href="index.php?top=pasien_add_fm.php">Kembali</a>
			</div>
		</div>
	</div>
</div>