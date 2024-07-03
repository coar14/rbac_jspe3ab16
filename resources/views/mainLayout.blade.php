<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('page-title')</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <style>
        * {
            font-family: calibri;
            font-size: 1.2rem;
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
            overflow-y: auto;
        }

        .content {
            margin-left: 25%;
            padding: 2rem;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            @if(Auth::check())
            <div class="col-md-3 bg-light sidebar p-4">
                <h2 class="mb-4">
                    {{ Auth::user()->userInfo->user_firstname.' '.Auth::user()->userInfo->user_lastname }}
                </h2>
                <span class="fs-6">
                    @if(Auth::user()->hasRole('admin'))
                        : Admin User
                    @else
                        : User
                    @endif
                </span>
                <ul class="nav flex-column">
                    @if(Auth::user()->hasRole('admin'))
                    <li class="nav-item mb-2">
                        <a href="{{ route('dash') }}" class="nav-link text-dark">Dashboard</a>
                    </li>
                    @endif

                    <li class="nav-item mb-2">
                        <a href="{{ route('acctg') }}"
                            @unless(Auth::user()->hasRole('admin') || Auth::user()->hasRole('bookeeper') || Auth::user()->hasRole('auditor') || Auth::user()->hasRole('audasst'))
                                class="nav-link text-secondary disabled"
                            @else
                                class="nav-link text-dark"
                            @endunless
                        >Accounting</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="{{ route('prod') }}"
                            @unless(Auth::user()->hasRole('admin') || Auth::user()->hasRole('assembler'))
                                class="nav-link text-secondary disabled"
                            @else
                                class="nav-link text-dark"
                            @endunless
                        >Production</a>
                    </li>

                    <li class="nav-item mb-2">
                        @include('slugs.logout')
                    </li>
                </ul>
            </div>
            <div class="col-md-9 content">
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
