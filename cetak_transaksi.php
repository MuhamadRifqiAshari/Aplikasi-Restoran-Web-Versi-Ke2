<!DOCTYPE html>
<html lang="en">
<?php
include "connection/koneksi.php";
session_start();
ob_start();

$id = $_SESSION['id_user'];

if(isset($_SESSION['edit_order'])){
  //echo $_SESSION['edit_order'];
  unset($_SESSION['edit_order']);

}

if(isset ($_SESSION['username'])){
  
  $query = "select * from tb_user natural join tb_level where id_user = $id";

  mysqli_query($conn, $query);
  $sql = mysqli_query($conn, $query);

  while($r = mysqli_fetch_array($sql)){
    
    $nama_user = $r['nama_user'];

?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>&nbsp;</title>
  
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="template/dashboard/css/bootstrap.min.css" />
  <link rel="stylesheet" href="template/dashboard/css/bootstrap-responsive.min.css" />
  <link rel="stylesheet" href="template/dashboard/css/fullcalendar.css" />
  <link rel="stylesheet" href="template/dashboard/css/matrix-style.css" />
  <link rel="stylesheet" href="template/dashboard/css/matrix-media.css" />
  <link href="template/dashboard/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link rel="stylesheet" href="template/dashboard/css/jquery.gritter.css" />
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

<style>

@page{
  size: auto;
}
body {
  background: rgb(204,204,204); 
}

page {
  background: white;
  display: block;
  margin: 0 auto;
  margin-bottom: 0.5cm;
  box-shadow: 0 0 0.1cm rgba(0,0,0,0.5);
}
page[size="A4"] {  
  width: 29.7cm;
  height: 21cm; 
}
page[size="A4"][layout="potrait"] {
  width: 29.7cm;
  height: 21cm;  
}
page[size="A3"] {
  width: 29.7cm;
  height: 42cm;
}
page[size="A3"][layout="landscape"] {
  width: 42cm;
  height: 29.7cm;  
}
page[size="A5"] {
  width: 14.8cm;
  height: 21cm;
}
page[size="A5"][layout="landscape"] {
  width: 21cm;
  height: 19.8cm;  
}
page[size="dipakai"][layout="landscape"] {
  width: 20cm;
  height: 20cm;  
}
@media print {
  body, page {
    margin: auto;
    box-shadow: 0;
  }
}

</style>


</head>

<body>

  <page size="dipakai" layout="landscape">
    <br>
    <div class="container">
      <span id="remove">
        <a class="btn btn-success" id="ct"><span class="icon-print"></span> CETAK</a>
      </span>
    </div>
    <?php
      $id_order = $_REQUEST['konten'];
      $query_order = "select * from tb_order left join tb_user on tb_order.id_pengunjung = tb_user.id_user where id_order = $id_order";
      $sql_order = mysqli_query($conn, $query_order);
      $result_order = mysqli_fetch_array($sql_order);
      //echo $id_order
    ?>
      <center>
        <h4>
          RESTAURANT CEPAT SAJI
        </h4>
        <span>
          Jl. Bambu Kuning II No. 10B Kel. Pondok Rangon, Kec. Cipayung, Kota, Jakarta Timur<br>
          Telp. +62815 xxxx xxxx || E-mail dzulfaqar.2624@gmail.com
        </span>
      </center>
            <hr>
              <table style="width: 100%" class="">
                <tr>
                  <td>
                    Nama Pelanggan &nbsp;&nbsp;
                  </td>
                  <td>
                  :
                  </td>
                  <td>
                    <?php echo $result_order['nama_user'];?>
                  </td>
                </tr>
                <tr>
                  <td style="width: 15%">
                    Nama Kasir
                  </td>
                  <td style="width: 5%">
                  :
                  </td>
                  <td style="width: 80%">
                    <?php echo $nama_user;?>
                  </td>
                </tr>
                <tr>
                  <td>
                    Waktu Pesan
                  </td>
                  <td>
                  :
                  </td>
                  <td>
                    <?php echo $result_order['waktu_pesan'];?>
                  </td>
                </tr>
                <tr>
                  <td>
                    No Meja
                  </td>
                  <td>
                  :
                  </td>
                  <td>
                    <?php echo $result_order['no_meja'];?>
                  </td>
                </tr>
              </table>

              <hr>

              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th class="head0">No.</th>
                    <th class="head1">Menu</th>
                    <th class="head0 right">Jumlah</th>
                    <th class="head1 right">Harga</th>
                    <th class="head0 right">Total</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $no_order_fiks = 1;
                    $query_order_fiks = "select * from tb_pesan natural join tb_masakan where id_order = $id_order";
                    $sql_order_fiks = mysqli_query($conn, $query_order_fiks);
                    //echo $query_order_fiks;
                    while($r_order_fiks = mysqli_fetch_array($sql_order_fiks)){
                  ?>
                  <tr>
                    <td><center><?php echo $no_order_fiks++; ?>. </center></td>
                    <td><?php echo $r_order_fiks['nama_masakan'];?></td>
                    <td class="right"><center><?php echo $r_order_fiks['jumlah'];?></center></td>
                    <td class="right">Rp. <?php echo $r_order_fiks['harga'];?>,-</td>
                    <td class="right">
                      <strong>
                        Rp.
                        <?php 
                          $hasil = $r_order_fiks['harga'] * $r_order_fiks['jumlah'];
                          echo $hasil;
                        ?>,-
                      </strong>
                    </td>
                  </tr>
                  <?php
                    }
                    $query_harga = "select * from tb_order where id_order = $id_order";
                    $sql_harga = mysqli_query($conn, $query_harga);
                    $result_harga = mysqli_fetch_array($sql_harga);
                  ?>

                  <tr>
                    <td></td>
                    <td><strong><center>Total</center></strong></td>
                    <td class="right"></td>
                    <td class="right"></td>
                    <td class="right"><strong>Rp. <?php echo $result_harga['total_harga'];?>,-</strong></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td><strong><center>Uang Bayar</center></strong></td>
                    <td class="right"></td>
                    <td class="right"></td>
                    <td class="right"><strong>Rp. <?php echo $result_harga['uang_bayar'];?>,-</strong></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td><strong><center>Uang Kembali</center></strong></td>
                    <td class="right"></td>
                    <td class="right"></td>
                    <td class="right"><strong>Rp. <?php echo $result_harga['uang_kembali'];?>,-</strong></td>
                  </tr>
                </tbody>
              </table>

            <hr>
            <center>
              <h5>
                TERIMAKASIH ATAS KUNJUNGANNYA
              </h5>
            </center>
            <hr>
            
  </page>
</body>

<?php
    }
  }
