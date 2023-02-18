<!DOCTYPE html>

<?php
include "connection/koneksi.php";
session_start();
ob_start();

$id = $_SESSION['id_user'];

if(isset($_SESSION['edit_menu'])){
  echo $_SESSION['edit_menu'];
  unset($_SESSION['edit_menu']);

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
<title>Transaksi</title>
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
    <li> <a href="beranda.php"><i class="icon icon-home"></i> <span>Beranda</span></a> </li>
    <li> <a href="entri_referensi.php"><i class="icon icon-tasks"></i> <span>Entri Referensi</span></a> </li>
    <li> <a href="entri_order.php"><i class="icon icon-shopping-cart"></i> <span>Entri Order</span></a> </li>
    <li class="active"> <a href="entri_transaksi.php"><i class="icon icon-inbox"></i> <span>Entri Transaksi</span></a> </li>
    <li> <a href="widgets.html"><i class="icon icon-print"></i> <span>Generate Laporan</span></a> </li>
    <li> <a href="logout.php"><i class="icon icon-sign-out"></i> <span>Logout</span></a> </li>
  </ul>
</div>
<!--sidebar-menu-->

<!--main-container-part-->
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> 
      <a href="entri_transaksi.php" title="Enttri Transaksi" class="tip-bottom"><i class="icon icon-inbox"></i>
        Entri Transaksi
      </a>
      <a href="transaksi.php" title="Transaksi" class="tip-bottom"><i class="icon icon-ok"></i> 
        Transaksi
      </a>
    </div>
  </div>
<!--End-breadcrumbs-->
  
<!--Action boxes-->
  <div class="container-fluid">
    <div class="row-fluid">
    <?php
      if($r['id_level'] == 1){
        $id_order = $_SESSION['edit_order'];
        $query_pemesan = "select * from tb_order left join tb_user on tb_order.id_pengunjung = tb_user.id_user where id_order = $id_order";
        $sql_pemesan = mysqli_query($conn, $query_pemesan);
        $result_pemesan = mysqli_fetch_array($sql_pemesan);
        $id_pemesan = $result_pemesan['id_pengunjung'];
    ?>
      <div class="span7">
        <div class="widget-box">
          <div class="widget-title bg_lg"><span class="icon"><i class="icon-th-large"></i></span>
            <h5>Transaksi Pembayaran (<?php echo $result_pemesan['nama_user'];?>)</h5>
          </div>
          <div class="widget-content nopadding" >
            <table class="table table-bordered table-invoice-full">
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
                  $query_order_fiks = "select * from tb_pesan left join tb_masakan on tb_pesan.id_masakan = tb_masakan.id_masakan where id_user = $id_pemesan and status_pesan != 'sudah'";
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
                  $query_harga = "select * from tb_order where id_pengunjung = $id_pemesan and status_order = 'belum bayar'";
                  $sql_harga = mysqli_query($conn, $query_harga);
                  $result_harga = mysqli_fetch_array($sql_harga);
                ?>

                <tr>
                  <td></td>
                  <td><strong><center>Total</center></strong></td>
                  <td class="right"></td>
                  <td class="right"></td>
                  <td class="right"><strong>Rp. <span id="total_biaya"><?php echo $result_harga['total_harga'];?></span>,-</strong></td>
                </tr>
                <tr>
                  <td></td>
                  <td><strong><center>No. Meja</center></strong></td>
                  <td class="right"></td>
                  <td class="right"></td>
                  <td class="right"><center><strong><?php echo $result_harga['no_meja'];?></strong></center></td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="widget-content nopadding" >
            <form action="#" method="post" class="form-horizontal">
              <div class="control-group">
                <label class="control-label">Membayar : Rp.</label>
                <div class="controls">
                  <input type="number" id="uang_bayar" name="uang_bayar" class="span11" placeholder="" onchange="return operasi()"/>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Kembalian : Rp.</label>
                <div class="controls">
                  <input type="number" id="uang_kembali1" class="span11" placeholder="" disabled="" />
                  <input type="hidden" id="uang_kembali" name="uang_kembali" class="span11" placeholder=""/>
                </div>
              </div>
              <p></p>
              <center>
                <button type="submit" value="<?php echo $result_harga['id_order'];?>" name="save_order" class="btn btn-success btn-mini">
                  <i class='icon-print'></i>
                  &nbsp;&nbsp;Transaksi Selesai&nbsp;&nbsp;
                </button>
                <button type="submit" value="" name="back_order" class="btn btn-danger btn-mini">
                  <i class='icon-remove'></i>
                  &nbsp;&nbsp;Kembali&nbsp;&nbsp;
                </button>
              </center>
              <p></p><br>
            </form>
          </div>
        </div>
      </div>
      <?php
          if(isset($_REQUEST['back_order'])){
            if(isset($_SESSION['edit_order'])){
              unset($_SESSION['edit_order']);
              header('location: entri_transaksi.php');
            }
          }

          if(isset($_REQUEST['save_order'])){
            if(isset($_SESSION['edit_order'])){
              unset($_SESSION['edit_order']);
            }
            $uang_bayar = $_POST['uang_bayar'];
            $uang_kembali = $_POST['uang_kembali'];
            $query_save_transaksi = "update tb_order set id_admin = $id, uang_bayar = $uang_bayar, uang_kembali = $uang_kembali, status_order = 'sudah bayar' where id_order = $id_order";
            echo $query_save_transaksi;
            $sql_save_transaksi = mysqli_query($conn, $query_save_transaksi);

            $query_selesai_pesan = "update tb_pesan set status_pesan = 'sudah' where id_user = $id_pemesan and status_pesan != 'sudah'";
            $sql_selesai_pesan = mysqli_query($conn, $query_selesai_pesan);
            if($sql_selesai_pesan){
              header('location: entri_transaksi.php');
            }
          }
        }
      ?>
    </div>
<!--End-Action boxes-->    
  </div>
</div>
<script type="text/javascript">
  function operasi(){
    var total_biaya = $("#total_biaya").text();
    var uang_bayar = $("#uang_bayar").val();
    var kembalian = Number(uang_bayar - total_biaya);
    if(kembalian < 0){
      alert("Uang pembayaran kurang !");
      return false;
    }
    $("#uang_kembali1").val(kembalian);
    $("#uang_kembali").val(kembalian);
  }
</script>
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