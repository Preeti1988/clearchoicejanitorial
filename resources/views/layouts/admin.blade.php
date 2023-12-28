<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <title> @yield('title', config('app.name'))</title>
    @stack('css')
    <link rel="stylesheet" type="text/css" href="{{ custom_asset('public/assets/admin-css/header-footer.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ custom_asset('public/assets/admin-plugins/OwlCarousel/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ custom_asset('public/assets/admin-css/responsive.css') }}">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="{{ custom_asset('public/assets/admin-js/jquery-3.7.0.min.js') }}" type="text/javascript"></script>
    <script src="{{ custom_asset('public/assets/admin-plugins/bootstrap/js/bootstrap.bundle.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ custom_asset('public/assets/admin-plugins/OwlCarousel/owl.carousel.js') }}" type="text/javascript">
    </script>
    <script src="{{ custom_asset('public/assets/admin-js/function.js') }}" type="text/javascript"></script>
    <script src="{{ custom_asset('public/assets/admin-plugins/jquery-validation/jquery.validate.min.js') }}"></script>

    <script src="{{ custom_asset('public/assets/admin-plugins/sweetalert2/sweetalert2.min.js') }}" type="text/javascript">
    </script>
    <link rel="stylesheet"href="{{ custom_asset('public/assets/admin-plugins/sweetalert2/sweetalert2.min.css') }}"
        type="text/css" />

    <style>
        .invalid-feedback {
            border: 1px solid red !important;
        }

        input {
            color: #000 !important;
        }

        input::placeholder {
            color: rgb(180, 178, 178) !important;
            /* Change this to your desired color */
        }
    </style>

</head>

