<?php $nmperiode=$_SESSION['aktif_nmperiode']; 
	//$nmperiode_ang=$_SESSION['nmanggaran_aktif']?>
<header class="main-header">

    <!-- Logo -->
    <a href="#" class="logo">
		<!-- mini logo for sidebar mini 50x50 pixels -->
		<span class="logo-mini"><b>SKA</b>RS</span>
		<!-- logo for regular state and mobile devices -->
		<span class="logo-lg"><b>S</b>istem Akuntansi </span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
		<!-- Sidebar toggle button-->
		<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
			<span class="sr-only">Toggle navigation</span>
		</a>

	  
      <!-- Navbar Right Menu -->
	  <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Control Sidebar Toggle Button -->
		  <li><a href="#"><i class="fa fa-edit"></i> 
            Per.Akuntansi: <?php echo($nmperiode);?>  
			</a>
          </li>
        </ul>
      </div>
	  
    </nav>
</header>