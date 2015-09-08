<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BanglaOCR - @yield('title')</title>
    <link href="/css/app.css" rel="stylesheet">
</head>
<body>
<div id="page-wrapper">

    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <ul class="sidebar">
            <li id="toggle-sidebar" class="sidebar-main"><a href="/">Dashboard<span class="menu-icon fa fa-dashboard"></span></a></li>
            <li class="sidebar-title"><span>NAVIGATION</span></li>
            @if ($user)
            <li class="sidebar-list"><a href="#upload" data-toggle="modal" data-target="#uploadModal">Add Image <span class="menu-icon fa fa-plus"></span></a></li>
            <li class="sidebar-list"><a href="#">Settings <span class="menu-icon fa fa-cogs"></span></a></li>
            @endif
            <li class="sidebar-list"><a href="#" target="_blank">About <span class="menu-icon fa fa-info"></span></a></li>
        </ul>
    </div>
    <!-- End Sidebar -->

    <div id="content-wrapper">

        <div class="page-content">

            <!-- Header Bar -->
            <div class="row header">
                <div class="col-xs-12">
                    <div class="meta pull-left">
                        <div class="page">
                            BanglaOCR
                        </div>
                    </div>
                    <div class="user pull-right">
                        <div class="item dropdown">
                            @if ($user)
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img class="avatar" src="{{ $user['picture']  }}">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li class="link">
                                    <a href="/google/logout">
                                        Logout
                                    </a>
                                </li>
                            </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Header Bar -->

            <div class="row">

                @if (Session::has('message'))

                    <div class="col-xs-12">
                        <div class="alert alert-success">{{ Session::get('message') }}</div>
                    </div>
                @endif

                <!-- Main Content -->
                @yield('content')
                <!-- End Main Content -->

            </div>

        </div><!-- End Page Content -->

    </div><!-- End Content Wrapper -->

</div><!-- End Page Wrapper -->

@yield('footer')

<script src="/js/vendor.js"></script>
<script src="/js/app.js"></script>

</body>
</html>