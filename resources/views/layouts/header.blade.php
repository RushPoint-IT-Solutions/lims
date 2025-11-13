<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- @laravelPWA --}}
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'LiMS') }}</title>
    <link rel="shortcut icon" href="{{url('assets/images/library-icon.png')}}">

    <!-- Layout config Js -->
    <script src="{{asset('/assets/js/layout.js')}}"></script>
    <!-- Bootstrap Css -->
    <link href="{{asset('/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{asset('/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <!-- <link href="{{asset('/assets/css/app.css')}}" rel="stylesheet" type="text/css" /> -->
    <link href="{{asset('/assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{asset('/assets/css/custom.min.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('/assets/css/style.css')}}" rel="stylesheet" type="text/css" />

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
 
    @yield('css')
    <style>
        .helpdesk-link-wrapper {
            position: absolute;
            bottom: 0;
            width: 100%;
        }
        
        .loader {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url("{{ asset('assets/images/loader.gif') }}") 50% 50% no-repeat white;
            opacity: .8;
            background-size: 120px 120px;
        }   
        .menu-title, .navbar-menu .navbar-nav .nav-link {
            color: #FFF !important;
        }
        .navbar-menu {
            background: #420906 !important;
        }
        
        .nav-item:has(.menu-dropdown .nav-link.active) > .nav-link {
            background-color: rgba(255, 193, 7, 0.1);
            border-left: 3px solid #ffffff;
        }

        .nav-item.active > .nav-link.collapsed {
            background-color: rgba(255, 193, 7, 0.15);
            border-left: 4px solid #ffffff;
        }

        .nav-item.active > .nav-link:not(.collapsed) {
            background-color: rgba(255, 193, 7, 0.15);
            border-left: 4px solid #ffffff;
        }

        .menu-dropdown .nav-item a.nav-link.active {
            color: #ffffff !important;
            font-weight: 600;
            background-color: rgba(255, 193, 7, 0.1);
            border-left: 2px solid #ffffff;
            padding-left: calc(0.75rem - 2px);
        }

        .menu-dropdown .nav-item a.nav-link:hover {
            background-color: rgba(255, 255, 255, 0.03);
            transition: all 0.3s ease;
        }

        .menu-dropdown .nav-item a.nav-link {
            color: rgba(255, 255, 255, 0.8) !important;
        }

        /* Library Card Button */
        .library-card-btn {
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: #520000;
            padding: 8px 16px;
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 14px;
            font-weight: 600;
            backdrop-filter: blur(10px);
            display: flex;
            align-items: center;
            gap: 5px;
            margin-right: 15px;
        }

        .library-card-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 255, 255, 0.2);
        }

        .library-card-btn i {
            font-size: 25px;
        }

        /* Library Card Modal Styles */
        .library-card-modal {
            display: none;
            position: fixed;
            z-index: 1050;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.8);
            animation: fadeIn 0.3s ease-out;
            border: none !important;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideUps {
            from { 
                opacity: 0;
                transform: translate(-50%, -40%) scale(0.9);
            }
            to { 
                opacity: 1;
                transform: translate(-50%, -50%) scale(1);
            }
        }

        .library-modal-content {
            background: none !important;
            border: none !important;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 90%;
            max-width: 420px;
            min-width: 320px;
            animation: slideUps 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .library-modal-header {
            text-align: center;
            margin-bottom: 25px;
        }

        .library-modal-title {
            color: white;
            font-size: clamp(24px, 5vw, 28px);
            font-weight: 700;
            margin: 0 0 8px 0;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .library-close-btn {
            color: white;
            position: absolute;
            top: -60px;
            right: 10px;
            font-size: 24px;
            font-weight: bold;
            cursor: pointer;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .library-close-btn:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .flip-card {
            perspective: 1000px;
            width: min(380px, 90vw);
            height: min(240px, 56vw);
            max-height: 240px;
            margin: auto;
        }

        .flip-card-inner {
            position: relative;
            width: 100%;
            height: 100%;
            text-align: center;
            transition: transform 0.8s ease;
            transform-style: preserve-3d;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        }

        .flip-card-front,
        .flip-card-back {
            position: absolute;
            width: 100%;
            height: 100%;
            backface-visibility: hidden;
            border-radius: 5px;
        }

        /* FRONT SIDE STYLES */
        .flip-card-front {
            background: linear-gradient(to bottom, #f5f5f5 0%, #ffffff 30%, #f5f5f5 100%);
            color: white;
            overflow: hidden;
            padding: 0;
            display: flex;
            flex-direction: column;
            border: 2px solid #000000;
        }

        .front-top-section {
            background: #ffffff;
            padding: 3px 6px;
            text-align: center;
            border-bottom: 2px solid #000000;
        }

        .university-name {
            font-size: 14px;
            font-weight: 800;
            color: #800000;
            letter-spacing: 0.5px;
            line-height: 1;
            margin: 0;
        }

        .sub-university-name {
            font-size: 12px;
            font-weight: 800;
            color: #000000;
            letter-spacing: 0.5px;
            line-height: 1;
            margin: 0;
        }

        .campus-name {
            font-size: 10px;
            font-weight: 500;
            color: #000000;
            letter-spacing: 0.3px;
            margin: 1px 0 0 0;
            line-height: 1;
        }

        .lrc-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #8B0000;
            padding: 3px 8px;
            position: relative;
        }

        .marsu-logo, .lrc-logo {
            width: 28px;
            height: 28px;
            object-fit: contain;
            background: white;
            border-radius: 50%;
            padding: 2px;
        }

        .center-name {
            flex: 1;
            font-size: 9px;
            font-weight: 800;
            color: white;
            text-align: center;
            letter-spacing: 0.8px;
            margin: 0 6px;
            line-height: 1.1;
        }

        .card-type-label {
            background: #ffffff;
            color: #000000;
            text-align: center;
            padding: 2px;
            font-size: 7px;
            font-weight: 800;
            letter-spacing: 1px;
            border-top: 1px solid #000000;
            border-bottom: 1px solid #000000;
        }

        .front-main-content {
            display: flex;
            padding: 5px 6px;
            gap: 6px;
            flex: 1;
            align-items: flex-start;
        }

        .student-number-label {
            text-align: center;
            font-size: 5px;
            font-weight: 800;
            color: #000000;
            margin-top: 2px;
            letter-spacing: 0.2px;
            line-height: 1;
        }

        .student-info {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 2px;
            justify-content: center;
        }

        .qr-section {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 5px;
        }

        #qrcode {
            width: 110px;
            height: 110px;
            border: 2px solid #000000;
            background: #ffffff;
            padding: 3px;
        }

        #qrcode img {
            width: 100% !important;
            height: 100% !important;
        }

        .name-field {
            background: #8B0000;
            padding: 4px 6px;
        }

        .name-field .info-label {
            font-size: 10px !important;
            font-weight: 800;
            color: #ffffff;
            display: block;
            margin-bottom: 1px;
            line-height: 1.2;
            letter-spacing: 0.3px;
        }

        .name-field .info-value {
            font-size: 7px;
            color: #ffffff;
            display: block;
            line-height: 1.3;
            font-weight: 600;
        }

        .info-row {
            display: flex;
            flex-direction: column;
            padding: 3px 6px;
            background: #ffffff;
            margin-bottom: 2px;
            border-radius: 2px;
        }

        .info-label {
            font-size: 5.5px;
            font-weight: 800;
            color: #000000;
            letter-spacing: 0.2px;
            line-height: 1;
            margin-bottom: 1px;
        }

        .info-value {
            font-size: 5.5px;
            font-weight: 400;
            color: #000000;
            line-height: 1.1;
        }

        /* BACK SIDE STYLES */
        .flip-card-back {
            background: #ffffff;
            color: #000000;
            transform: rotateY(180deg);
            display: flex;
            flex-direction: column;
            padding: 10px;
        }

        .back-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #800000;
            padding: 8px 10px;
            border-radius: 5px 5px 0 0;
            margin: -10px -10px 0 -10px;
        }

        .back-marsu-logo {
            width: 35px;
            height: 35px;
            object-fit: contain;
        }

        .back-lrc-logo {
            width: 40px;
            height: 40px;
            object-fit: contain;
        }

        .back-title {
            flex: 1;
            text-align: center;
            font-size: 10px;
            font-weight: 700;
            color: white;
            letter-spacing: 0.5px;
            margin: 0 8px;
        }

        .back-content-terms {
            flex: 1;
            padding: 12px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .terms-list {
            flex: 1;
        }

        .terms-list p {
            font-size: 7px;
            text-align: justify;
            line-height: 1.4;
            margin: 0 0 6px 0;
            color: #000000;
        }

        .signature-section {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-top: 8px;
            padding-top: 8px;
            border-top: 1px solid #e0e0e0;
        }

        .student-signature, .librarian-signature {
            text-align: center;
        }

        .signature-line {
            width: 100px;
            border-bottom: 1px solid #000000;
            margin-bottom: 2px;
            height: 20px;
        }

        .signature-label {
            font-size: 6px;
            font-weight: 600;
            color: #000000;
        }

        .librarian-name {
            font-size: 7px;
            font-weight: 700;
            color: #000000;
            margin-top: 2px;
        }

        .librarian-title {
            font-size: 6px;
            font-weight: 400;
            color: #666666;
        }

        .flip-toggle {
            text-align: center;
            margin: 20px 0;
        }

        .flip-btn {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.3);
            padding: min(10px, 2.5vw) min(20px, 5vw);
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: clamp(12px, 3.5vw, 14px);
            font-weight: 600;
            backdrop-filter: blur(10px);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin: 0 auto;
        }

        .flip-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 255, 255, 0.2);
        }

        .show-back .flip-card-inner {
            transform: rotateY(180deg);
        }

        .show-front .flip-card-inner {
            transform: rotateY(0deg);
        }

        @media (max-width: 480px) {
            .library-modal-content {
                width: 95%;
                max-width: 380px;
            }
            
            .flip-card {
                width: min(360px, 90vw);
                height: min(225px, 56vw);
            }
        }

        @media (min-width: 768px) {
            .library-modal-content {
                width: 420px;
                max-width: 420px;
            }
            
            .flip-card {
                width: 380px;
                height: 240px;
            }
        }
        
    </style>

