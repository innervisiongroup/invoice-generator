<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>@yield('meta-title', Setting::first()->app_name)</title>
        <link rel="icon" type="image/png" href="{{ Setting::first()->favicon }}">

        <!-- Bootstrap -->
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="/css/screen.css" rel="stylesheet">
        @yield('styles')

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    
    <body>
        <div class="container">
            @yield('content')
        </div>
        

        <footer>
            <nav class="navbar navbar-default navbar-fixed-bottom" role="navigation">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="text-center">Created by <a href="http://innervisionweb.com" target="_blank">Inner Vision Web</a></div>
                            <div class="text-center">Build with <a href="http://laravel.com" target="_blank">Laravel Framework</a></div>
                        </div>
                        <div class="col-md-3 text-right">
                            <a href="{{ URL::to('admin/index') }}">Admin Panel</a>
                        </div>
                    </div>
                </div>
            </nav>
        </footer>    

        <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.25/angular.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
        <script src="/js/script.js"></script>
        @yield('scripts')
    </body>
</html>