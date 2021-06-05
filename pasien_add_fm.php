
<h1 class="text-secondary">Registrasi Pengguna</h1>

  <script type="text/javascript">
    $(document).ready(function(){
      $("#TxtNama").focus();
      })
    function validasi(form){
    if(form.TxtNama.value==""){
      alert("Masukkan nama !");
      form.TxtNama.focus(); return false;
      }else if(form.cbojk.value==0){
      alert("Masukkan jenis kelamin !");
      form.cbojk.focus(); return false;	
      }else if(form.TxtUmur.value==""){
        alert("Masukkan umur anda !");
        form.TxtUmur.focus(); return false;
        }else if(form.TxtAlamat.value==""){
          alert("Masukkan alamat anda !");
          form.TxtAlamat.focus(); return false;
          }else if(form.textemail.value==""){
            alert("Masukkan email !");
            form.textemail.focus(); return false;
            }
      form.submit();
    }
  </script>
  <div class="row">
    <div class="col-md-8 ">
      <form onSubmit="return validasi(this)" method="post" name="form1" target="_self" action="?top=pasienaddsim.php">
        <div class="form-group mt-3">
          <label for="TxtNama">Nama Pasien</label>
          <input type="text" name="TxtNama" class="form-control" id="TxtNama" placeholder="nama">
        </div>
        <div class="form-group mt-3">
          <label for="cbojk">Kelamin</label>
          <select class="form-control" name="cbojk" id="cbojk">
            <option value="0" selected="selected">- Jenis Kelamin -</option>
            <option value="L">Laki-laki</option>
            <option value="P">Perempuan</option>
          </select>
        </div>
        <div class="form-group mt-3 col-lg-2 col-md-4">
          <label for="TxtUmur">Umur</label>
          <input type="number" name="TxtUmur" class="form-control" id="TxtUmur" placeholder="... tahun">
        </div>
        <div class="form-group mt-3">
          <label for="TxtAlamat">Alamat</label>
          <textarea class="form-control" name="TxtAlamat" id="TxtAlamat" rows="3" placeholder="alamat"></textarea>
        </div>
        <div class="form-group mt-3">
          <label for="textemail">Email</label>
          <input type="email" class="form-control" name="textemail" id="textemail" placeholder="email">
        </div>
        <div class="row mt-5">
          <div class="text-center">
            <button type="submit" name="Submit" class="btn btn-info col-md-3 rounded-pill">Daftar</button>
            <button type="reset" name="Submit2" class="btn btn-warning col-md-3 rounded-pill">Reset</button>
          </div>
        </div>
      </form>
    </div>
    <div class="col-md-4">
      <lottie-player src="https://assets1.lottiefiles.com/packages/lf20_u8o7BL.json"  background="transparent"  speed="1"  style="width: 400px; height: 400px;"  loop autoplay></lottie-player>
    </div>
  </div>
</div>
