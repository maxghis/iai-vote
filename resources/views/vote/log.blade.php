@extends('layouts.admin')

@section('autre-style')
<!-- Datatables --> 
<link href="{{ asset('assets/app/gentelella/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{ asset('assets/app/gentelella/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{ asset('assets/app/gentelella/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{ asset('assets/app/gentelella/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{ asset('assets/app/gentelella/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">   
@endsection
@section('content')





<div class="container-fluid">
	<br><br><br>
	<div class="row">
		<div class="col-lg-12">
				<button class="btn btn-primary float-right btn-sm" id="new_user"><i class="fa fa-plus"></i> New user</button>
		</div>
		</div>
<div class="x_panel">
	<div class="x_title">
	  <h2>{{ $tip }}</small></h2>
	  <div class="clearfix"></div>
	</div>
	<div class="x_content">
	  <div class="row">
		  <div class="col-sm-12">
			<div class="card-box table-responsive">
	<table id="datatable-buttonss" class="table table-striped table-bordered" style="width:100%">
		<thead>
		  <tr>
			  <th>#</th>

			  <th>Identifiant</th>

			  <th>Classe</th>

			  <th>Candidat</th>

			

		  </tr>
		</thead>


		<tbody>
		  @foreach($users as $user)
		  
		  <tr>

			  <td data-toggle="modal" data-target=".bs-{{ $user->id }}-modal-lg">{{$user->id}}

			  <td data-toggle="modal" data-target=".bs-{{ $user->id }}-modal-lg">{{$user->user->username}}</td>

			  <td data-toggle="modal" data-target=".bs-{{ $user->id }}-modal-lg">{{$user->user->classe}}</td>

			  <td data-toggle="modal" data-target=".bs-{{ $user->id }}-modal-lg">{{$user->candidate->name}}</td>


		  </tr>
	
		  @endforeach
		</tbody>
	  </table>
	  
		</div>
	   </div>
	   <br>
	   <style>
		.pa{
		  align-content: center;
		}
	   </style>
	   <div class="col-sm-12 col-xs-3 pa">
	   {{ $users->links() }}
	   </div>
	  </div>
	</div>
  </div>

</div>




@endsection

@section('autre-style-fin')
<!-- Datatables -->
<script src="{{ asset('assets/app/gentelella/vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets/app/gentelella/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{ asset('assets/app/gentelella/vendors/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('assets/app/gentelella/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')}}"></script>
<script src="{{ asset('assets/app/gentelella/vendors/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
<script src="{{ asset('assets/app/gentelella/vendors/datatables.net-buttons/js/buttons.html5.js')}}"></script>
<script src="{{ asset('assets/app/gentelella/vendors/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{ asset('assets/app/gentelella/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}"></script>
<script src="{{ asset('assets/app/gentelella/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
<script src="{{ asset('assets/app/gentelella/vendors/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('assets/app/gentelella/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js')}}"></script>
<script src="{{ asset('assets/app/gentelella/vendors/datatables.net-scroller/js/dataTables.scroller.min.js')}}"></script>



<script>
	$(document).ready( function () {
		$("#datatable-buttonss").DataTable({
   
			"lengthMenu": [[50, 250, 1000, 2000,-1], [50, 250, 1000, 2000, "All"]],
   
			dom: "Blfrtip",
			buttons: [
				{
					extend: "copy",
					className: "btn-sm"
				},
				{
					extend: "csv",
					className: "btn-sm",
					title: "<?= $tip ?>",
				},
				{
					extend: "excel",
					className: "btn-sm",
					title: "<?= $tip ?>",
				},
				{
					extend: "pdfHtml5",
					className: "btn-sm",
					title: "<?= $tip ?>",
				},
				{
					extend: "print",
					title: "<?= $tip ?>",
					className: "btn-sm"
				},
			],
			responsive: true
		});
	  });
   
   
   </script>
@endsection