<body class="main-site ccj-panel">
    <?php
    $currentURL = Route::currentRouteName();
    ?>
    <div class="page-body-wrapper">
        <div class="sidebar-wrapper sidebar-offcanvas" id="sidebar">
            <div class="sidebar-logo">
                <a class="brand-logo" href="{{ url('/') }}">
                    <img class="" src="{{ custom_asset('public/assets/admin-images/logo.webp') }}"
                        alt="">
                </a>
                <!--<a class="brand-logo-mini" href="index.html">-->
                <!--    <img class="" src="{{ custom_asset('public/assets/admin-images/logo-icon.svg') }}" alt="">-->
                <!--</a>-->
            </div>
            <div class="sidebar-nav">
                <nav class="sidebar">
                    <ul class="nav">
                        <li class="nav-item @if ($currentURL == 'Homes' || $currentURL == 'Dashboard' || $currentURL == 'Profile') active @endif">
                            <a class="nav-link" href="{{ url('/') }}">
                                <span class="menu-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <path
                                            d="M10.5 19.9V4.1C10.5 2.6 9.86 2 8.27 2H4.23C2.64 2 2 2.6 2 4.1V19.9C2 21.4 2.64 22 4.23 22H8.27C9.86 22 10.5 21.4 10.5 19.9Z"
                                            stroke="white" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M22 10.9V4.1C22 2.6 21.36 2 19.77 2H15.73C14.14 2 13.5 2.6 13.5 4.1V10.9C13.5 12.4 14.14 13 15.73 13H19.77C21.36 13 22 12.4 22 10.9Z"
                                            stroke="white" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M22 19.9V18.1C22 16.6 21.36 16 19.77 16H15.73C14.14 16 13.5 16.6 13.5 18.1V19.9C13.5 21.4 14.14 22 15.73 22H19.77C21.36 22 22 21.4 22 19.9Z"
                                            stroke="white" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </span>
                                <span class="menu-title">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item @if (
                            $currentURL == 'Clients' ||
                                $currentURL == 'ClientDetails' ||
                                $currentURL == 'Addclient' ||
                                $currentURL == 'EditClient') active @endif">

                            <a class="nav-link" href="{{ url('/client') }}">
                                <span class="menu-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <path
                                            d="M9.16 10.87C9.06 10.86 8.94 10.86 8.83 10.87C6.45 10.79 4.56 8.84 4.56 6.44C4.56 3.99 6.54 2 9 2C11.45 2 13.44 3.99 13.44 6.44C13.43 8.84 11.54 10.79 9.16 10.87Z"
                                            stroke="white" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M16.41 4C18.35 4 19.91 5.57 19.91 7.5C19.91 9.39 18.41 10.93 16.54 11C16.46 10.99 16.37 10.99 16.28 11"
                                            stroke="white" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M4.16 14.56C1.74 16.18 1.74 18.82 4.16 20.43C6.91 22.27 11.42 22.27 14.17 20.43C16.59 18.81 16.59 16.17 14.17 14.56C11.43 12.73 6.92 12.73 4.16 14.56Z"
                                            stroke="white" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M18.34 20C19.06 19.85 19.74 19.56 20.3 19.13C21.86 17.96 21.86 16.03 20.3 14.86C19.75 14.44 19.08 14.16 18.37 14"
                                            stroke="white" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </span>
                                <span class="menu-title">Client list</span>
                            </a>
                        </li>

                        <li class="nav-item @if (
                            $currentURL == 'TeamActive' ||
                                $currentURL == 'TeamInactive' ||
                                $currentURL == 'MemberRequest' ||
                                $currentURL == 'AddMember' ||
                                $currentURL == 'TeamDetail') active @endif">

                        <li class="nav-item @if (
                            $currentURL == 'TeamActive' ||
                                $currentURL == 'TeamInactive' ||
                                $currentURL == 'MemberRequest' ||
                                $currentURL == 'EditTeamMember') active @endif">

                            <a class="nav-link" href="{{ url('/teams-active') }}">
                                <span class="menu-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <path
                                            d="M18 7.16C17.94 7.15 17.87 7.15 17.81 7.16C16.43 7.11 15.33 5.98 15.33 4.58C15.33 3.15 16.48 2 17.91 2C19.34 2 20.49 3.16 20.49 4.58C20.48 5.98 19.38 7.11 18 7.16Z"
                                            stroke="white" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M16.97 14.44C18.34 14.67 19.85 14.43 20.91 13.72C22.32 12.78 22.32 11.24 20.91 10.3C19.84 9.59001 18.31 9.35 16.94 9.59"
                                            stroke="white" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M5.97001 7.16C6.03001 7.15 6.10001 7.15 6.16001 7.16C7.54001 7.11 8.64001 5.98 8.64001 4.58C8.64001 3.15 7.49001 2 6.06001 2C4.63001 2 3.48001 3.16 3.48001 4.58C3.49001 5.98 4.59001 7.11 5.97001 7.16Z"
                                            stroke="white" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M7 14.44C5.63 14.67 4.12 14.43 3.06 13.72C1.65 12.78 1.65 11.24 3.06 10.3C4.13 9.59001 5.66 9.35 7.03 9.59"
                                            stroke="white" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M12 14.63C11.94 14.62 11.87 14.62 11.81 14.63C10.43 14.58 9.33002 13.45 9.33002 12.05C9.33002 10.62 10.48 9.47 11.91 9.47C13.34 9.47 14.49 10.63 14.49 12.05C14.48 13.45 13.38 14.59 12 14.63Z"
                                            stroke="white" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M9.09 17.78C7.68 18.72 7.68 20.26 9.09 21.2C10.69 22.27 13.31 22.27 14.91 21.2C16.32 20.26 16.32 18.72 14.91 17.78C13.32 16.72 10.69 16.72 9.09 17.78Z"
                                            stroke="white" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </span>
                                <span class="menu-title">Teams</span>
                            </a>
                        </li>
                        <li class="nav-item @if ($currentURL == 'Chats' || $currentURL == 'ChatsID') active @endif">
                            <a class="nav-link" href="{{ route('Chats') }}">
                                <span class="menu-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <path
                                            d="M17 9C17 12.87 13.64 16 9.5 16L8.57001 17.12L8.02 17.78C7.55 18.34 6.65 18.22 6.34 17.55L5 14.6C3.18 13.32 2 11.29 2 9C2 5.13 5.36 2 9.5 2C12.52 2 15.13 3.67001 16.3 6.07001C16.75 6.96001 17 7.95 17 9Z"
                                            stroke="white" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M22 12.86C22 15.15 20.82 17.18 19 18.46L17.66 21.41C17.35 22.08 16.45 22.21 15.98 21.64L14.5 19.86C12.08 19.86 9.92001 18.79 8.57001 17.12L9.5 16C13.64 16 17 12.87 17 9C17 7.95 16.75 6.96001 16.3 6.07001C19.57 6.82001 22 9.57999 22 12.86Z"
                                            stroke="white" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M7 9H12" stroke="white" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </span>
                                <span class="menu-title">Chat Support ({{ TotalCountMSG() }})</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('services.scheduler') }}">
                                <span class="menu-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <path d="M8 2V5" stroke="white" stroke-width="1.5" stroke-miterlimit="10"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M16 2V5" stroke="white" stroke-width="1.5" stroke-miterlimit="10"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M3.5 9.09H20.5" stroke="white" stroke-width="1.5"
                                            stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                        <path
                                            d="M21 8.5V17C21 20 19.5 22 16 22H8C4.5 22 3 20 3 17V8.5C3 5.5 4.5 3.5 8 3.5H16C19.5 3.5 21 5.5 21 8.5Z"
                                            stroke="white" stroke-width="1.5" stroke-miterlimit="10"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M15.6947 13.7H15.7037" stroke="white" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M15.6947 16.7H15.7037" stroke="white" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M11.9955 13.7H12.0045" stroke="white" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M11.9955 16.7H12.0045" stroke="white" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M8.29431 13.7H8.30329" stroke="white" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M8.29431 16.7H8.30329" stroke="white" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </span>
                                <span class="menu-title">Service Scheduler </span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('services.index') }}">
                                <span class="menu-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <path
                                            d="M8.00001 22H16C20.02 22 20.74 20.39 20.95 18.43L21.7 10.43C21.97 7.99 21.27 6 17 6H7.00001C2.73001 6 2.03001 7.99 2.30001 10.43L3.05001 18.43C3.26001 20.39 3.98001 22 8.00001 22Z"
                                            stroke="white" stroke-width="1.5" stroke-miterlimit="10"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M8 6V5.2C8 3.43 8 2 11.2 2H12.8C16 2 16 3.43 16 5.2V6" stroke="white"
                                            stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M14 13V14C14 14.01 14 14.01 14 14.02C14 15.11 13.99 16 12 16C10.02 16 10 15.12 10 14.03V13C10 12 10 12 11 12H13C14 12 14 12 14 13Z"
                                            stroke="white" stroke-width="1.5" stroke-miterlimit="10"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M21.65 11C19.34 12.68 16.7 13.68 14 14.02" stroke="white"
                                            stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M2.62 11.27C4.87 12.81 7.41 13.74 10 14.03" stroke="white"
                                            stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </span>
                                <span class="menu-title">Manage Services</span>
                            </a>
                        </li>

                        <li class="nav-item @if ($currentURL == 'Master') active @endif">
                            <a class="nav-link" href="{{ url('master') }}">
                                <span class="menu-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <path
                                            d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z"
                                            stroke="white" stroke-width="1.5" stroke-miterlimit="10"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path
                                            d="M2 12.88V11.12C2 10.08 2.85 9.22 3.9 9.22C5.71 9.22 6.45 7.94 5.54 6.37C5.02 5.47 5.33 4.3 6.24 3.78L7.97 2.79C8.76 2.32 9.78 2.6 10.25 3.39L10.36 3.58C11.26 5.15 12.74 5.15 13.65 3.58L13.76 3.39C14.23 2.6 15.25 2.32 16.04 2.79L17.77 3.78C18.68 4.3 18.99 5.47 18.47 6.37C17.56 7.94 18.3 9.22 20.11 9.22C21.15 9.22 22.01 10.07 22.01 11.12V12.88C22.01 13.92 21.16 14.78 20.11 14.78C18.3 14.78 17.56 16.06 18.47 17.63C18.99 18.54 18.68 19.7 17.77 20.22L16.04 21.21C15.25 21.68 14.23 21.4 13.76 20.61L13.65 20.42C12.75 18.85 11.27 18.85 10.36 20.42L10.25 20.61C9.78 21.4 8.76 21.68 7.97 21.21L6.24 20.22C5.33 19.7 5.02 18.53 5.54 17.63C6.45 16.06 5.71 14.78 3.9 14.78C2.85 14.78 2 13.92 2 12.88Z"
                                            stroke="white" stroke-width="1.5" stroke-miterlimit="10"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </span>
                                <span class="menu-title">Master</span>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>
                                <span class="menu-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <path d="M9.32001 6.5L11.88 3.94L14.44 6.5" stroke="white" stroke-width="1.5"
                                            stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M11.88 14.18V4.01" stroke="white" stroke-width="1.5"
                                            stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M4 12C4 16.42 7 20 12 20C17 20 20 16.42 20 12" stroke="white"
                                            stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </span>
                                <span class="menu-title">Logout</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="body-wrapper">
            <div class="header">
                <nav class="navbar">
                    <div class="navbar-menu-wrapper">
                        <ul class="navbar-nav f-navbar-nav">
                            <!-- <li class="nav-item">
                                <a class="nav-link nav-toggler" data-toggle="minimize">
                                   <img src="{{ custom_asset('public/assets/admin-images/menu-icon.svg') }}">
                                </a>
                            </li> -->
                            <li class="nav-item">
                                <div class="breadcrumb-title">
                                    @if ($currentURL == 'Homes')
                                        Dashboard
                                    @elseif($currentURL == 'Dashboard')
                                        Dashboard
                                    @elseif($currentURL == 'Clients')
                                        Clients
                                    @elseif($currentURL == 'ClientDetails')
                                        Client Details
                                    @elseif($currentURL == 'CreateSchedular')
                                        Create Schedular
                                    @elseif($currentURL == 'Profile')
                                        Profile
                                    @elseif($currentURL == 'Master')
                                        Master
                                    @elseif($currentURL == 'TeamActive' || $currentURL == 'TeamInactive')
                                        Teams
                                    @elseif($currentURL == 'TeamDetail')
                                        Team Detail
                                    @elseif($currentURL == 'MemberRequestDetail')
                                        Member Request Detail
                                    @elseif($currentURL == 'MemberRequest')
                                        Member Registration Requests
                                    @elseif($currentURL == 'SaveClient')
                                        Save Client
                                    @elseif($currentURL == 'team')
                                        Team
                                    @elseif($currentURL == 'Addclient')
                                        Add New Client
                                    @elseif($currentURL == 'AddMember')
                                        Add New Team Members
                                    @elseif($currentURL == 'EditTeamMember')
                                        Edit Team Members
                                    @elseif($currentURL == 'EditClient')
                                        Edit Client
                                    @elseif($currentURL == 'services.scheduler')
                                        Service Scheduler
                                    @elseif($currentURL == 'Chats')
                                        Chat
                                    @elseif($currentURL == 'ChatsID')
                                        Chat
                                    @else
                                    @endif
                                </div>
                            </li>
                        </ul>
                        <ul class="navbar-nav">
                            <li class="nav-item noti-dropdown dropdown">
                                <a class="nav-link  dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="noti-icon">
                                        <img src="{{ custom_asset('public/assets/admin-images/notification.svg') }}"
                                            alt="user">
                                        <span class="noti-badge">3</span>
                                    </div>
                                </a>
                                <div class="dropdown-menu">

                                </div>
                            </li>
                            <li class="nav-item profile-dropdown dropdown">
                                <a class="nav-link dropdown-toggle" id="profile" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <div class="profile-pic">
                                        <div class="profile-pic-image">
                                            <img src="{{ custom_asset('public/assets/admin-images/userprofile.png') }}"
                                                alt="user">
                                        </div>
                                        <div class="profile-pic-text">
                                            <h3>{{ Auth::user()->fullname }}</h3>
                                            <p>Administrator</p>
                                        </div>
                                    </div>
                                </a>
                                <div class="dropdown-menu">
                                    <a href="{{ url('/profile') }}" class="dropdown-item">
                                        <i class="las la-user"></i> Profile
                                    </a>
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                        class="dropdown-item">
                                        <i class="las la-sign-out-alt"></i> Logout
                                    </a>
                                </div>
                            </li>
                            <li class="nav-item profile-dropdown dropdown">
                                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center"
                                    type="button" data-toggle="offcanvas">
                                    <span class="icon-menu"><img
                                            src="{{ custom_asset('public/assets/admin-images/menu-icon.svg') }}"></span>
                                </button>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
            @yield('content')
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>
    @foreach ($errors->all() as $item)
        <script>
            $(document).ready(function() {
                toastr.error("{{ $item }}");
            });
        </script>
    @endforeach
    <script>
        var base_url = "{{ url('/') }}";

        $(document).ready(function() {
            if ("{{ Session::has('success') }}") {
                toastr.success(" {{ Session::get('success') }} ");
            }
            if ("{{ Session::has('error') }}") {
                toastr.error("{{ Session::get('error') }} ");
            }
            if ("{{ Session::has('warn') }}") {
                toastr.warning(" {{ Session::get('warn') }} ");
            }
        });
        $(document).ready(function() {
            $("#preloader").hide();
        });
        $(":input").inputmask();
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"
        integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @stack('js')


</body>

</html>
