<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ config('app.name') }}</title>

    <!-- Admin Hosteria CSS -->
    <link href="{{url('/')}}/css/admin/admin.css" rel="stylesheet">

    <!-- Bootstrap Core CSS -->
    <link href="{{url('/')}}/css/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{url('/')}}/js/thirds/metisMenu/metisMenu.min.css" rel="stylesheet">
    {{-- <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet"> --}}

    <!-- Custom CSS -->
    <link href="{{url('/')}}/css/thirds/sb-admin-2.css" rel="stylesheet">
    {{-- <link href="../dist/css/sb-admin-2.css" rel="stylesheet"> --}}

    <!-- Morris Charts CSS -->
    {{-- <link href="{{url('/')}}/js/thirds/morrisjs/morris.css" rel="stylesheet"> --}}

    <!-- Custom Fonts -->
    <link href="{{url('/')}}/css/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    {{-- <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"> --}}

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">

    @yield('css')
</head>

<body>
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="container-fluid">
                @if (Auth::check())
                    @include('menues.navbar.header')

                    @include('menues.navbar.right')


                @endif
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row">
                @if (Auth::check())
                    @include('menues.navbar.sidebar')
                @endif
                @yield('content')
            </div>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    @if (Auth::check())
        @include('blocks.footer')
    @endif
</body>
<!-- Scripts -->
{{-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script> --}}

<script>
  @if(Session::has('message'))
    var type = "{{ Session::get('type', 'info') }}";
    switch(type){
        case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;
        case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;
        case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;
        case 'error':
            toastr.error("{{ Session::get('message') }}");
            break;
    }
  @endif
</script>

@yield('scripts')
</html>
