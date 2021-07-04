<?php
include"koneksi.php";
$no=0;
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Data Siswa</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
<link rel="stylesheet" href="/resources/demos/style.css">
</head>
<body>

  <div class="container mt-5">
    <div class="row center">
      <div class="col-sm-4">
        <div class="card">
          <div class="card-header">INPUT DATA KELAS SISWA</div>
          <div class="card-body">
            <form action="" method="POST" id="myfrm">
             <div class="form-group">
               <label for="kelas">Pilih Kelas</label>
               <select class="form-control" name="kls">
                 <?php
                    $sql=$con->query("SELECT*FROM tb_kelas");
                    foreach ($sql as $data) {
                      echo"<option value='$data[kdkelas]'>$data[kdkelas]</option>";
                    }
                  ?>
               </select>
             </div>
             <div class="form-group">
               <label for="jurusan">Pilih Jurusan</label>
               <select class="form-control" name="jurusan">
                 <option value="RPL">Rekayasa Perangkat Lunak</option>
                 <option value="MM">Multimedia</option>
               </select>
             </div>
             <!-- <a class="btn btn-info tambah"><i class="fa fa-plus-square" aria-hidden="true"></i></a> -->
               <table class="table table-striped mt-3">
                 <thead>
                  <tr>
                   <th>NIS</th>
                   <th>Nama</th>
                   <th>Aksi</th>
                  </tr>
                 </thead>
                 <tbody class="body">
                  <tr class='tr_input'>
                   <td><input type='text' class='form-control nis' id='nis_1' name="nis[]" placeholder='Masukan NIS'></td>
                   <td><input type='text' class='form-control' id='nama_1' ></td>
                   <td><a class="btn btn-info btn-sm" id='addmore' ><i class="fa fa-plus" aria-hidden="true"></i></a></td>
                  </tr>
                 </tbody>
               </table>
             <button type="submit" class="btn btn-primary" name="btn">Submit</button>
          </form>
          </div>
          <div class="card-footer">Footer</div>
        </div>

      </div>
      <div class="col-sm-8">
        <?php
          if(isset($_POST['btn'])){
            $nis=$_POST['nis'];
            $rowcount= count($nis);
            for($n=0;$n<$rowcount;$n++){
              $sql=$con->query("INSERT INTO tbkelassiswa(nis,kdkls,jurusan) VALUES('$nis[$n]','$_POST[kls]','$_POST[jurusan]')");
            }
            if($sql){
            //  echo "berhasil";
            }else{
              echo"gagal";
              die($con->error);
            }
          }
         ?>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>NO</th>
              <th>NIS</th>
              <th>Nama</th>
              <th>Kelas</th>
              <th>Jurusan</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no=0;
              $SQLout = $con->query("SELECT*FROM tbkelassiswa a INNER JOIN tb_siswa b ON a.nis=b.nis INNER JOIN tb_kelas c ON a.kdkls=c.kdkelas");
              foreach ($SQLout as $data) {
                $no++;
                echo "<tr>
                  <td>$no</td>
                  <td>$data[nis]</td>
                  <td>$data[nama]</td>
                  <td>$data[kdkelas]</td>
                  <td>$data[jurusan]</td>
                  </tr>
                ";
              }
             ?>
            <tr>

            </tr>
          </tbody>
        </table>
      </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
 <script type="text/javascript">
 $(document).ready(function(){
  $(document).on('keydown', '.nis', function() {
   var id = this.id;
   var splitid = id.split('_');
   var index = splitid[1];
   $( '#'+id ).autocomplete({
    source: function( request, response ) {
     $.ajax({
      url: "fetch.php",
      type: 'post',
      dataType: "json",
      data: {
       search: request.term,request:1},
      success: function( data ) {
       response( data );
      }
     });
    },
    select: function (event, ui) {
     $(this).val(ui.item.label);
     var userid = ui.item.value;
     $.ajax({
      url: 'fetch.php',
      type: 'post',
      data: {userid:userid,request:2},
      dataType: 'json',
      success:function(response){
       var len = response.length;
       if(len > 0){
        var nis = response[0]['nis'];
        var nama = response[0]['nama'];
        document.getElementById('nis_'+index).value = nis;
        document.getElementById('nama_'+index).value = nama;
       }
      }
     });
     return false;
    }
   });
  });
  $('#addmore').click(function(){
   var lastname_id = $('.tr_input input[type=text]:nth-child(1)').last().attr('id');
   var split_id = lastname_id.split('_');
   var index = Number(split_id[1]) + 1;
   var html = '<tr class="tr_input">'
              +'<td><input type="text" class="form-control nis" id="nis_'+index+'" name="nis[]" placeholder="Masukan NIS"></td>'
              +'<td><input type="text" class="form-control" id="nama_'+index+'" ></td>'
              +'<td><a class="btn btn-danger btn-sm remove_button"><i class="fa fa-trash" aria-hidden="true"></i></a></td>'
              +'</tr>';
   $('.body').append(html);
  });
  $(document).on('click', '.remove_button', function(){
     $(this).parents('tr').remove();
});
 });
 </script>
</body>
</html>
