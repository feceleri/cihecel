<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="/img/favicon.ico">
    <title>Cihecel</title>
    <link rel="icon" href="<?= base_url('public/resources/img/logoPequeno.png') ?>" sizes="32x32" style="border-radius:10px;"> 
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/resources') ?>/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/resources') ?>/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/resources') ?>/css/style.css">
    <?= $this->renderSection("css"); ?>
    <!-- Style -->

    <!--[if lt IE 9]>
		<script src="/js/html5shiv.min.js"></script>
		<script src="/js/respond.min.js"></script>
	<![endif]-->
</head>

<body>
    <div class="main-wrappe" >
        <div class="header">
            <div class="header-left">
                <a href="#" class="logo">
                    <img src="<?= base_url('public/resources/img/logoGrande.png') ?>" id='logoGrande' class="logoPrincipal show" alt="logo cihecel">
                    <img src="<?= base_url('public/resources/img/logoGrandeCortada.png') ?>"  id='logoPequeno' class="logoPrincipal" alt="logo cihecel">
                </a>
            </div>
            <a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
            <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
            <ul class="nav user-menu float-right">
                <li class="nav-item dropdown has-arrow">
                    <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                        <span>Guilherme Cardoso</span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="profile.html">My Profile</a>
                        <a class="dropdown-item" href="edit-profile.html">Edit Profile</a>
                        <a class="dropdown-item" href="settings.html">Settings</a>
                        <a class="dropdown-item" href="login.html">Logout</a>
                    </div>
                </li>
            </ul>
            <div class="dropdown mobile-user-menu float-right">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="profile.html">My Profile</a>
                    <a class="dropdown-item" href="edit-profile.html">Edit Profile</a>
                    <a class="dropdown-item" href="settings.html">Settings</a>
                    <a class="dropdown-item" href="login.html">Logout</a>
                </div>
            </div>
        </div>
        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="menu-title">Menu</li>
                        <li class="active">
                            <a href="<?= base_url('public')?>"><i class="fa fa-user"></i> <span>Atendimento</span></a>
                        </li>
                    
                        <li class="submenu">
                            <a href="#"><i class="fa fa-search"></i> <span> Consulta</span> <span class="menu-arrow"></span></a>
                            <ul style="display: none;">
                                <li><a href="employees.html">Consulta 1</a></li>
                                <li><a href="leaves.html">Consulta 2</a></li>
                                <li><a href="holidays.html">Consulta 3</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="page-wrapper">
        <!-- Conteudo -->
        <?= $this->renderSection("conteudo"); ?>
        </div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>
    <!-- <footer style="background-color:black;height:31px;margin-top: 77px;">teste</footer> -->
    <script src="<?= base_url('public') ?>/resources/js/jquery-3.2.1.min.js"></script>
    <script src="<?= base_url('public') ?>/resources/js/popper.min.js"></script>
    <script src="<?= base_url('public') ?>/resources/js/bootstrap.min.js"></script>
    <script src="<?= base_url('public') ?>/resources/js/jquery.slimscroll.js"></script>
    <script src="<?= base_url('public') ?>/resources/js/Chart.bundle.js"></script>
    <script src="<?= base_url('public') ?>/resources/js/chart.js"></script>
    <script src="<?= base_url('public') ?>/resources/js/app.js"></script>
    <!-- Script -->
    <?= $this->renderSection("script"); ?>
</body>



</html>