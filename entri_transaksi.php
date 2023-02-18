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
<div id="sidebar"><a href="entri_referensi.php" class="visible-phone"><i class="icon icon-inbox"></i> <span>Entri Transaksi</span></a>
  <ul>
    <?php
    if($r['id_level'] == 1){
  ?>
    <li> <a href="beranda.php"><i class="icon icon-home"></i> <span>Beranda</span></a> </li>
    <li> <a href="entri_referensi.php"><i class="icon icon-tasks"></i> <span>Entri Referensi</span></a> </li>
    <li> <a href="entri_order.php"><i class="icon icon-shopping-cart"></i> <span>Entri Order</span></a> </li>
    <li class="active"> <a href="entri_transaksi.php"><i class="icon icon-inbox"></i> <span>Entri Transaksi</span></a> </li>
    <li> <a href="generate_laporan.php"><i class="icon icon-print"></i> <span>Generate Laporan</span></a> </li>
    <li> <a href="logout.php"><i class="icon icon-sign-out"></i> <span>Logout</span></a> </li>
  <?php
    } else if($r['id_level'] == 2){
  ?>
    <li> <a href="beranda.php"><i class="icon icon-home"></i> <span>Beranda</span></a> </li>
    <li> <a href="entri_order.php"><i class="icon icon-shopping-cart"></i> <span>Entri Order</span></a> </li>
    <li> <a href="generate_laporan.php"><i class="icon icon-print"></i> <span>Generate Laporan</span></a> </li>
    <li> <a href="logout.php"><i class="icon icon-sign-out"></i> <span>Logout</span></a> </li>
  <?php
    } else if($r['id_level'] == 3){
  ?>
    <li><a href="beranda.php"><i class="icon icon-home"></i> <span>Beranda</span></a> </li>
    <li class="active"> <a href="entri_transaksi.php"><i class="icon icon-inbox"></i> <span>Entri Transaksi</span></a> </li>
    <li> <a href="generate_laporan.php"><i class="icon icon-print"></i> <span>Generate Laporan</span></a> </li>
    <li> <a href="logout.php"><i class="icon icon-sign-out"></i> <span>Logout</span></a> </li>
  <?php
    } else if($r['id_level'] == 4){
  ?>
    <li class="active"><a href="beranda.php"><i class="icon icon-home"></i> <span>Beranda</span></a> </li>
    <li> <a href="generate_laporan.php"><i class="icon icon-print"></i> <span>Generate Laporan</span></a> </li>
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
    <div id="breadcrumb"> <a href="entri_transaksi.php" title="Go to here" class="tip-bottom"><i class="icon icon-inbox"></i> Entri Transaksi</a></div>
  </div>
<!--End-breadcrumbs-->
  
<!--Action boxes-->
  <div class="container">
    <div class="row-fluid">
    <?php
      if($r['id_level'] == 1 || $r['id_level'] == 3){
    ?>
      <p></p>
      <div class="span7">
        <div class="widget-box">
          <div class="widget-title bg_lg"><span class="icon"><i class="icon-th-large"></i></span>
            <h5>Belum Bayar</h5>
          </div>
          <div class="widget-content nopadding" >
            <table class="table table-bordered table-invoice-full">
              <thead>
                <tr>
                  <th class="head0">No. Meja</th>
                  <th class="head1">Pemesan</th>
                  <th class="head0 right">Total Harga</th>
                  <th class="head0 right">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $query_order = "select * from tb_order left join tb_user on tb_order.id_pengunjung = tb_user.id_user where status_order = 'belum bayar'";
                  $sql_order = mysqli_query($conn, $query_order);
                  while($r_order = mysqli_fetch_array($sql_order)){
                ?>
                <tr>
                  <td><center><?php echo $r_order['no_meja']; ?>. </center></td>
                  <td><?php echo $r_order['nama_user'];?></td>
                  <td class="right"><center>Rp. <?php echo $r_order['total_harga'];?>,-</center></td>
                  <td>
                    <form action="" method="post">
                      <button type="submit" value="<?php echo $r_order['id_order'];?>" name="edit_order" class="btn btn-success btn-mini"><i class='icon-pencil'></i>&nbsp;&nbsp;Transaksi &nbsp;&nbsp;</button>
                      <button type="submit" value="<?php echo $r_order['id_order'];?>" name="hapus_order" class="btn btn-mini btn-danger"><i class='icon icon-trash'></i>&nbsp; Hapus</button>
                    </form>
                  </td>
                </tr>
                <?php
                  }
                  if(isset($_REQUEST['edit_order'])){
                    $id_order = $_REQUEST['edit_order'];
                    $_SESSION['edit_order'] = $id_order;
                    header('location: transaksi.php');
                  }

                  if(isset($_REQUEST['hapus_order'])){
                    $id_order = $_REQUEST['hapus_order'];
                    $query_hapus_order = "delete from tb_order where id_order = $id_order";
                    $query_hapus_pesan_order = "delete from tb_pesan where id_order = $id_order";
                    $sql_hapus_order = mysqli_query($conn, $query_hapus_order);
                    $sql_hapus_pesan_order = mysqli_query($conn, $query_hapus_pesan_order);
                    if($sql_hapus_order){
                      header('location: entri_transaksi.php');
                    }
                  }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="span9">
        <div class="widget-box">
          <div class="widget-title bg_lg"><span class="icon"><i class="icon-th-large"></i></span>
            <h5>Transaksi Terdahulu</h5>
          </div>
          <div class="widget-content nopadding" >
            <table class="table table-bordered table-invoice-full">
              <thead>
                <tr>
                  <th class="head0">No.</th>
                  <th class="head0">Waktu Pesan</th>
                  <th class="head1">Nama Pemesan</th>
                  <th class="head0">No Meja</th>
                  <th class="head0 right">Total Harga</th>
                  <th class="head0 right">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $nomor = 1;
                  $query_sudah_order = "select * from tb_order left join tb_user on tb_order.id_pengunjung = tb_user.id_user where status_order = 'sudah bayar' order by id_order desc";
                  $sql_sudah_order = mysqli_query($conn, $query_sudah_order);
                  while($r_sudah_order = mysqli_fetch_array($sql_sudah_order)){
                ?>
                <tr>
                  <td><center><?php echo $nomor++; ?>. </center></td>
                  <td><?php echo $r_sudah_order['waktu_pesan'];?></td>
                  <td><?php echo $r_sudah_order['nama_user'];?></td>
                  <td><?php echo $r_sudah_order['no_meja'];?></td>
                  <td>Rp. <?php echo $r_sudah_order['total_harga'];?>,-</td>
                  <td>
                    <form action="" method="post">
                      <button type="submit" value="<?php echo $r_sudah_order['id_order'];?>" name="hapus_transaksi" class="btn btn-mini btn-danger">
                        <i class='icon icon-trash'></i>
                        &nbsp; Hapus
                      </button>
                      <a target='_blank' href="cetak_transaksi.php?konten=<?php echo $r_sudah_order['id_order'];?>" class="btn btn-mini btn-success">
                        <i class='icon icon-print'></i>
                        &nbsp; Cetak
                      </a>
                    </form>
                  </td>
                </tr>
                <?php
                  }
                  if(isset($_REQUEST['hapus_transaksi'])){
                    $id_order = $_REQUEST['hapus_transaksi'];
                    $query_hapus_transaksi = "delete from tb_order where id_order = $id_order";
                    $query_hapus_pesan = "delete from tb_pesan where id_order = $id_order";
                    $sql_hapus_transaksi = mysqli_query($conn, $query_hapus_transaksi);
                    $sql_hapus_pesan = mysqli_query($conn, $query_hapus_pesan);
                    if($sql_hapus_transaksi){
                      header('location: entri_transaksi.php');
                    }
                  }

                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <?php
        }
      ?>
    </div>
<!--End-Action boxes-->    
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