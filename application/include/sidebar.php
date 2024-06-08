 <?php
     $menuActive = strtolower('');
     $page = (isset($_GET['page']))? $_GET['page'] : '';
     switch($page){
         case 'dasbor': // $page == home (jika isi dari $page adalah home)
             $menuActive = strtolower('dasbor'); // load file home.php yang ada di folder views
             break;

         case 'barang_masuk': // $page == home (jika isi dari $page adalah home)
             $menuActive = strtolower('brg_masuk'); // load file home.php yang ada di folder views
             break;

         case 'barang_keluar': // $page == home (jika isi dari $page adalah home)
             $menuActive = strtolower('brg_keluar'); // load file home.php yang ada di folder views
             break;

         default: // Ini untuk set default jika isi dari $page tidak ada pada 3 kondisi diatas
             $pageNow = ["Halaman Utama"];
     }
 ?>

<ul class="nav">
  <li class="nav-item <?php echo ($menuActive == 'dasbor')?'active':'non-active'; ?> ">
    <a class="nav-link" href="index.php?page=dasbor">
      <i class="material-icons">dashboard</i>
      <p> Data Stok Barang </p>
    </a>
  </li>
 <!--  <li class="nav-item {{ ($menuActive == 'daftarsewa')?'active':'non-active' }} ">
    <a class="nav-link" href="{{route('viewDaftarSewa')}}">
      <i class="material-icons">list</i>
      <p> Daftar Alat Keluar </p>
    </a>
  </li> -->
  <?php
    if($_SESSION['role'] == "Superadmin"){
  ?>
  <li class="nav-item ">
    <a class="nav-link" data-toggle="collapse" href="#menuUserMaintenance">
      <i class="material-icons">list</i>
      <p> Laporan
        <b class="caret"></b>
      </p>
    </a>
    <?php
      $show = false;
      if($menuActive == 'brg_masuk' || $menuActive == 'brg_keluar'  ) {
        $show = true;
      }
    ?>
    <div class="collapse <?php echo ($show)?'show':'';  ?>" id="menuUserMaintenance">
      <ul class="nav">
        <li class="nav-item <?php echo ($menuActive == 'brg_masuk')?'active':'non-active'; ?>">
          <a class="nav-link" href="index.php?page=barang_masuk">
            <span class="sidebar-mini "> <i class="material-icons">list</i> </span>
            <span class="sidebar-normal no-margin-right"> Barang Masuk </span>
          </a>
        </li>
        <li class="nav-item <?php echo ($menuActive == 'brg_keluar')?'active':'non-active'; ?>">
          <a class="nav-link" href="index.php?page=barang_keluar">
            <span class="sidebar-mini "> <i class="material-icons">list</i> </span>
            <span class="sidebar-normal no-margin-right"> Barang Keluar </span>
          </a>
        </li>
      </ul>
    </div>
  </li>
  <?php
  }
  ?>
  <li class="nav-item">
    <a class="nav-link" href="#" data-toggle="modal" data-target="#myModal10">
        <i class="material-icons">power_settings_new</i>
        <p> Keluar </p>
      </button>
    </a>
  </li>
</ul>