?>

<script type="text/javascript">
  document.getElementById('ct').onclick = function(){
    $("#remove").remove();
    window.print();
  }
  $(document).ready(function(){
    $("remove").remove();

  });
 
</script>

<script src="template/dashboard/js/excanvas.min.js"></script> 
<script src="template/dashboard/js/jquery.min.js"></script> 
<script src="template/dashboard/js/jquery.ui.custom.js"></script> 
<script src="template/dashboard/js/bootstrap.min.js"></script> 
<script src="template/dashboard/js/jquery.flot.min.js"></script> 
<script src="template/dashboard/js/jquery.flot.resize.min.js"></script> 
<script src="template/dashboard/js/jquery.peity.min.js"></script> 
<script src="template/dashboard/js/fullcalendar.min.js"></script> 
<script src="template/dashboard/js/matrix.js"></script> 
<script src="template/dashboard/js/matrix.dashboard.js"></script> 
<script src="template/dashboard/js/jquery.gritter.min.js"></script> 
<script src="template/dashboard/js/matrix.interface.js"></script> 
<script src="template/dashboard/js/matrix.chat.js"></script> 
<script src="template/dashboard/js/jquery.validate.js"></script> 
<script src="template/dashboard/js/matrix.form_validation.js"></script> 
<script src="template/dashboard/js/jquery.wizard.js"></script> 
<script src="template/dashboard/js/jquery.uniform.js"></script> 
<script src="template/dashboard/js/select2.min.js"></script> 
<script src="template/dashboard/js/matrix.popover.js"></script> 
<script src="template/dashboard/js/jquery.dataTables.min.js"></script> 
<script src="template/dashboard/js/matrix.tables.js"></script> 
</html>
