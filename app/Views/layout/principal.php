<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="/img/favicon.ico">
    <title>Cihesel</title>
    <link rel="icon" href="<?= base_url('resources/img/logoPequeno.png') ?>" sizes="32x32" style="border-radius:10px;">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- <link rel="stylesheet" type="text/css" href="<?= base_url('resources') ?>/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="    https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('resources') ?>/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('resources') ?>/css/style.css">
    <link href="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <?= $this->renderSection("css"); ?>

    <style>
        a {
            text-decoration: none;
        }

        a.btn.btn-secondary.dropdown-toggle {
            background: white;
            color: black;
            border: none;
        }
    </style>

</head>

<body class="mini-sidebar">
    <div class="main-wrappe">
        <div class="header print">
            <div class="header-left">
                <a href="<?= base_url('atendimento') ?>" class="logo">
                    <img src="<?= base_url('resources/img/logoGrande.png') ?>" id='logoGrande' class="logoPrincipal" alt="logo cihecel">
                    <img src="<?= base_url('resources/img/logoGrandeCortada.png') ?>" id='logoPequeno' class="logoPrincipal  show" alt="logo cihecel">
                </a>
            </div>
            <a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
            <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
            <div class="dropdown float-end m-3">
                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span style="font-size: 15px; padding:3px; text-transform: capitalize;"> <?= $_SESSION['usuario']['user']->nome; ?></span> <i class="fa fa-caret-down" aria-hidden="true"></i>
                </a>

                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="<?= base_url('login/settings') ?>">Configurações<i class="fa fa-cog float-end" aria-hidden="true"></i></a> </li>
                    <li><a class="dropdown-item" href="<?= base_url('login/logout') ?>">Logout<i class="fa fa-sign-out float-end" aria-hidden="true"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="sidebar print" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="menu-title">Menu</li>
                        <li class="active">
                            <a title="Todos os Pacientes" href="<?= base_url('') ?>"><i class="fa fa-user"></i> <span>Pacientes</span></a>
                        </li>
                        <li class="active">
                            <a title="Informações Incompletas" href="<?= base_url('atendimento/incompletos') ?>"><i class="fa fa-question-circle" aria-hidden="true"></i><span>Info Incompleta</span></a>
                        </li>
                        <?php if ($_SESSION['usuario']['user']->tipo == '1') : ?>
                            <li class="active">
                                <a title="Listagem" href="<?= base_url('listagemcontroller/listagem') ?>"><i class="fa fa-address-book" aria-hidden="true"></i><span>Listagem</span></a>
                            </li>
                        <?php endif; ?>
                        <li class="active">
                            <a title="Panoramas" href="<?= base_url('atendimento/panoramas') ?>"><i class="fa fa-pie-chart" aria-hidden="true"></i><span>Relátorio</span></a>
                        </li>
                        <li class="active">
                            <a title="Relatórios" href="<?= base_url('atendimento/novos') ?>"><i class="fa fa-line-chart" aria-hidden="true"></i><span>Relátorio</span></a>
                        </li>
                        <li class="active">
                            <a title="Atendimentos Anteriores" href="<?= base_url('atendimento/legados') ?>"><i class="fa fa-clock-o" aria-hidden="true"></i><span>Atendimentos Anteriores</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="toast-container position-fixed bottom-0 end-0 p-3" style="top: 10px; right: 10px; z-index: 9999;">
            <div id="basicToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="3000">
                <div class="alert" style="margin-bottom: 0;" id="alerta">
                    <span id="msgInfo" style="text-transform: uppercase;"></span>
                    <button type="button" class="btn-close btn-close-black float-end" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>

        <div class="page-wrapper ajuste" style="padding: 100px 18px;">
            <!-- Conteudo -->
            <?= $this->renderSection("conteudo"); ?>
        </div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>
    <!-- <footer style="background-color:black;height:31px;margin-top: 77px;">teste</footer> -->
    <script src="<?= base_url('public') ?>/resources/js/jquery-3.2.1.min.js"></script>
    <script src="<?= base_url('public') ?>/resources/js/popper.min.js"></script>
    <!-- <script src="<?= base_url('public') ?>/resources/js/bootstrap.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('public') ?>/resources/js/jquery.slimscroll.js"></script>
    <script src="<?= base_url('public') ?>/resources/js/Chart.bundle.js"></script>
    <script src="<?= base_url('public') ?>/resources/js/chart.js"></script>
    <script src="<?= base_url('public') ?>/resources/js/app.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Script -->
    <?= $this->renderSection("script"); ?>
</body>



</html>