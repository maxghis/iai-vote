<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin Panel | </title>

  <!-- Bootstrap -->
 
  <link href="{{ asset('assets/app/gentelella/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="{{ asset('assets/app/gentelella/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
  <!-- NProgress -->
  <link href="{{ asset('assets/app/gentelella/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
  <!-- iCheck -->
  <link href="{{ asset('assets/app/gentelella/vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">
   
  
  
<!-- jQuery -->
<script src="{{ asset('assets/app/gentelella/vendors/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{ asset('assets/app/gentelella/vendors/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
<!-- FastClick -->
<script src="{{ asset('assets/app/gentelella/vendors/fastclick/lib/fastclick.js')}}"></script>
<!-- NProgress -->
<script src="{{ asset('assets/app/gentelella/vendors/nprogress/nprogress.js')}}"></script>
<!-- iCheck -->
<script src="{{ asset('assets/app/gentelella/vendors/iCheck/icheck.min.js')}}"></script>

  @yield('autre-style')

  <!-- Custom Theme Style -->
    <link href="{{ asset('assets/app/gentelella/build/css/custom.min.css')}}" rel="stylesheet">

   
    {{-- <!-- jQuery custom content scroller -->
    <script src="{{ asset('assets/app/gentelella/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js')}}"></script> --}}


  </head>

  <body class="nav-md">

    
  <div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="col-md-1 float-left" style="display: flex;">
        <a href="#" class="logo closoast text-white ">
            <h4><i class="fa fa-close"></i>&nbsp;&nbsp;</h4>
        </a>
    </div>
    <h5>
    <div class="toast-body text-white">
        

        
    </div>
</h5>
  </div>
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="{{url('/')}}" class="site_title"> <span>{{config('app.name', 'APP')}}</span></a>
            </div>
 
            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
            
              <div class="profile_info">
                <span>Bienvenu,</span>
                <h2>{{ Str::words( auth()->user()->name, 1, ' ') }}</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
               
                <ul class="nav side-menu">
                  <li><a href="{{route('adminDashboard')}}"><i class="fa fa-dashboard"></i> Tableau De Bord</a>
                  </li>
                  @if (auth()->user()->type == 3)
                  <li><a href="{{route('categoy_list')}}"><i class="fa fa-bar-chart-o"></i> Elections </a>
                  @endif
                  </li>
                  <li><a><i class="fa fa-male"></i> Candidat <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{route('man_can')}}">{{__("Gerer Candidats")}}</a></li>
                
                      <li><a href="{{route('vote.about.candidate')}}">{{__("Afficher Candidats")}}</a></li>
                    
                    </ul>
                  </li>

             <li><a><i class="fa fa-users"></i> Utilisateurs <span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu">
                <li><a href="{{route('user.elct')}}">{{__("Electeurs")}}</a></li>
                @if (auth()->user()->type == 3)
                <li><a href="{{route('user.admin')}}">{{__("Admins")}}</a></li>
                <li><a href="{{route('user.super.admin')}}">{{__("Supers Admins")}}</a></li>
                @endif
              
              </ul>
            </li>
           
            @if (auth()->user()->type == 3)
            <li><a href="{{route('matricule.index')}}"><i class="fa fa-barcode"></i> Gerer Matricule</a>
              
            </li>
            @endif
           

                </ul>
              </div>
      

            </div>
            <!-- /sidebar menu -->

     
          </div>
        </div>

      <!-- top navigation -->
      <div class="top_nav">
        <div class="nav_menu">
            <div class="nav toggle">
              <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>
            <nav class="nav navbar-nav">
            <ul class=" navbar-right">
              <li class="nav-item dropdown open" style="padding-left: 15px;">
                <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                 {{ Str::words( auth()->user()->name, 1, ' ') }}
                </a>
                <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                 
                  <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{ route('logout') }}"
              
                  onclick="event.preventDefault(); document.getElementById('logout-form').submit();"class="dropdown-item"  href="login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    <!-- /top navigation -->

    <style>
      .toast{
  display: none;
  min-width: 20vw;

}
.toast.show {
    display: block;
    opacity: 1;
    position: fixed;
    z-index: 99999999;
    margin: 20px;
    right: 0;
    top: 3.5rem;
}
      /*--------------------------------------------------------------
# Preloader
--------------------------------------------------------------*/
#preloader {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  z-index: 9999;
  overflow: hidden;
  background: #fff;
}

#preloader:before {
  content: "";
  position: fixed;
  top: calc(50% - 30px);
  left: calc(50% - 30px);
  border: 6px solid #1977cc;
  border-top-color: #d1e6f9;
  border-radius: 50%;
  width: 60px;
  height: 60px;
  -webkit-animation: animate-preloader 1s linear infinite;
  animation: animate-preloader 1s linear infinite;
}
#preloader2 {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  z-index: 9999;
  overflow: hidden;
  background: #ffffff82;
}

#preloader2:before {
  content: "";
  position: fixed;
  top: calc(50% - 30px);
  left: calc(50% - 30px);
  border: 6px solid #1977cc;
  border-top-color: #d1e6f9;
  border-radius: 50%;
  width: 60px;
  height: 60px;
  -webkit-animation: animate-preloader 1s linear infinite;
  animation: animate-preloader 1s linear infinite;
}
@-webkit-keyframes animate-preloader {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}

@keyframes animate-preloader {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
    </style>
        <!-- page content -->
        
        <div class="right_col" role="main"  style="background-color: #dcdcdc">
    @yield('content')

@include('admin.alert')

</div>
    
<!-- /page content -->

<!-- footer content -->
<footer>
  <div class="clearfix"></div>
</footer>
<!-- /footer content -->
</div>
</div>




@yield('autre-style-fin')
<!-- Custom Theme Scripts -->
<script src="{{ asset('assets/app/gentelella/build/js/custom.min.js')}}"></script>
</body>
</html>