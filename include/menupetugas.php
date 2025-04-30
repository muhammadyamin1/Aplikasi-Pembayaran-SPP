<div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li <?php if($page == "Dashboard") echo "class='active'";?>>
                        <a href="home.php"> <i class="menu-icon fa fa-dashboard"></i>Dashboard</a>
                    </li>
                    <li <?php if($page == "Riwayat") echo "class='active'";?>>
                        <a href="riwayatpetugas.php"> <i class="menu-icon fa fa-undo"></i>Riwayat Bayar SPP</a>
                    </li>
                    <li <?php if($page == "Bayar") echo "class='active'";?>>
                        <a href="bayar.php"> <i class="menu-icon fa fa-dollar"></i>Bayar SPP</a>
                    </li>
                    <li <?php if($page == "Siswa") echo "class='active'";?>>
                        <a href="siswapetugas.php"> <i class="menu-icon fa fa-eye"></i>Lihat Siswa</a>
                    </li>
                    <h3 class="menu-title">Profile</h3><!-- /.menu-title -->
                    <li <?php if($page == "Profil Saya") echo "class='active'";?>>
                        <a href="profil.php"> <i class="menu-icon fa fa-user"></i>Profil Saya</a>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->