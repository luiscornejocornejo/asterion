<!doctype html>
<html lang="es">

<head>

    <meta charset="utf-8" />
    <title>Dashboard | Sienna</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="https://siennasystem.com/assets/images/favicon.ico">

    <!-- preloader css -->
    <link rel="stylesheet" href="https://siennasystem.com/assets/css/preloader.min.css" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="https://siennasystem.com/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="https://siennasystem.com/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="https://siennasystem.com/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    <!-- Custom Css -->
    <link href="https://siennasystem.com/assets/css/custom.css" rel="stylesheet" type="text/css" />

    <link href="https://siennasystem.com/assets/css/main.css" rel="stylesheet" type="text/css" />

</head>

<body>

    <!-- <body data-layout="horizontal"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        <a href="index.html" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="https://siennasystem.com/assets/images/logo-sm.svg" alt="" height="24">
                            </span>
                            <span class="logo-lg">
                                <img src="https://siennasystem.com/assets/images/logo-sm.svg" alt="" height="24"> <span class="logo-txt">Minia</span>
                            </span>
                        </a>

                        <a href="index.html" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="https://siennasystem.com/assets/images/logo-sm.svg" alt="" height="24">
                            </span>
                            <span class="logo-lg">
                                <img src="https://siennasystem.com/assets/images/logo-sm.svg" alt="" height="24"> <span class="logo-txt">Minia</span>
                            </span>
                        </a>
                    </div>

                    <button type="button" class="btn btn-sm px-3
                            font-size-16 header-item" id="vertical-menu-btn">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>

                    <!-- App Search-->
                    <form class="app-search d-none d-lg-block">
                        <div class="position-relative">
                            <input type="text" class="form-control" placeholder="Search...">
                            <button class="btn btn-primary" type="button"><i class="bx bx-search-alt align-middle"></i></button>
                        </div>
                    </form>
                </div>

                <div class="d-flex">

                    <div class="dropdown d-inline-block d-lg-none ms-2">
                        <button type="button" class="btn header-item" id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i data-feather="search" class="icon-lg"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg
                                dropdown-menu-end p-0" aria-labelledby="page-header-search-dropdown">
                            <form class="p-3">
                                <div class="form-group m-0">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search ..." aria-label="Search Result">
                                        <button class="btn btn-primary" type="submit"><i class="mdi
                                                    mdi-magnify"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="dropdown d-none d-sm-inline-block">
                        <button type="button" class="btn header-item" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img id="header-lang-img" src="https://siennasystem.com/assets/images/flags/us.jpg" alt="Header
                                    Language" height="16">
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="en">
                                <img src="https://siennasystem.com/assets/images/flags/us.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">English</span>
                            </a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="sp">
                                <img src="https://siennasystem.com/assets/images/flags/spain.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">Spanish</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="gr">
                                <img src="https://siennasystem.com/assets/images/flags/germany.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">German</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="it">
                                <img src="https://siennasystem.com/assets/images/flags/italy.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">Italian</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="ru">
                                <img src="https://siennasystem.com/assets/images/flags/russia.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">Russian</span>
                            </a>
                        </div>
                    </div>

                    <div class="dropdown d-none d-sm-inline-block">
                        <button type="button" class="btn header-item" id="mode-setting-btn">
                            <i data-feather="moon" class="icon-lg
                                    layout-mode-dark"></i>
                            <i data-feather="sun" class="icon-lg
                                    layout-mode-light"></i>
                        </button>
                    </div>

                    <div class="dropdown d-none d-lg-inline-block ms-1">
                        <button type="button" class="btn header-item" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i data-feather="grid" class="icon-lg"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg
                                dropdown-menu-end">
                            <div class="p-2">
                                <div class="row g-0">
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="https://siennasystem.com/assets/images/brands/github.png" alt="Github">
                                            <span>GitHub</span>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="https://siennasystem.com/assets/images/brands/bitbucket.png" alt="bitbucket">
                                            <span>Bitbucket</span>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="https://siennasystem.com/assets/images/brands/dribbble.png" alt="dribbble">
                                            <span>Dribbble</span>
                                        </a>
                                    </div>
                                </div>

                                <div class="row g-0">
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="https://siennasystem.com/assets/images/brands/dropbox.png" alt="dropbox">
                                            <span>Dropbox</span>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="https://siennasystem.com/assets/images/brands/mail_chimp.png" alt="mail_chimp">
                                            <span>Mail Chimp</span>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="https://siennasystem.com/assets/images/brands/slack.png" alt="slack">
                                            <span>Slack</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item
                                noti-icon position-relative" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i data-feather="bell" class="icon-lg"></i>
                            <span class="badge bg-danger rounded-pill">5</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg
                                dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown">
                            <div class="p-3">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="m-0"> Notifications </h6>
                                    </div>
                                    <div class="col-auto">
                                        <a href="#!" class="small text-reset
                                                text-decoration-underline">
                                            Unread (3)</a>
                                    </div>
                                </div>
                            </div>
                            <div data-simplebar style="max-height: 230px;">
                                <a href="#!" class="text-reset
                                        notification-item">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 me-3">
                                            <img src="assets/images/users/avatar-3.jpg" class="rounded-circle
                                                    avatar-sm" alt="user-pic">
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">James Lemire</h6>
                                            <div class="font-size-13
                                                    text-muted">
                                                <p class="mb-1">It will seem
                                                    like simplified English.</p>
                                                <p class="mb-0"><i class="mdi
                                                            mdi-clock-outline"></i>
                                                    <span>1 hours ago</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <a href="#!" class="text-reset
                                        notification-item">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 avatar-sm
                                                me-3">
                                            <span class="avatar-title
                                                    bg-primary rounded-circle
                                                    font-size-16">
                                                <i class="bx bx-cart"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">Your order is
                                                placed</h6>
                                            <div class="font-size-13
                                                    text-muted">
                                                <p class="mb-1">If several
                                                    languages coalesce the
                                                    grammar</p>
                                                <p class="mb-0"><i class="mdi
                                                            mdi-clock-outline"></i>
                                                    <span>3 min ago</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <a href="#!" class="text-reset
                                        notification-item">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 avatar-sm
                                                me-3">
                                            <span class="avatar-title
                                                    bg-success rounded-circle
                                                    font-size-16">
                                                <i class="bx
                                                        bx-badge-check"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">Your item is
                                                shipped</h6>
                                            <div class="font-size-13
                                                    text-muted">
                                                <p class="mb-1">If several
                                                    languages coalesce the
                                                    grammar</p>
                                                <p class="mb-0"><i class="mdi
                                                            mdi-clock-outline"></i>
                                                    <span>3 min ago</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </a>

                                <a href="#!" class="text-reset
                                        notification-item">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 me-3">
                                            <img src="assets/images/users/avatar-6.jpg" class="rounded-circle
                                                    avatar-sm" alt="user-pic">
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">Salena Layfield</h6>
                                            <div class="font-size-13
                                                    text-muted">
                                                <p class="mb-1">As a
                                                    skeptical Cambridge
                                                    friend of mine
                                                    occidental.</p>
                                                <p class="mb-0"><i class="mdi
                                                            mdi-clock-outline"></i>
                                                    <span>1 hours ago</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="p-2 border-top d-grid">
                                <a class="btn btn-sm btn-link font-size-14
                                        text-center" href="javascript:void(0)">
                                    <i class="mdi mdi-arrow-right-circle
                                            me-1"></i> <span>View More..</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item
                                right-bar-toggle me-2">
                            <i data-feather="settings" class="icon-lg"></i>
                        </button>
                    </div>

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item
                                bg-soft-light border-start border-end" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle header-profile-user" src="assets/images/users/avatar-1.jpg" alt="Header Avatar">
                            <span class="d-none d-xl-inline-block ms-1
                                    fw-medium">Shawn L.</span>
                            <i class="mdi mdi-chevron-down d-none
                                    d-xl-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a class="dropdown-item" href="#"><i class="mdi
                                        mdi-face-profile font-size-16
                                        align-middle me-1"></i> Profile</a>
                            <a class="dropdown-item" href="#"><i class="mdi
                                        mdi-credit-card-outline font-size-16
                                        align-middle me-1"></i> Billing</a>
                            <a class="dropdown-item" href="#"><i class="mdi
                                        mdi-account-settings font-size-16
                                        align-middle me-1"></i> Settings</a>
                            <a class="dropdown-item" href="#"><i class="mdi
                                        mdi-lock font-size-16 align-middle
                                        me-1"></i> Lock screen</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#"><i class="mdi
                                        mdi-logout font-size-16 align-middle
                                        me-1"></i> Logout</a>
                        </div>
                    </div>

                </div>
            </div>

        </header>

        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu">

            <div data-simplebar class="h-100">

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu list-unstyled" id="side-menu">
                        <li class="menu-title" data-key="t-menu">Menu</li>
                        <li>
                            <a target="_self" href="/">
                                <i data-feather="home"></i>
                                <span data-key="t-dashboard">Dashboard</span>
                            </a>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i data-feather="grid"></i>
                                <span data-key="t-apps">Configuracion</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li>
                                    <a href="calendar.html">
                                        <span data-key="t-calendar">Calendar</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="chat.html">
                                        <span data-key="t-chat">Chat</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="javascript: void(0);" class="has-arrow">
                                        <span data-key="t-email">Email</span>
                                    </a>
                                    <ul class="sub-menu" aria-expanded="false">
                                        <li><a href="inbox.html" data-key="t-inbox">Inbox</a></li>
                                        <li><a href="read-email.html" data-key="t-read-email">Read
                                                Email</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="javascript: void(0);" class="has-arrow">
                                        <span data-key="t-invoices">Invoices</span>
                                    </a>
                                    <ul class="sub-menu" aria-expanded="false">
                                        <li><a href="invoice-list.html" data-key="t-invoice-list">Invoice
                                                List</a></li>
                                        <li><a href="invoice-detail.html" data-key="t-invoice-detail">Invoice
                                                Detail</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="javascript: void(0);" class="has-arrow">
                                        <span data-key="t-contacts">Contacts</span>
                                    </a>
                                    <ul class="sub-menu" aria-expanded="false">
                                        <li><a href="user-grid.html" data-key="t-user-grid">User
                                                Grid</a></li>
                                        <li><a href="user-list.html" data-key="t-user-list">User
                                                List</a></li>
                                        <li><a href="profile.html" data-key="t-profile">Profile</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i data-feather="users"></i>
                                <span data-key="t-authentication">Usuarios</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a target="_self" href="login.html" data-key="t-login">Login</a></li>
                                <li><a target="_self" href="register.html" data-key="t-register">Register</a></li>
                                <li><a target="_self" href="recover-password.html" data-key="t-recover-password">Recover
                                        Password</a></li>
                                <li><a target="_self" href="lock-screen.html" data-key="t-lock-screen">Lock Screen</a></li>
                                <li><a target="_self" href="confirm-mail.html" data-key="t-confirm-mail">Confirm
                                        Mail</a></li>
                                <li><a target="_self" href="email-verification.html" data-key="t-email-verification">Email
                                        Verification</a></li>
                                <li><a target="_self" href="two-step-verification.html" data-key="t-two-step-verification">Two
                                        Step Verification</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i data-feather="file-text"></i>
                                <span data-key="t-pages">Pages</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="starter-page.html" data-key="t-starter-page">Starter
                                        Page</a></li>
                                <li><a target="_self" href="maintenance.html" data-key="t-maintenance">Maintenance</a></li>
                                <li><a target="_self" href="coming-soon.html" data-key="t-coming-soon">Coming Soon</a></li>
                                <li><a href="timeline.html" data-key="t-timeline">Timeline</a></li>
                                <li><a href="faqs.html" data-key="t-faqs">FAQs</a></li>
                                <li><a href="pricing.html" data-key="t-pricing">Pricing</a></li>
                                <li><a target="_self" href="404.html" data-key="t-error-404">Error 404</a></li>
                                <li><a target="_self" href="500.html" data-key="t-error-500">Error 500</a></li>
                            </ul>
                        </li>




                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i data-feather="sliders"></i>
                                <span data-key="t-tables">Reporting</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a target="_self" href="/ceviche" data-key="t-basic-tables">Rposrting</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i data-feather="pie-chart"></i>
                                <span data-key="t-charts">Charts</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a target="_self" href="graficos" data-key="t-apex-charts">Graficos</a></li>

                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- Sidebar -->
            </div>


        </div>