<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Systeme de vote</title>
 	

<meta content="" name="descriptison">
  <meta content="" name="keywords">

  

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/font-awesome/css/all.min.css')}}">


  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/icofont/icofont.min.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/venobox/venobox.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/animate.css/animate.min.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/owl.carousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/DataTables/datatables.min.css')}}" rel="stylesheet">


  <!-- Template Main CSS File -->
  <link href="{{ asset('assets/css/style.css')}}" rel="stylesheet">
  <link type="text/css')}}" rel="stylesheet" href="{{ asset('assets/css/jquery-te-1.4.0.css')}}">
  
  <script src="{{ asset('assets/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{ asset('assets/DataTables/datatables.min.js')}}"></script>
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{ asset('assets/vendor/jquery.easing/jquery.easing.min.js')}}"></script>
  <script src="{{ asset('assets/vendor/php-email-form/validate.js')}}"></script>
  <script src="{{ asset('assets/vendor/venobox/venobox.min.js')}}"></script>
  <script src="{{ asset('assets/vendor/waypoints/jquery.waypoints.min.js')}}"></script>
  <script src="{{ asset('assets/vendor/counterup/counterup.min.js')}}"></script>
  <script src="{{ asset('assets/vendor/owl.carousel/owl.carousel.min.js')}}"></script>
  <script src="{{ asset('assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/font-awesome/js/all.min.js')}}"></script>
  <script type="text/javascript" src="{{ asset('assets/js/jquery-te-1.4.0.min.js')}}" charset="utf-8"></script>


</head>
<style>
	body{
        background: #80808045;
  }
</style>

<body>
	<style>
        .logo {
        margin: auto;
        font-size: 20px;
        background: white;
        padding: 5px 11px;
        border-radius: 50% 50%;
        color: #000000b3;
    }

    



@media(max-width:768px) {
   
    .tab{
        display: none;
    } 
}

    .catd{
        float: right;
       margin: 0  auto;
       margin-right: 45px;
    }
    </style>
    
    <nav class="navbar navbar-dark bg-dark fixed-top " style="padding:0;">
      <div class="container-fluid mt-2 mb-2">
          <div class="col-lg-12">

              <div class="col-md-1 float-right" style="display: flex;">
                <a href="#" class="logo mainuu">
                    <i class="fa fa-bars"></i>
                </a>
            </div>

              
              
        </div>
      </div>
      
    </nav>
	
<style>
	
</style>

<nav id="sidebar" class='mx-lt-5 bg-dark tab' >
		<br><br><br><br>
     
		<div class="sidebar-list">
                
				<a href="{{ route('adminDashboard') }}" class="nav-item nav-home"><span class='icon-field'><i class="fa fa-home"></i></span> Tableau De Bord</a>
				<a href="{{ route('categoy_list') }}" class="nav-item nav-categories"><span class='icon-field'><i class="fa fa-list"></i></span>&nbsp;categorie d'election</a>
                <a href="{{ route('user.elct') }}" class="nav-item nav-users"><span class='icon-field'><i class="fa fa-users"></i></span> Electeurs</a>
                <a href="{{ route('man_can') }}" class="nav-item nav-voting_list nav-manage_voting"><span class='icon-field'><i class="fa fa-poll-h"></i></span>Gerer Candidats</a>
                <a href="{{ route('vote.about.candidate') }}" class="nav-item nav-voting_list nav-manage_voting"><span class='icon-field'><i class="fa fa-list"></i></span>A propos Candidats</a>
                <a href="{{ route('user.admin') }}" class="nav-item nav-users"><span class='icon-field'><i class="fa fa-user"></i></span> Administrateurs</a>
          
                    <a class="nav-item nav-users" href="{{ route('logout') }}"
                                         onclick="event.preventDefault();
                                                       document.getElementById('logout-form').submit();">
                                         <i class="fa fa-power-off"></i> {{ auth()->user()->name }} 
                                      </a>
  
                                      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                          @csrf
                                      </form>


                                      <div class="col-md-1 float-left" style="display: flex;">
                                        <div class="logo">
                                            <i class="fa fa-poll-h"></i>
                                        </div>
                                    </div>                     

			
		</div>

</nav>
<script>
	$('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active')
</script>

  <div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="col-md-1 float-left" style="display: flex;">
        <a href="#" class="logo closoast">
            <i class="fa fa-power-off"></i>
        </a>
    </div>
    <h5>
    <div class="toast-body text-white">
        

        
    </div>
</h5>
  </div>
 
    @yield('content')


<div id="preloader"></div>
<a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

<div class="modal fade" id="confirm_modal" role='dialog'>
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title">Confirmation</h5>
    </div>
    <div class="modal-body">
      <div id="delete_content"></div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-primary" id='confirm' onclick="">Continue</button>
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
    </div>
  </div>
</div>
<div class="modal fade" id="uni_modal" role='dialog'>
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title"></h5>
    </div>
    <div class="modal-body">
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
    </div>
    </div>
  </div>
</div>
</body>
<script>
   window.start_load = function(){
  $('body').prepend('<di id="preloader2"></di>')
}
window.end_load = function(){
  $('#preloader2').fadeOut('fast', function() {
      $(this).remove();
    })
}

window.uni_modal = function($title = '' , $url=''){
  start_load()
  $.ajax({
      url:$url,
      error:err=>{
          console.log()
          alert("An error occured")
      },
      success:function(resp){
          if(resp){
              $('#uni_modal .modal-title').html($title)
              $('#uni_modal .modal-body').html(resp)
              $('#uni_modal').modal('show')
              end_load()
          }
      }
  })
}
window._conf = function($msg='',$func='',$params = []){
   $('#confirm_modal #confirm').attr('onclick',$func+"("+$params.join(',')+")")
   $('#confirm_modal .modal-body').html($msg)
   $('#confirm_modal').modal('show')
}
 window.alert_toast= function($msg = 'TEST',$bg = 'success'){
    $('#alert_toast').removeClass('bg-success')
    $('#alert_toast').removeClass('bg-danger')
    $('#alert_toast').removeClass('bg-info')
    $('#alert_toast').removeClass('bg-warning')

  if($bg == 'success')
    $('#alert_toast').addClass('bg-success')
  if($bg == 'danger')
    $('#alert_toast').addClass('bg-danger')
  if($bg == 'info')
    $('#alert_toast').addClass('bg-info')
  if($bg == 'warning')
    $('#alert_toast').addClass('bg-warning')
  $('#alert_toast .toast-body').html($msg)
  $('#alert_toast').toast({delay:1000000000}).toast('show');
}
$(document).ready(function(){
  $('#preloader').fadeOut('fast', function() {
      $(this).remove();
    })
})


$(document).ready(function(){
  $('.closoast').on('click', function() {
    $('#alert_toast').toast('hide');
    })
})
$(document).ready(function(){
  $('.mainuu').on('click', function() {
    $('.tab').toggle();
    })
})
</script>	
</html>