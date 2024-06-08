<?php
    session_start();
    if($_SESSION['status']!="login"){
        header("location:login.php");
    }
    $transparent = true;
    include '../config/conn.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/logo-vokasi.png">
  <link rel="icon" type="image/png" href="../assets/img/logo-vokasi.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
  Gudang Vokasi
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="../assets/css/material-dashboard.css?v=2.1.0'" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <!-- <link href="assets/demo/demo.css" rel="stylesheet" /> -->
  <link href="../assets/css/grid.css" rel="stylesheet" />
  <link href="../assets/css/custom-template.css" rel="stylesheet" />
  <link href="../assets/css/style.css" rel="stylesheet" />
  <link href="../assets/css/highcharts.css" rel="stylesheet" />
  <link href="../assets/css/choiceIcon.css" rel="stylesheet" />
  <link href="../assets/plugins/select2/select2.min.css" rel="stylesheet" />
<!--  @yield('additionalCSS')-->
</head>
<body class="">
  <div class="wrapper ">
    <div class="modal fade modal-mini modal-primary" id="myModal10" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-small">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
          </div>
          <div class="modal-body">
            <p> Apakah anda yakin mau keluar?</p>
          </div>
          <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-link" data-dismiss="modal">Tidak! Lupakan</button>
            <a class="btn btn-success btn-link" href="../logout.php">Ya<div class="ripple-container"></div></a>
          </div>
        </div>
      </div>
    </div>
<!--    @yield('modal')-->
    <div class="sidebar" data-color="azure" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
      <div class="logo">
        <a href="#" class="simple-text logo-mini">
          <img src="../assets/img/logo-vokasi.png" width="25" height="25">
        </a>
        <a href="#" class="simple-text logo-normal" style="font-size: 14px;">
          Gudang Vokasi
        </a>
      </div>
      <div class="sidebar-wrapper">
        <div class="user">

          <div class="user-info">
            <a href="#" class="username text-center">
              <span>
                <?php
                  echo $_SESSION['nama'];
                ?>
              </span>
            </a>
          </div>
        </div>
<!--          @include('application.include.sidebar')-->
          <?php
            include('sidebar.php');
          ?>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg <?php echo ($transparent)?'navbar-transparent':''; ?> navbar-absolute fixed-top">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-minimize">
              <button id="minimizeSidebar" class="btn btn-just-icon btn-white btn-fab btn-round">
                <i class="material-icons text_align-center visible-on-sidebar-regular">more_vert</i>
                <i class="material-icons design_bullet-list-67 visible-on-sidebar-mini">view_list</i>
              </button>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
              <ol class="breadcrumb">
                <?php
                    $pageNow = array();
                    $page = (isset($_GET['page']))? $_GET['page'] : '';
                    switch($page){
                        case 'data_stok_barang': // $page == home (jika isi dari $page adalah home)
                            $pageNow = ["Halaman Utama","Data Stok Barang"]; // load file home.php yang ada di folder views
                            break;

                        case 'barang_masuk': // $page == home (jika isi dari $page adalah home)
                            $pageNow = ["Halaman Utama"," Laporan","Barang Masuk"]; // load file home.php yang ada di folder views
                            break;

                        case 'barang_keluar': // $page == home (jika isi dari $page adalah home)
                            $pageNow = ["Halaman Utama"," Laporan","Barang Keluar"]; // load file home.php yang ada di folder views
                            break;

                        default: // Ini untuk set default jika isi dari $page tidak ada pada 3 kondisi diatas
                            $pageNow = ["Halaman Utama"];
                    }
                    for($a = 0; $a < count($pageNow); $a++){
                      if($a == count($pageNow)-1) {
                        echo "<li class='breadcrumb-item active' aria-current='page'>". $pageNow[$a] ."</li>";
                      } else {
                        echo "<li class='breadcrumb-item old'>". $pageNow[$a] ."</li>";
                      }
                    }
                ?>
              </ol>
            </nav>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <form id="searchValidation" class="navbar-form">
              <!-- <div class="input-group no-border">
                <input type="text" class="form-control" id="searchEmploye" required="true" name="employee"  placeholder="Search employee...">
                <button type="submit" class="btn btn-white btn-round btn-just-icon">
                  <i class="material-icons">search</i>
                  <div class="ripple-container"></div>
                </button>
              </div> -->
            </form>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
