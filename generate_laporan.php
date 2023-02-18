<!DOCTYPE html>

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
    $uang = 0;

?>

<html lang="en">
<head>
<title>Entri Transaksi</title>
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
</head>
<body>

<!--Header-part-->
<div id="header">
  
</div>
<!--close-Header-part--> 


<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav">
    <li  class="dropdown" id="profile-messages" ><a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle"><i class="icon icon-user"></i>  <span class="text">Welcome <?php echo $r['nama_user'];?></span><b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li><a href="#"><i class="icon-user"></i><?php echo "&nbsp;&nbsp;".$r['nama_level'];?></a></li>
        <li><a href="logout.php"><i class="icon-key"></i> Log Out</a></li>
      </ul>
    </li>
    <li class=""><a title="" href="logout.php"><i class="icon icon-share-alt"></i> <span class="text">Logout</span></a></li>
  </ul>
</div>
<!--close-top-Header-menu-->
<!--start-top-serch-->

<!--close-top-serch-->
<!--sidebar-menu-->
<div id="sidebar"><a href="generate_laporan.php" class="visible-phone"><i class="icon icon-print"></i> <span>Generate</span></a>
  <ul>
    <?php
    if($r['id_level'] == 1){
  ?>
    <li> <a href="beranda.php"><i class="icon icon-home"></i> <span>Beranda</span></a> </li>
    <li> <a href="entri_referensi.php"><i class="icon icon-tasks"></i> <span>Entri Referensi</span></a> </li>
    <li> <a href="entri_order.php"><i class="icon icon-shopping-cart"></i> <span>Entri Order</span></a> </li>
    <li> <a href="entri_transaksi.php"><i class="icon icon-inbox"></i> <span>Entri Transaksi</span></a> </li>
    <li class="active"> <a href="generate_laporan.php"><i class="icon icon-print"></i> <span>Generate Laporan</span></a> </li>
    <li> <a href="logout.php"><i class="icon icon-sign-out"></i> <span>Logout</span></a> </li>
  <?php
    } else if($r['id_level'] == 2){
  ?>
    <li> <a href="beranda.php"><i class="icon icon-home"></i> <span>Beranda</span></a> </li>
    <li> <a href="entri_order.php"><i class="icon icon-shopping-cart"></i> <span>Entri Order</span></a> </li>
    <li class="active"> <a href="generate_laporan.php"><i class="icon icon-print"></i> <span>Generate Laporan</span></a> </li>
    <li> <a href="logout.php"><i class="icon icon-sign-out"></i> <span>Logout</span></a> </li>
  <?php
    } else if($r['id_level'] == 3){
  ?>
    <li> <a href="beranda.php"><i class="icon icon-home"></i> <span>Beranda</span></a> </li>
    <li> <a href="entri_transaksi.php"><i class="icon icon-inbox"></i> <span>Entri Transaksi</span></a> </li>
    <li class="active"> <a href="generate_laporan.php"><i class="icon icon-print"></i> <span>Generate Laporan</span></a> </li>
    <li> <a href="logout.php"><i class="icon icon-sign-out"></i> <span>Logout</span></a> </li>
  <?php
    } else if($r['id_level'] == 4){
  ?>
    <li> <a href="beranda.php"><i class="icon icon-home"></i> <span>Beranda</span></a> </li>
    <li class="active"> <a href="generate_laporan.php"><i class="icon icon-print"></i> <span>Generate Laporan</span></a> </li>
    <li> <a href="logout.php"><i class="icon icon-sign-out"></i> <span>Logout</span></a> </li>
  <?php
    } else if($r['id_level'] == 5){
  ?>
    <li> <a href="beranda.php"><i class="icon icon-home"></i> <span>Beranda</span></a> </li>
    <li> <a href="entri_order.php"><i class="icon icon-shopping-cart"></i> <span>Entri Order</span></a> </li>
    <li> <a href="logout.php"><i class="icon icon-sign-out"></i> <span>Logout</span></a> </li>
  <?php
    }
  ?>
  </ul>
</div>
<!--sidebar-menu-->

<!--main-container-part-->
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> <a href="generate_laporan.php" title="Go to here" class="tip-bottom"><i class="icon icon-print"></i> Generate Laporan</a></div>
  </div>
