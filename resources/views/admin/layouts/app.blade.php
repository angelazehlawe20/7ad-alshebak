<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - Admin Panel</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        .sidebar {
            min-height: 100vh;
            background: #343a40;
            color: #fff;
        }

        .sidebar .nav-link {
            color: #fff;
            padding: 15px 20px;
            border-radius: 5px;
            margin: 5px 15px;
        }

        .sidebar .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .sidebar .nav-link.active {
            background: #0d6efd;
        }

        .main-content {
            min-height: 100vh;
            background: #f8f9fa;
        }

        .navbar {
            background: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            @include('admin.layouts.sidebar')

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 px-0 main-content">
                <!-- Top Navbar -->
                <nav class="navbar navbar-expand-lg">
                    <div class="container-fluid">
                        <button class="btn btn-link d-md-none" type="button">
                            <i class="fas fa-bars"></i>
                        </button>
                        <div class="ms-auto">
                            <div class="dropdown">
                                <button class="btn btn-link dropdown-toggle" type="button" id="userDropdown"
                                    data-bs-toggle="dropdown">
                                    <i class="fas fa-user me-2"></i> Admin
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i> Settings</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>

                <!-- Page Content -->
                <div class="container-fluid py-4">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