<!--      @yield('content')-->
        <?php include "config_content.php"; // Load file config.php ?>

      <footer class="footer hide">
        <div class="container-fluid">
          <div class="copyright float-right">
            &copy;
            <script>
              document.write(new Date().getFullYear())
            </script>, made with <i class="material-icons">favorite</i> by
            <a href="https://www.tigaconsulting.co.id" target="_blank">3 Consulting Service.</a>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap-material-design.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!-- Plugin for the momentJs  -->
  <script src="../assets/js/plugins/moment.min.js"></script>
  <!--  Plugin for Sweet Alert -->
  <script src="../assets/js/plugins/sweetalert2.js"></script>
  <!-- Forms Validations Plugin -->
  <script src="../assets/js/plugins/jquery.validate.min.js"></script>
  <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
  <script src="../assets/js/plugins/jquery.bootstrap-wizard.js"></script>
  <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
  <script src="../assets/js/plugins/bootstrap-selectpicker.js"></script>
  <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
  <script src="../assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
  <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
  <!-- <script src="assets/js/plugins/jquery.dataTables-quickly.min.js"></script> -->
  <script src="../assets/js/plugins/jquery.dataTables.min.js"></script>
  <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
  <script src="../assets/js/plugins/bootstrap-tagsinput.js"></script>
  <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
  <script src="../assets/js/plugins/jasny-bootstrap.min.js"></script>
  <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
  <script src="../assets/js/plugins/fullcalendar.min.js"></script>
  <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/
  <script src="assets/js/plugins/jquery-jvectormap.js"></script> -->
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="../assets/js/plugins/nouislider.min.js"></script>
  <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
  <script src="../assets/js/core/core.js"></script>
  <!-- Library for adding dinamically elements -->
  <script src="../assets/js/plugins/arrive.min.js"></script>
  <!-- Chartist JS
  <script src="assets/js/plugins/chartist.min.js"></script> -->
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/material-dashboard.js?v=2.1.0" type="text/javascript"></script>
  <script src="../assets/js/main.js?v=2.1.0" type="text/javascript"></script>
  <script src="../assets/js/highcharts.js" type="text/javascript"></script>
  <!-- <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/highcharts-more.js"></script>

  <script src="https://code.highcharts.com/modules/solid-gauge.js"></script> -->
  <!-- Material Dashboard DEMO methods, don't include it in your project!
  <script src="assets/demo/demo.js"></script>-->

  <link  href="../assets/css/jquery.fancybox.min.css" rel="stylesheet">
  <script src="../assets/js/jquery.fancybox.min.js"></script>

  <script src="../assets/plugins/ckeditor_full_v2/ckeditor.js"></script>
  <script src="../assets/plugins/select2/select2.min.js"></script>

  <?php
  include('script.php');
  ?>

  <script>
    var lasCount = 0;
    var lasData;
    var first = true;

    $(document).ready(function() {
      // @if(!empty(session('message')))
      //   md.showNotification('top','right','{{ session("message_status") }}','{{ session("message") }}');
      // @elseif(!empty($message))
      //   md.showNotification('top','right','{{ $message_status }}','{{ $message }}');
      // @endif
      // // Javascript method's body can be found in assets/js/demos.js
      // getMessageCount();
      setFormValidation('#searchValidation');
      // $('[data-toggle="tooltips"]').tooltip();
    });

    function ChangeMenu(type) {
       $.ajax({
        type : "GET",
        url : "",
        data : {Session : type},
        dataType : "HTML",
        success:function(data){
          console.log(data);
          location.href = "";
        }
      });
    }


    function formatRupiah(angka, prefix){
      var number_string = angka.toString(),
      split       = number_string.split(','),
      sisa        = split[0].length % 3,
      rupiah        = split[0].substr(0, sisa),
      ribuan        = split[0].substr(sisa).match(/\d{3}/gi);

      // tambahkan titik jika yang di input sudah menjadi angka ribuan
      if(ribuan){
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
      }

      rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
      return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }

    

  function addCommas(nStr)
  {
    nStr = parseFloat(nStr).toFixed(2);

    nStr += '';
    x = nStr.split(',');
    x1 = x[0];
    x2 = x.length > 1 ? ',' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1'+ ',' + '$2');
    }

    if(nStr < 0){
      return '( '+x1 + x2+' )';
    }else{
      return x1 + x2;
    }


  }

  function setFormValidation(id) {
      $(id).validate({
        highlight: function(element) {
          $(element).closest('.form-group').removeClass('has-success').addClass('has-danger');
          $(element).closest('.form-check').removeClass('has-success').addClass('has-danger');
        },
        success: function(element) {
          $(element).closest('.form-group').removeClass('has-danger').addClass('has-success');
          $(element).closest('.form-check').removeClass('has-danger').addClass('has-success');
        },
        errorPlacement: function(error, element) {
          $(element).closest('.form-group').append(error);
        },
      });
    }

  function RemoveSpace(string) {
    return string.split('.').join('');
  }

  function ManualRemove(dari,to,string) {
    return string.split(dari).join(to);
  }

  function clearForm(form) {
    $(":input", form).each(function() {
      var type = this.type;
      var tag = this.tagName.toLowerCase();
      if (type == 'text') {
        this.value = "";
      }
    });
    $(form+" select").val("").trigger("change");
  };



  var window_focus;
  var counter = 1800;
  // var counter = 5;

  $(window).focus(function() {
      window_focus = false;
      counter = 1800;
  });

  $(window).focusout(function() {
      window_focus = true;
  });


  $(document).one('click',function() {
     // ClearSession();
      setInterval(function() {
        // console.log('Count: ' + counter);
        if(window_focus) { counter = counter-1; }
        if(counter == 0){

        }
      }, 1000);
  });
  </script>
<!--  @yield('additionalJS')-->
</body>

</html>