</head>
<body>
    <div id = "loader" class="loader">
    </div>
    <div id="layout-wrapper">

        <header id="page-topbar">
            <div class="layout-width">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box horizontal-logo">
                            <a href="{{url('/')}}" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="{{asset('assets/images/library-icon.png')}}" alt="" height="100">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{asset('assets/images/library-icon.png')}}" alt="" height="100">
                                </span>
                            </a>

                            <a href="{{url('/')}}" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="{{asset('assets/images/library-icon.png')}}" alt="" height="100">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{asset('assets/images/library-icon.png')}}" alt="" height="100">
                                </span>
                            </a>
                        </div>
                        <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger material-shadow-none" id="topnav-hamburger-icon">
                            <span class="hamburger-icon">
                                <span></span>
                                <span></span>
                                <span></span>
                            </span>
                        </button>
                    </div>
                    <div class="d-flex align-items-center">
                        <!-- Library Card Button -->
                        <button class="library-card-btn" id="libraryCardBtn">
                            <i class="fas fa-id-card"></i>
                            {{-- <span>Library ID</span> --}}
                        </button>
                        
                        <div class="dropdown ms-sm-3 header-item topbar-user">
                            <button type="button" class="btn material-shadow-none" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="d-flex align-items-center">
                                    <img class="rounded-circle header-profile-user" src="{{asset(auth()->user()->avatar)}}" onerror="this.src='{{url('assets/images/marsu-logo.png')}}';" alt="Header Avatar">
                                    <span class="text-start ms-xl-2">
                                        <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">{{ current(explode(' ',auth()->user()->name)) }}</span>
                                    </span>
                                </span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <h6 class="dropdown-header">Welcome {{current(explode(' ',auth()->user()->name))}}!</h6>
                              <div class="dropdown-divider"></div>
                              <div class="dropdown-divider"></div>
                               <a class="dropdown-item" href="{{ route('logout') }}" onclick="logout(); show();"> <i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span class="align-middle" data-key="t-logout">Logout</span></a>
                               <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Library ID Card Modal -->
        <div id="libraryCardModal" class="library-card-modal">
            <div class="library-modal-content">
                <span class="library-close-btn">&times;</span>
                <div class="flip-card" id="flipCard">
                    <div class="flip-card-inner">
                        <!-- FRONT SIDE -->
                        <div class="flip-card-front">
                            <div class="front-top-section mt-2">
                                <div class="university-name">MAR<span class="sub-university-name">INDUQUE</span> S<span class="sub-university-name">TATE</span> U<span class="sub-university-name">NIVERSITY</span></div>
                                <div class="campus-name">BOAC, CAMPUS</div>
                            </div>
                            <div class="lrc-header">
                                <img src="{{asset('assets/images/marsu-logo.png')}}" alt="MarSU Logo" class="marsu-logo">
                                <div class="center-name">LEARNING RESOURCE CENTER</div>
                                <img src="{{asset('assets/images/lrc_logo.png')}}" alt="LRC Logo" class="lrc-logo">
                            </div>
                            <div class="card-type-label">IDENTIFICATION CARD</div>
                            <div class="front-main-content">
                                <div class="student-info">
                                    <div class="name-field">
                                        <span class="info-label">Name:</span>
                                        <span class="info-value">{{ auth()->user()->name }}</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">PROGRAM:</span>
                                        <span class="info-value">{{ auth()->user()->program ?? 'N/A' }}</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">ADDRESS:</span>
                                        <span class="info-value">{{ auth()->user()->address ?? 'N/A' }}</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">CONTACT NO.:</span>
                                        <span class="info-value">{{ auth()->user()->contact ?? 'N/A' }}</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">EMAIL ADDRESS:</span>
                                        <span class="info-value">{{ auth()->user()->email }}</span>
                                    </div>
                                </div>
                                <div class="qr-section">
                                    <div id="qrcode"></div>
                                </div>
                            </div>
                        </div>

                        <!-- BACK SIDE -->
                        <div class="flip-card-back">
                            <div class="back-header">
                                <img src="{{asset('assets/images/marsu-logo.png')}}" alt="MarSU Logo" class="back-marsu-logo">
                                <div class="back-title">TERMS AND CONDITIONS</div>
                                <img src="{{asset('assets/images/lrc_logo.png')}}" alt="LRC Logo" class="back-lrc-logo">
                            </div>
                            <div class="back-content-terms">
                                <div class="terms-list">
                                    <p>-This card is not transferable, if lost inform the librarian immediately.</p>
                                    <p>-This card exclusively for MarSU Learning Resource Center use only.</p>
                                    <p>-This card should always be carried while visiting the MarSU Learning Resource Center</p>
                                </div>
                                <div class="signature-section">
                                    <div class="student-signature">
                                        <div class="signature-line"></div>
                                        <div class="signature-label">Student Signature</div>
                                    </div>
                                    <div class="librarian-signature">
                                        <div class="signature-line"></div>
                                        <div class="librarian-name">IARLENE M. RUALO RLt</div>
                                        <div class="librarian-title">College Librarian III</div>
                                        <div class="librarian-title">Head, LRC</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Flip Button -->
                <div class="flip-toggle">
                    <button class="flip-btn" onclick="toggleCard()">
                        <i class="bi bi-arrow-repeat"></i> Flip Card
                    </button>
                </div>
            </div>
        </div>

        <!-- ========== App Menu ========== -->
        <div class="app-menu navbar-menu">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="{{url('/')}}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{asset('assets/images/marsu-logo.png')}}" alt="" height="50">
                    </span>
                    <span class="logo-lg">
                        <img src="{{asset('assets/images/marsu-logo.png')}}" alt="" height="55">
                    </span>
                </a>
                <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
                    <i class="ri-record-circle-line"></i>
                </button>
            </div>
    
        
            <div id="scrollbar">
                <div class="container-fluid">
                    <div id="two-column-menu"></div>
                    <ul class="navbar-nav" id="navbar-nav">
                        <li class="menu-title"><span data-key="t-menu">&emsp;Library Management System</span></li>
                        <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                        
                        <!-- Dashboard -->
                        <li class="nav-item {{ Request::is('/') || Request::is('home') ? 'active' : '' }}">
                            <a class="nav-link menu-link" href="{{url('/')}}">
                                <i class="ri-dashboard-2-line"></i> 
                                <span data-key="t-dashboards">Dashboard</span>
                            </a>
                        </li>

                        <!-- Catalog Submenu -->
                        <li class="nav-item {{ Request::is('frameworks*') || Request::is('cataloging*') ? 'active' : '' }}">
                            <a class="nav-link menu-link {{ Request::is('frameworks*') || Request::is('cataloging*') ? '' : 'collapsed' }}" 
                            href="#sidebarMetadata" data-bs-toggle="collapse" role="button" 
                            aria-expanded="{{ Request::is('frameworks*') || Request::is('cataloging*') ? 'true' : 'false' }}" 
                            aria-controls="sidebarMetadata">
                                <i class="ri-folder-2-line"></i><span data-key="t-metadata">Catalog</span>
                            </a>
                            <div class="menu-dropdown collapse {{ Request::is('frameworks*') || Request::is('cataloging*') ? 'show' : '' }}" id="sidebarMetadata">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{ url('frameworks') }}" class="nav-link {{ Request::is('frameworks*') ? 'active' : '' }}" data-key="t-frameworks">MARC Frameworks</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('cataloging') }}" class="nav-link {{ Request::is('cataloging*') ? 'active' : '' }}" data-key="t-cataloging">Cataloging</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <!-- Circulation Submenu -->
                        <li class="nav-item {{ Request::is('circulation*') || (Request::is('reservation*') && !Request::is('rooms_reservation*')) || Request::is('rooms_reservation*') ? 'active' : '' }}">
                            <a class="nav-link menu-link {{ Request::is('circulation*') || (Request::is('reservation*') && !Request::is('rooms_reservation*')) || Request::is('rooms_reservation*') ? '' : 'collapsed' }}" 
                            href="#sidebarCirculation" data-bs-toggle="collapse" role="button" 
                            aria-expanded="{{ Request::is('circulation*') || (Request::is('reservation*') && !Request::is('rooms_reservation*')) || Request::is('rooms_reservation*') ? 'true' : 'false' }}" 
                            aria-controls="sidebarCirculation">
                                <i class="ri-folder-2-line"></i><span data-key="t-circulation">Circulation</span>
                            </a>
                            <div class="menu-dropdown collapse {{ Request::is('circulation*') || (Request::is('reservation*') && !Request::is('rooms_reservation*')) || Request::is('rooms_reservation*') ? 'show' : '' }}" id="sidebarCirculation">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{ url('circulation') }}" class="nav-link {{ Request::is('circulation*') ? 'active' : '' }}" data-key="t-borrowing">Borrowing</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('reservation') }}" class="nav-link {{ Request::is('reservation*') && !Request::is('rooms_reservation*') ? 'active' : '' }}" data-key="t-reservation">Reserve Books</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('rooms_reservation') }}" class="nav-link {{ Request::is('rooms_reservation*') ? 'active' : '' }}" data-key="t-room-reservation">Reserve Rooms</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <!-- Digital Resource Submenu -->
                        <li class="nav-item {{ Request::is('e_books*') || Request::is('e_resources*') ? 'active' : '' }}">
                            <a class="nav-link menu-link {{ Request::is('e_books*') || Request::is('e_resources*') ? '' : 'collapsed' }}" 
                            href="#sidebarDigital" data-bs-toggle="collapse" role="button" 
                            aria-expanded="{{ Request::is('e_books*') || Request::is('e_resources*') ? 'true' : 'false' }}" 
                            aria-controls="sidebarDigital">
                                <i class="ri-book-2-line"></i><span data-key="t-resources">Digital Resource</span>
                            </a>
                            <div class="menu-dropdown collapse {{ Request::is('e_books*') || Request::is('e_resources*') ? 'show' : '' }}" id="sidebarDigital">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{ url('e_books') }}" class="nav-link {{ Request::is('e_books*') ? 'active' : '' }}" data-key="t-ebooks">E-Books</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('e_resources') }}" class="nav-link {{ Request::is('e_resources*') ? 'active' : '' }}" data-key="t-e-access">E-Resources Access</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <!-- Member Management -->
                        <li class="nav-item {{ Request::is('users*') && !Request::is('admin_configuration*') ? 'active' : '' }}">
                            <a class="nav-link menu-link" href="{{ url('users') }}">
                                <i class="ri-team-line"></i>
                                <span data-key="t-dashboards">Member Management</span>
                            </a>
                        </li>

                        <!-- Admin Section -->
                        @if(auth()->user()->role == "Admin")
                        <li class="menu-title"><span data-key="t-menu">Admin</span></li>
                            <!-- Admin Configuration -->
                            <li class="nav-item {{ Request::is('admin_configuration*') ? 'active' : '' }}">
                                <a class="nav-link menu-link" href="{{ url('admin_configuration') }}">
                                    <i class="ri-settings-3-line"></i>
                                    <span data-key="t-dashboards">Admin Configuration</span>
                                </a>
                            </li>

                            <!-- Settings Submenu -->
                            <li class="nav-item {{ Request::is('branches*') || Request::is('types*') || (Request::is('rooms*') && !Request::is('rooms_reservation*')) || Request::is('racks*') || Request::is('authors*') ? 'active' : '' }}">
                                <a class="nav-link menu-link {{ Request::is('branches*') || Request::is('types*') || (Request::is('rooms*') && !Request::is('rooms_reservation*')) || Request::is('racks*') || Request::is('authors*') ? '' : 'collapsed' }}" 
                                href="#sidebarSettings" data-bs-toggle="collapse" role="button" 
                                aria-expanded="{{ Request::is('branches*') || Request::is('types*') || (Request::is('rooms*') && !Request::is('rooms_reservation*')) || Request::is('racks*') || Request::is('authors*') ? 'true' : 'false' }}" 
                                aria-controls="sidebarSettings">
                                    <i class="ri-rocket-line"></i> <span data-key="t-settings">Settings</span>
                                </a>
                                <div class="menu-dropdown collapse {{ Request::is('branches*') || Request::is('types*') || (Request::is('rooms*') && !Request::is('rooms_reservation*')) || Request::is('racks*') || Request::is('authors*') ? 'show' : '' }}" id="sidebarSettings">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="{{ url('branches') }}" class="nav-link {{ Request::is('branches*') ? 'active' : '' }}" data-key="t-branches">Branches</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ url('types') }}" class="nav-link {{ Request::is('types*') ? 'active' : '' }}" data-key="t-types">Item Types</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{url('/rooms')}}" class="nav-link {{ Request::is('rooms*') && !Request::is('rooms_reservation*') ? 'active' : '' }}" data-key="t-rooms">Rooms</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{url('/racks')}}" class="nav-link {{ Request::is('racks*') ? 'active' : '' }}" data-key="t-racks">Racks</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{url('/authors')}}" class="nav-link {{ Request::is('authors*') ? 'active' : '' }}" data-key="t-authors">Authors</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <!-- Reports -->
                            <li class="nav-item {{ Request::is('reports*') && !Request::is('report_analytics*') ? 'active' : '' }}">
                                <a class="nav-link menu-link" href="{{ url('reports') }}">
                                    <i class="ri-file-chart-line"></i>
                                    <span data-key="t-dashboards">Reports</span>
                                </a>
                            </li>

                            <!-- Report Analytics -->
                            <li class="nav-item {{ Request::is('report_analytics*') ? 'active' : '' }}">
                                <a class="nav-link menu-link" href="{{ url('report_analytics') }}">
                                    <i class="ri-bar-chart-2-line"></i>
                                    <span data-key="t-dashboards">Report Analytics</span>
                                </a>
                            </li>
                        @endif
                
                    </ul>
                </div>
                
                <!-- Sidebar -->
            </div>

            <div class="sidebar-background"></div>
        </div>
        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>
        <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                    <div class="row">
                    </div>
                    @yield('content')
                </div>
            </div>
        
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            {{date('Y')}} © LiMS
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Design & Develop by <span>.<</span>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>


    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->

    <!--preloader-->
    <div id="preloader">
        <div id="status">
            <div class="spinner-border text-primary avatar-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    <!-- Theme Settings -->
    @include('layouts.change_password')
    @include('sweetalert::alert')
    <!-- JAVASCRIPT -->
    <script src="{{asset('/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('/assets/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{asset('/assets/libs/node-waves/waves.min.js')}}"></script>
    <script src="{{asset('/assets/libs/feather-icons/feather.min.js')}}"></script>
    <script src="{{asset('/assets/js/pages/plugins/lord-icon-2.1.0.js')}}"></script>
    <script src="{{asset('/assets/js/plugins.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

   @yield('js')
    <!-- App js -->
    <script src="{{asset('/assets/js/app.js')}}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const qrcodeDiv = document.getElementById("qrcode");
            qrcodeDiv.innerHTML = '';
            
            new QRCode(qrcodeDiv, {
                text: "{{ auth()->user()->id }}-{{ auth()->user()->email }}",
                width: 100,
                height: 100,
                colorDark : "#000000",
                colorLight : "#ffffff",
                correctLevel : QRCode.CorrectLevel.H
            });
        });
    </script>
 
    <script>
        function show() {
            document.getElementById("loader").style.display = "block";
        }
        function logout() {
            event.preventDefault();
            document.getElementById('logout-form').submit();
        }

    </script>
    <script>
        window.addEventListener('load', function() {
            document.getElementById('loader').style.display = 'none';
        });
    </script>

    <script>
        function toggleCard() {
            const flipCard = document.getElementById('flipCard');
            const flipBtn = document.querySelector('.flip-btn');

            flipCard.classList.toggle('show-back');

            if (flipCard.classList.contains('show-back')) {
                flipBtn.innerHTML = '<i class="bi bi-arrow-repeat"></i> Show Front';
            } else {
                flipBtn.innerHTML = '<i class="bi bi-arrow-repeat"></i> Show Back';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById("libraryCardModal");
            const libraryButton = document.getElementById("libraryCardBtn");
            const closeBtn = modal.querySelector(".library-close-btn");

            if (libraryButton) {
                libraryButton.addEventListener("click", function (e) {
                    e.preventDefault();
                    modal.style.display = "block";
                    document.body.style.overflow = "hidden";
                    
                    const flipCard = document.getElementById('flipCard');
                    flipCard.classList.remove('show-back');
                    const flipBtn = document.querySelector('.flip-btn');
                    flipBtn.innerHTML = '<i class="bi bi-arrow-repeat"></i> Flip Card';
                });
            }

            function closeModal() {
                modal.style.display = "none";
                document.body.style.overflow = "auto";
                
                const flipCard = document.getElementById('flipCard');
                flipCard.classList.remove('show-back');
                const flipBtn = document.querySelector('.flip-btn');
                flipBtn.innerHTML = '<i class="bi bi-arrow-repeat"></i> Flip Card';
            }

            if (closeBtn) {
                closeBtn.addEventListener("click", closeModal);
            }

            window.addEventListener("click", (event) => {
                if (event.target === modal) {
                    closeModal();
                }
            });

            document.addEventListener("keydown", (event) => {
                if (event.key === "Escape" && modal.style.display === "block") {
                    closeModal();
                }
            });
        });
    </script>
</body>
</html>