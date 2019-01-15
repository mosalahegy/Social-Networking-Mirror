<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>
            @yield('title')
        </title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="{{asset('website/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{asset('website/bower_components/font-awesome/css/font-awesome.min.css')}}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="{{asset('website/bower_components/Ionicons/css/ionicons.min.css')}}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{asset('website/dist/css/AdminLTE.min.css')}}">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="{{asset('website/dist/css/skins/_all-skins.min.css')}}">
        <!-- Morris chart -->
        <link rel="stylesheet" href="{{asset('website/bower_components/morris.js/morris.css')}}">
        <!-- jvectormap -->
        <link rel="stylesheet" href="{{asset('website/bower_components/jvectormap/jquery-jvectormap.css')}}">
        <!-- Date Picker -->
        <link rel="stylesheet" href="{{asset('website/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="{{asset('website/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
        <!-- bootstrap wysihtml5 - text editor -->
        <link rel="stylesheet" href="{{asset('website/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
      
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
      
        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        
        @yield('header')
    </head>
    <body class="sidebar-mini skin-blue-light">
            <div class="wrapper" style="hight:600px">
                @include('layout.partials.header')
                @include('messages.message')
                    @yield('content')
                @include('layout.partials.messenger')
                @include('layout.partials.footer')    
                <div class="control-sidebar-bg"></div>
            </div>
            
        <!-- jQuery 3 -->
        
        <script src="{{asset('website/bower_components/jquery/dist/jquery.min.js')}}"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="{{asset('website/bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button);
        </script>
        <!-- Bootstrap 3.3.7 -->
        <script src="{{asset('website/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
        <!-- Morris.js charts -->
        <script src="{{asset('website/bower_components/raphael/raphael.min.js')}}"></script>
        <script src="{{asset('website/bower_components/morris.js/morris.min.js')}}"></script>
        <!-- Sparkline -->
        <script src="{{asset('website/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
        <!-- jvectormap -->
        <script src="{{asset('website/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
        <script src="{{asset('website/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
        <!-- jQuery Knob Chart -->
        <script src="{{asset('website/bower_components/jquery-knob/dist/jquery.knob.min.js')}}"></script>
        <!-- daterangepicker -->
        <script src="{{asset('website/bower_components/moment/min/moment.min.js')}}"></script>
        <script src="{{asset('website/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
        <!-- datepicker -->
        <script src="{{asset('website/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="{{asset('website/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
        <!-- Slimscroll -->
        <script src="{{asset('website/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
        <!-- FastClick -->
        <script src="{{asset('website/bower_components/fastclick/lib/fastclick.js')}}"></script>
        <script src="{{asset('website/bower_components/Chart.js/Chart.js')}}"></script>

        <!-- AdminLTE App -->
        <script src="{{asset('website/dist/js/adminlte.min.js')}}"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="{{asset('website/dist/js/pages/dashboard1.js')}}"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="{{asset('website/dist/js/demo.js')}}"></script>
        
        <script>
            function clickBtn()
            {
               $('.profile').mouseenter(function(){
                   $('.temp').css('display','inline-block').css('background-color','rgba(0,0,0,0.1)');;
                   }).mouseleave(function(){
                   $('.temp').css('display','none')             
               });
       
               $('.btnfile').click(function(){
                   document.getElementById('inputfile').click();
                   $('.sub').submit();
               });	
       
               $('.btnfile1').click(function(){
                   document.getElementById('inputfile1').click();
               });
               
               $('.profile-img').mouseenter(function(){
                   $('.profile-form').css('display','block');
               }).mouseleave(function(){
                   $('.profile-form').css('display','none');         
               });
       
               $('.btnfile2').mouseenter(function(){
                   $('.profile-form').css('display','block');
               }).mouseleave(function(){
                   $('.profile-form').css('display','none');            
               });
               $('.inputfile').mouseenter(function(){
                   $('.profile-form').css('display','block');
               }).mouseleave(function(){
                   $('.profile-form').css('display','none');            
               });;  
       
            }
            clickBtn();
       </script>

        @yield('footer')
    </body>
</html>
