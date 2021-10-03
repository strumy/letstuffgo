<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Material Design Bootstrap</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="static/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="static/css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="static/css/style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu:400,500&display=swap" rel="stylesheet">

</head>

<body>




<header class="app-header border-0 navbar navbar-expand-lg navbar-light blue lighten-4">
    <!-- Logo -->
    <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="http://127.0.0.1:8000">
        <span style="color:red;font-weight: bold;">Let</span><span style="color:green;font-weight: bold;">Stuff</span><span style="color:blue;font-weight: bold;">Go</span>
    </a>
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- =================================================== -->
    <!-- ========== Top menu items (ordered left) ========== -->
    <!-- =================================================== -->
    <ul class="nav navbar-nav d-md-down-none">

        <!-- Topbar. Contains the left part -->
        <!-- This file is used to store topbar (left) items -->



    </ul>
    <!-- ========== End of top menu left items ========== -->



    <!-- ========================================================= -->
    <!-- ========= Top menu right items (ordered right) ========== -->
    <!-- ========================================================= -->
    <ul class="nav navbar-nav ml-auto">
        <!-- Topbar. Contains the right part -->
        <!-- This file is used to store topbar (right) items -->



        <li class="nav-item dropdown pr-4">
            <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <img class="img-avatar" src="" alt="Tasneem">
            </a>
            <div class="dropdown-menu dropdown-menu-right mr-4 pb-1 pt-1">
                <a class="dropdown-item" href="http://127.0.0.1:8000/admin/edit-account-info"><i class="fa fa-user"></i> My Account</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="http://127.0.0.1:8000/admin/logout"><i class="fa fa-lock"></i> Logout</a>
            </div>
        </li>
    </ul>
    <!-- ========== End of top menu right items ========== -->
</header>

<div class="app-body">

    <!-- Left side column. contains the sidebar -->
    <div class="sidebar sidebar-pills blue lighten-5">
        <!-- sidebar: style can be found in sidebar.less -->
        <nav class="sidebar-nav overflow-hidden ps">
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="nav">
                <!-- <li class="nav-title">ADMINISTRATION</li> -->
                <!-- ================================================ -->
                <!-- ==== Recommended place for admin menu items ==== -->
                <!-- ================================================ -->

                <!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
                <li class="nav-item open"><a class="nav-link active" href="http://127.0.0.1:8000/admin/dashboard"><i class="fa fa-dashboard nav-icon"></i> Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="http://127.0.0.1:8000/admin/elfinder"><i class="nav-icon fa fa-files-o"></i> <span>File Manager</span></a></li>
                <!-- ======================================= -->
                <!-- <li class="divider"></li> -->
                <!-- <li class="nav-title">Entries</li> -->
            </ul>
            <div class="ps__rail-x" style="left: 0px; top: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; left: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></nav>
        <!-- /.sidebar -->
    </div>



    <main class="main pt-2">



        <div class="container-fluid animated fadeIn">

            <div class="">
                @section('custom-content')

                @show
            </div>



        </div>

    </main>

</div><!-- ./app-body -->

<footer class="app-footer">
</footer>

<script type="text/javascript">
    /* Recover sidebar state */
    if (Boolean(sessionStorage.getItem('sidebar-collapsed'))) {
        var body = document.getElementsByTagName('body')[0];
        body.className = body.className.replace('sidebar-lg-show', '');
    }

    /* Store sidebar state */
    var navbarToggler = document.getElementsByClassName("navbar-toggler");
    for (var i = 0; i < navbarToggler.length; i++) {
        navbarToggler[i].addEventListener('click', function(event) {
            event.preventDefault();
            if (Boolean(sessionStorage.getItem('sidebar-collapsed'))) {
                sessionStorage.setItem('sidebar-collapsed', '');
            } else {
                sessionStorage.setItem('sidebar-collapsed', '1');
            }
        });
    }
</script>

<script type="text/javascript" src="http://127.0.0.1:8000/packages/backpack/base/js/bundle.js?v=4.0.22@9b611865c41143f8ebf2ab39be7af3b564bb0f8d"></script>


<script type="text/javascript">
    Noty.overrideDefaults({
        layout   : 'topRight',
        theme    : 'backstrap',
        timeout  : 2500,
        closeWith: ['click', 'button'],
    });

</script>
<!-- page script -->
<script type="text/javascript">
    // To make Pace works on Ajax calls
    $(document).ajaxStart(function() { Pace.restart(); });

    // Ajax calls should always have the CSRF token attached to them, otherwise they won't work
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    var activeTab = $('[href="' + location.hash.replace("#", "#tab_") + '"]');
    location.hash && activeTab && activeTab.tab('show');
    $('.nav-tabs a').on('shown.bs.tab', function (e) {
        location.hash = e.target.hash.replace("#tab_", "#");
    });
</script>
<script>
    // Set active state on menu element
    var full_url = "http://127.0.0.1:8000/admin/dashboard";
    var $navLinks = $(".sidebar-nav li a");

    // First look for an exact match including the search string
    var $curentPageLink = $navLinks.filter(
        function() { return $(this).attr('href') === full_url; }
    );

    // If not found, look for the link that starts with the url
    if(!$curentPageLink.length > 0){
        $curentPageLink = $navLinks.filter( function() {
            if ($(this).attr('href').startsWith(full_url)) {
                return true;
            }

            if (full_url.startsWith($(this).attr('href'))) {
                return true;
            }

            return false;
        });
    }

    // for the found links that can be considered current, make sure
    // - the parent item is open
    $curentPageLink.parents('li').addClass('open');
    // - the actual element is active
    $curentPageLink.each(function() {
        $(this).addClass('active');
    });
</script>











<!-- SCRIPTS -->
<!-- JQuery -->
<script type="text/javascript" src="static/js/jquery-3.4.1.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="static/js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="static/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="static/js/mdb.min.js"></script>
</body>

</html>
