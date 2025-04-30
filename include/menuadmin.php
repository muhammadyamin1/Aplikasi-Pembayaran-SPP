<div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li <?php if($page == "Dashboard") echo "class='active'";?>>
                        <a href="home.php"> <i class="menu-icon fa fa-dashboard"></i>Dashboard</a>
                    </li>
                    <li <?php if($page == "Riwayat") echo "class='active'";?>>
                        <a href="riwayat.php"> <i class="menu-icon fa fa-undo"></i>Riwayat Bayar SPP</a>
                    </li>
                    <li <?php if($page == "Bayar") echo "class='active'";?>>
                        <a href="bayar.php"> <i class="menu-icon fa fa-dollar"></i>Bayar SPP</a>
                    </li>
                    <h3 class="menu-title">Master Data</h3><!-- /.menu-title -->
                    <li <?php if($page == "Kelas") echo "class='active'";?>>
                        <a href="kelas.php"> <i class="menu-icon fa fa-sign-in"></i>Kelas</a>
                    </li>
                    <li <?php if($page == "Kompetensi Keahlian") echo "class='active'";?>>
                        <a href="jurusan.php"> <i class="menu-icon fa fa-list-ul"></i>Kompetensi Keahlian</a>
                    </li>
                    <li <?php if($page == "Siswa") echo "class='active'";?>>
                        <a href="siswa.php"> <i class="menu-icon fa fa-male"></i>Siswa</a>
                    </li>
                    <li <?php if($page == "Pengguna") echo "class='active'";?>>
                        <a href="petugas.php"> <i class="menu-icon fa fa-users"></i>Pengguna</a>
                    </li>
                    <li <?php if($page == "SPP") echo "class='active'";?>>
                        <a href="spp.php"> <i class="menu-icon fa fa-money"></i>SPP</a>
                    </li>
                    <h3 class="menu-title">Profile</h3><!-- /.menu-title -->
                    <li <?php if($page == "Profil Saya") echo "class='active'";?>>
                        <a href="profil.php"> <i class="menu-icon fa fa-user"></i>Profil Saya</a>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->