<!--End-breadcrumbs-->
  
  <div class="container-fluid">
    <?php
      if($r['id_level'] == 1 || $r['id_level'] == 2 || $r['id_level'] == 3 || $r['id_level'] == 4){
    ?>

    <div class="row-fluid">
      <div class="span9">
        <div class="widget-box">
          <div class="widget-title bg_lg"><span class="icon"><i class="icon-th-large"></i></span>
            <h5>Laporan Hari Ini</h5>
          </div>
          <div class="widget-content nopadding" >
            <table class="table table-bordered table-invoice-full">
              <thead>
                <tr>
                  <th class="head0">No.</th>
                  <th class="head0">Nama Menu</th>
                  <th class="head1">Sisa Stok</th>
                  <th class="head0">Jumlah Terjual</th>
                  <th class="head0 right">Harga</th>
                  <th class="head0 right">Total Masukan</th>
                </tr>
              </thead>
              <?php
                $no = 1;
                

                $query_lihat_menu = "select * from tb_masakan";
                $sql_lihat_menu = mysqli_query($conn, $query_lihat_menu);

              ?>
              <tbody>
              <?php
                while($r_lihat_menu = mysqli_fetch_array($sql_lihat_menu)){
              ?>
                <tr>
                  <td><center><?php echo $no++;?>.</center></td>
                  <td><?php echo $r_lihat_menu['nama_masakan'];?></td>
                  <td><center><?php echo $r_lihat_menu['stok'];?></center></td>
                  <td>
                    <center>
                      <?php
                        $id_masakan = $r_lihat_menu['id_masakan'];
                        $query_lihat_stok = "select * from tb_stok left join tb_pesan on tb_stok.id_pesan = tb_pesan.id_pesan left join tb_masakan on tb_pesan.id_masakan = tb_masakan.id_masakan where status_cetak = 'belum cetak'";
                        $query_jumlah = "select sum(jumlah_terjual) as jumlah_terjual from tb_stok left join tb_pesan on tb_stok.id_pesan = tb_pesan.id_pesan where id_masakan = $id_masakan and status_cetak = 'belum cetak'";
                        $sql_jumlah = mysqli_query($conn, $query_jumlah);
                        $result_jumlah = mysqli_fetch_array($sql_jumlah);

                        $jml = 0;

                        if($result_jumlah['jumlah_terjual'] != 0 || $result_jumlah['jumlah_terjual'] != null || $result_jumlah['jumlah_terjual'] != ""){
                          //echo $result_jumlah['jumlah_terjual'];
                          $jml = $result_jumlah['jumlah_terjual'];
                          echo $jml;
                        } else {
                          $jml = 0;
                          echo $jml;
                        }
                      ?>
                    </center>
                  </td>
                  <td style="text-align: right">Rp. <?php echo $r_lihat_menu['harga'];?> ,-</td>
                  <td style="text-align: right">Rp. 
                    
                      <?php

                        $id_masakan = $r_lihat_menu['id_masakan'];
                        $query_lihat_stok = "select * from tb_stok left join tb_pesan on tb_stok.id_pesan = tb_pesan.id_pesan left join tb_masakan on tb_pesan.id_masakan = tb_masakan.id_masakan where status_cetak = 'belum cetak'";
                        $query_jumlah = "select sum(jumlah_terjual) as jumlah_terjual from tb_stok left join tb_pesan on tb_stok.id_pesan = tb_pesan.id_pesan where id_masakan = $id_masakan and status_cetak = 'belum cetak'";
                        $sql_jumlah = mysqli_query($conn, $query_jumlah);
                        $result_jumlah = mysqli_fetch_array($sql_jumlah);

                        $jml = 0;

                        if($result_jumlah['jumlah_terjual'] != 0 || $result_jumlah['jumlah_terjual'] != null || $result_jumlah['jumlah_terjual'] != ""){
                          //echo $result_jumlah['jumlah_terjual'];
                          $jml = $result_jumlah['jumlah_terjual'] * $r_lihat_menu['harga'];
                          echo $jml;
                        } else {
                          $jml = $result_jumlah['jumlah_terjual'] * $r_lihat_menu['harga'];
                          echo $jml;
                        }
                        $uang += $jml;
                      ?>
                    
                   ,-</td>
                </tr>
              <?php
                }
                //echo $uang;
              ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <?php
      }
    ?>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
    
      <ul class="quick-actions">
        <li class="bg_lg"> <a href="#"><i class="icon-book"></i> <h4>Uang Masuk</h4><h4>Rp. <?php echo $uang;?> ,-</h4> </a> </li>
      </ul>
    </div>
  </div>
</div>

<!--end-main-container-part-->

<!--Footer-part-->

<div class="row-fluid">
  <div id="footer" class="span12"> <?php echo date('Y'); ?> &copy; Restaurant <a href="#">by henscorp</a> </div>
</div>

<!--end-Footer-part-->

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

<script type="text/javascript">
  // This function is called from the pop-up menus to transfer to
  // a different page. Ignore if the value returned is a null string:
  function goPage (newURL) {

      // if url is empty, skip the menu dividers and reset the menu selection to default
      if (newURL != "") {
      
          // if url is "-", it is this page -- reset the menu:
          if (newURL == "-" ) {
              resetMenu();            
          } 
          // else, send page to designated URL            
          else {  
            document.location.href = newURL;
          }
      }
  }

// resets the menu selection upon entry to this page:
function resetMenu() {
   document.gomenu.selector.selectedIndex = 2;
}
</script>
</body>
</html>
<?php
  }
} else {
  header('location: logout.php');
}
ob_flush();
?>