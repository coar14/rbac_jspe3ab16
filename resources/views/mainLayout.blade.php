<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('page-title')</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 1rem;
        }

        body {
            background-color: #f4f4f9;
            color: #333;
        }

        .auth-labels {
            display: inline-block;
            width: 8em;
        }

        .auth-textbox {
            margin-bottom: .5em;
        }

        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 18%;
            background-color: #323335;
            color: #ecf0f1;
            padding: 2rem 1rem;
            overflow-y: auto;
            transition: width 0.3s ease;
        }

        .sidebar:hover {
            width: 22%;
        }

        .sidebar h2 {
            color: #ecdbff;
        }

        .sidebar .nav-link {
            color: #ecf0f1;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background-color: #3498db;
            border-radius: 5px;
            color: #fff;
        }

        .content {
            margin-left: 22%;
            padding: 2rem;
            transition: margin-left 0.3s ease;
        }

        .content-header {
            border-bottom: 2px solid #2c3e50;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
        }

        .tech-icon {
            color: #3498db;
            margin-right: 0.5rem;
        }

        .tech-icons {
            color: #020202;
            margin-right: 0.5rem;
        }

        .logout-button {
            background-color: #ffffff;
            color: #000000;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            margin-right: 0.5rem;
            transition: background-color 0.3s ease;
        }

        .logout-button:hover {
            background-color: #da3c3c;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            @if(Auth::check())
            <div class="col-md-3 sidebar p-4">

                <h2 class="mb-4">
                    {{ Auth::user()->userInfo->user_firstname.' '.Auth::user()->userInfo->user_lastname }}
                </h2>
                <span class="fs-6">
                    <i class="fas fa-user tech-icon"></i>
                    @if(Auth::user()->hasRole('admin'))
                        : Admin User
                    @else
                        : User
                    @endif
                </span>
                <ul class="nav flex-column mt-4">
                    @if(Auth::user()->hasRole('admin'))
                    <li class="nav-item mb-2">
                        <a href="{{ route('dash') }}" class="nav-link"><i class="fas fa-tachometer-alt tech-icon"></i>Dashboard</a>
                    </li>
                    @endif

                    <li class="nav-item mb-2">
                        <a href="{{ route('acctg') }}"
                            @unless(Auth::user()->hasRole('admin') || Auth::user()->hasRole('bookeeper') || Auth::user()->hasRole('auditor') || Auth::user()->hasRole('audasst'))
                                class="nav-link disabled"
                            @else
                                class="nav-link"
                            @endunless
                        ><i class="fas fa-file-invoice-dollar tech-icon"></i>Accounting</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="{{ route('prod') }}"
                            @unless(Auth::user()->hasRole('admin') || Auth::user()->hasRole('assembler'))
                                class="nav-link disabled"
                            @else
                                class="nav-link"
                            @endunless
                        ><i class="fas fa-cogs tech-icon"></i>Production</a>
                    </li>

                    <li class="nav-item mb-2">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="logout-button"><i class="fas fa-sign-out-alt tech-icons"></i>Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
            <div class="col-md-9 content">
                <div class="content-header">
                    <h1>@yield('page-title')</h1>
                </div>
                @yield('page-content')
            </div>
            @else
            <div class="col">
                @yield('auth-content')
            </div>
            @endif
        </div>
    </div>
</body>
</html>
