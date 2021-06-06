<script type="text/javascript">
	$(document).ready(function()
		{
			$("form").submit(function()
			{
				if (!isCheckedById("gejala"))
				{
					alert ("Anda Belum Memilih Gejala Apapun\nSilahkan Pilih Gejala..!");
					return false;
				}else{				
					return true; //submit the form
					}				
			});
			function isCheckedById(id)
			{
				var checked = $("input[@id="+id+"]:checked").length;
				if (checked == 0)
				{
					return false;
				}
				else
				{
					return true;
				}
			}
			// pilih bobot
			function isCheckedById2(id)
			{
				var checked = $("option[@id="+id+"]:checked").length;
				if (checked =="")
				{
					return false;
				}
				else
				{
					return true;
				}
			}
			//--
		});
</script>
<div class="konten">
	<h2 class="text-center text-secondary">Form Konsultasi : Pilih Gejala Yang Dialami</h2>
	<form  method="post" name="form" target="_self" action="?top=konsulperiksa.php">
	<table class="table table-striped">
		<thead bgcolor="#f5e2ba">
			<tr>
			<th scope="col" class="text-center">No</th>
			<th scope="col" class="text-center">Pilih</th>
			<th scope="col" class="text-center">Gejala</th>
			</tr>
		</thead>
		<tbody>
			<?php
			include "koneksi.php";
			$query=mysqli_query($con,"SELECT * FROM gejala") or die("Query Error..!" .mysqli_error);
			$no=0;
			while ($row=mysqli_fetch_array($query)){
			$no++;
			?>
				<tr>
					<th scope="row" class="text-center"><?php echo $no ?></th>
					<td class="text-center"><input type="checkbox" name="gejala[]" id="gejala" value="<?php echo $row['kd_gejala'];?>"></td>
					<td><label for=""><?php echo "[".$row['kd_gejala']."] ".$row['gejala'];?></label></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
	<div class="row mt-5">
		<div class="text-center">
		<button type="submit" name="Submit" class="btn btn-info col-md-3 rounded-pill">Proses Diagnosa</button>
		<button type="reset" class="btn btn-warning col-md-3 rounded-pill">Reset</button>
		</div>
	</div>
	</form>
</div>