<div class="art-post">
  <div class="art-post-body">
    <div class="art-post-inner art-article">
      <h1>Daftar Penyakit</h1>
      <div class="art-postcontent">
        <table class="table table-striped">
          <tr bgcolor="#f5e2ba">
            <td class="text-center" colspan="4"><b>DAFTAR PENYAKIT MATA YANG TERDAPAT DALAM SISTEM INI</b></td>
          </tr>
          <tr bgcolor="#DBEAF5"> 
            <td class="text-center"><b>No</b></td>
            <td class="text-center"><strong>Deskripsi  Penyakit</strong></td>
            <td class="text-center"><strong>Definisi Penyakit </strong></td>
            <td class="text-center"><strong>Solusi</strong></td>
          </tr>
          <?php 
          $sql = "SELECT * FROM penyakit_solusi ORDER BY kd_penyakit";
          $qry = mysqli_query($con,$sql) or die ("SQL Error".mysqli_error());
          $no=0;
          while ($data=mysqli_fetch_array($qry)) {
          $no++;
          ?>
          <tr bgcolor="#FFFFFF"> 
            <td>
              <div class="text-center pt-3"><?php echo $no; ?></div>
            </td>
            <td>
              <div><?php echo "<h3><em>$data[nama_penyakit]</em></h3>"; ?></div>
            </td>
            <td>
              <p><?php echo "$data[definisi]";?></p>
            </td>
            <td>
              <p><?php echo "$data[solusi]";?></p>
            </td>
          </tr>
          <?php
          }
          ?>
        </table>
      </div>
    </div>
  </div>
</div>