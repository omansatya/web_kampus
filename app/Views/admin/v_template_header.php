<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title><?php echo $templateJudul ?></title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="<?php echo base_url('admin') ?>/css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
        <style>
            .note-editable {
                background-color: #FFFFFF;
            }
        </style>

    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="<?php echo site_url('admin/article') ?>">Admin</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            
            <ul class="navbar-nav ms-auto me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <!-- <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li> -->
                        <li><a class="dropdown-item" href="<?php echo site_url('admin/logout') ?>">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Menu</div>
                            <!-- batas artikel -->
                            
                            <!-- batas pages -->
                            
                            <!-- prestasi -->
                            <a class="nav-link" href="<?php echo site_url('admin/prestasi') ?>">
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-trophy"></i>
                                </div>
                                Prestasi
                            </a>

                            <!-- prodi -->
                            <a class="nav-link" href="<?php echo site_url('admin/prodi') ?>">
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-school"></i>
                                </div>
                                Prodi
                            </a>
                            <!-- galeri -->
                            <a class="nav-link" href="<?php echo site_url('admin/galeri') ?>">
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-image"></i>
                                </div>
                                Galeri
                            </a>
                            <!-- alumni -->
                            <a class="nav-link" href="<?php echo site_url('admin/alumni') ?>">
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-user-graduate"></i>
                                </div>
                                Alumni
                            </a>
                            <!-- akun -->
                            <a class="nav-link" href="<?php echo site_url('admin/akun') ?>">
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-user"></i>
                                </div>
                                Akun
                            </a>
                            
                            
                            
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?php echo session()->get('akun_nama_lengkap') ?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        
                        <div class="card mb-4">