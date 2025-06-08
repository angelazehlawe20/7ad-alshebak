<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Admin Panel Dashboard">
    <meta name="author" content="Admin">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - Admin Panel</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --sidebar-bg: #343a40;
            --sidebar-hover: rgba(255, 255, 255, 0.1);
            --sidebar-active: #0d6efd;
            --main-bg: #f8f9fa;
        }

        .sidebar {
            min-height: 100vh;
            background: var(--sidebar-bg);
            color: #fff;
            transition: all 0.3s ease;
        }

        .sidebar .nav-link {
            color: #fff;
            padding: 15px 20px;
            border-radius: 5px;
            margin: 5px 15px;
            transition: all 0.2s ease;
        }

        .sidebar .nav-link:hover {
            background: var(--sidebar-hover);
            transform: translateX(5px);
        }

        .sidebar .nav-link.active {
            background: var(--sidebar-active);
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        .main-content {
            min-height: 100vh;
            background: var(--main-bg);
        }

        .navbar {
            background: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .dropdown-item:hover {
            background-color: var(--sidebar-hover);
        }

        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                z-index: 999;
                width: 0;
            }

            .sidebar.show {
                width: 250px;
            }
        }
    </style>
</head>

<body class="bg-light">
    <div class="container-fluid">
        <div class="row g-0">
            <!-- Sidebar -->
            @include('admin.layouts.sidebar')

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 px-0 main-content">
                <!-- Top Navbar -->
                <nav class="navbar navbar-expand-lg sticky-top">
                    <div class="container-fluid">
                        <button class="btn btn-link d-md-none" type="button" id="sidebarToggle">
                            <i class="fas fa-bars"></i>
                        </button>
                        <div class="ms-auto">
                            <div class="dropdown">
                                <button class="btn btn-link dropdown-toggle text-dark" type="button" id="userDropdown"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-user-circle me-2"></i> Admin
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end shadow">
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-user-cog me-2"></i> Profile</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="dropdown-item">
                                                <i class="fas fa-sign-out-alt me-2"></i> Logout
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>

                <!-- Page Content -->
                <div class="container-fluid p-4">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Toggle sidebar on mobile
        document.getElementById('sidebarToggle')?.addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('show');
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.querySelector('.sidebar');
            const sidebarToggle = document.getElementById('sidebarToggle');

            if (window.innerWidth <= 768 &&
                !sidebar.contains(event.target) &&
                !sidebarToggle.contains(event.target)) {
                sidebar.classList.remove('show');
            }
        });
    </script>
</body>

</html>
