<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="robots" content="noindex, nofollow">

    <link rel="shortcut icon" href="/favicon.ico">

    <title>LaraMart admin</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link href="/assets/summernote-0.9.0-dist/summernote-bs5.css" rel="stylesheet">
    <script src="/assets/summernote-0.9.0-dist/summernote-bs5.js"></script>

<style>
        body {
            font-family: Arial, sans-serif;
        }
        .bi {
            display: inline-block;
            width: 1rem;
            height: 1rem;
        }

        /*
         * Sidebar
         */

        @media (min-width: 768px) {
            .sidebar .offcanvas-lg {
                position: -webkit-sticky;
                position: sticky;
                top: 48px;
            }
            .navbar-search {
                display: block;
            }
        }

        .sidebar .nav-link {
            font-size: .875rem;
            font-weight: 500;
        }

        .sidebar .nav-link.active {
            color: #2470dc;
        }

        .sidebar-heading {
            font-size: .75rem;
        }

        /*
         * Navbar
         */

        .navbar-brand {
            padding-top: .75rem;
            padding-bottom: .75rem;
            background-color: rgba(0, 0, 0, .25);
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .25);
        }

        .navbar .form-control {
            padding: .75rem 1rem;
        }

    </style>

</head>
<body id="admin">

<div class="container-fluid">
    <div class="row">
        <div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-dark vh-100">
            <div class="offcanvas-md offcanvas-end bg-dark" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="sidebarMenuLabel">LaraMart admin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
                    <a class="nav-link text-white mx-2 fs-4 fw-bold" aria-current="page" href="/">
                        LaraMart admin
                    </a>
                    <hr class="text-white">
                    <ul class="nav flex-column mb-auto">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="/admin/v1">
                                <i class="bi bi-speedometer2"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="/" target="_blank">
                                <i class="bi bi-house"></i> View site <i class="bi bi-arrow-up-right"></i>
                            </a>
                        </li>
                    </ul>

                    <hr class="text-white">

                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 m-1 text-secondary text-uppercase">
                        <span>Website configuration</span>
                    </h6>
                    <ul class="nav flex-column mb-auto">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="/admin/v1/banners">
                                <i class="bi bi-images"></i>
                                Banner
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('admin.menu.index') }}">
                                <i class="bi bi-menu-button-wide-fill"></i>
                                Főmenü
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('admin.blog.index') }}">
                                <i class="bi bi-layout-text-sidebar-reverse"></i>
                                Blog
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="/admin/v1/pages/">
                                <i class="bi bi-layout-sidebar"></i>
                                Pages
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="/admin/v1/categories/">
                                <i class="bi bi-folder2-open"></i>
                                Categories
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="/admin/v1/attributes/">
                                <i class="bi bi-tag"></i>
                                Attributes
                            </a>
                        </li>
                    </ul>

                    <hr class="text-white">

                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 m-1 text-secondary text-uppercase">
                        <span>System</span>
                    </h6>
                    <ul class="nav flex-column mb-auto">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="/admin/v1/users">
                                <i class="bi bi-people"></i>
                                Users
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('showAdmins') }}">
                                <i class="bi bi-person-workspace"></i>
                                Administrators
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="/admin/v1/merchants">
                                <i class="bi bi-buildings"></i>
                                Merchants
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="/admin/v1/users/ads/">
                                <i class="bi bi-badge-ad"></i>
                                User ads
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="/admin/v1/merchants/ads/">
                                <i class="bi bi-badge-ad-fill"></i>
                                Merchant ads
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="/admin/v1/settings">
                                <i class="bi bi-gear"></i>
                                Settings
                            </a>
                        </li>
                    </ul>

                    <hr class="text-white">

                    <ul class="nav flex-column mb-auto">
                        <li class="nav-item">
                            <a href="/profile" class="nav-link text-white"><i class="bi bi-person"></i> Profile</a>
                        </li>
                        <li class="nav-item">
                            <a href="/logout" class="nav-link text-warning"><i class="bi bi-box-arrow-right"></i> Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 vh-100">

            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Dashboard</h1>
            </div>

            @yield('main')

        </main>
    </div>
</div>

</body>
</html>
