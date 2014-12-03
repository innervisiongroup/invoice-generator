<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>@yield('meta-title', 'Admin Panel - ' . Setting::first()->app_name)</title>
        <link rel="icon" type="image/png" href="{{ Setting::first()->favicon }}">

        <!-- Bootstrap -->
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="/admin/css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
        <link href="/admin/css/plugins/timeline.css" rel="stylesheet">
        <link href="/admin/css/sb-admin-2.css" rel="stylesheet">
        <link href="/admin/css/plugins/morris.css" rel="stylesheet">
        <link href="/css/screen.css" rel="stylesheet">
        @yield('styles')

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    
    <body>
        <div id="wrapper">
            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ URL::to('admin/index') }}">{{ Setting::first()->app_name }} Admin</a>
                </div>
                
                <ul class="nav navbar-nav">
                    <li>
                        <a href="{{ URL::to('/') }}">
                            View Site
                        </a>
                    </li>
                </ul>

                <ul class="nav navbar-top-links navbar-right">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i>
                            <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li>
                                <a href="{{ URL::to('admin/profile') }}"><i class="fa fa-user fa-fw"></i> Admin Profile</a>
                            </li>
                            <li>
                                <a href="{{ URL::to('admin/settings') }}"><i class="fa fa-gear fa-fw"></i> Settings</a>
                            </li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <!-- /.dropdown -->
                </ul>
                <!-- /.navbar-top-links -->

                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <li>
                                <a class="{{ Request::is('admin/index') ? 'active' : '' }}" href="{{ URL::to('admin/index') }}">
                                    <i class="fa fa-dashboard fa-fw"></i> Invoice Templates
                                </a>
                            </li>
                            <li>
                                <a class="{{ Request::is('admin/settings') ? 'active' : '' }}" href="{{ URL::to('admin/settings') }}">
                                    <i class="fa fa-cogs fa-fw"></i> Settings
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.sidebar-collapse -->
                </div>
                <!-- /.navbar-static-side -->
            </nav>
            <div id="page-wrapper">
                @yield('content')
            </div>
        </div>        

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script src="/admin/js/plugins/metisMenu/metisMenu.min.js"></script>
        <script src="/admin/js/sb-admin-2.js"></script>
        <script src="/js/script.js"></script>
        <script src="http://code.angularjs.org/1.0.2/angular.min.js"></script>
        @yield('scripts')
    </body>
</html>