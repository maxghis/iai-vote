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
				<button class="btn btn-primary float-left btn-sm" id="new_matricule"><i class="fa fa-plus"></i> New matricule</button>
                <button class="btn btn-info float-right btn-sm " id="new_mass_matricule"><i class="fa fa-plus"></i>ajout mass  matricule</button>
		</div>
	</div>

<div class="x_panel">
	<div class="x_title">
	  <h2>Matricules Utilisateurs</small></h2>
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

			  <th>Matricules</th>

			  <th>Classe</th>

			  <th>Action</th>

		  </tr>
		</thead>


		<tbody>
		  @foreach($matricules as $matricule)
		  
		  <tr>

			  <td data-toggle="modal" data-target=".bs-{{ $matricule->id }}-modal-lg">{{$matricule->id}}

			  <td data-toggle="modal" data-target=".bs-{{ $matricule->id }}-modal-lg">{{$matricule->matricule}}</td>

			  <td data-toggle="modal" data-target=".bs-{{ $matricule->id }}-modal-lg">{{$matricule->classe}}</td>

			  <td data-toggle="modal" data-target=".bs-{{ $matricule->id }}-modal-lg">
				<center>
					<div class="btn-group">
					  <button type="button" class="btn btn-primary">Action</button>
					  <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<span class="sr-only">Toggle Dropdown</span>
					  </button>
					  <div class="dropdown-menu">
						<a class="dropdown-item edit_matricule" href="javascript:void(0)" data-id = '<?php echo $matricule->id ?>'>Edit</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item delete_matricule" href="javascript:void(0)" data-id = '<?php echo $matricule->id ?>'>Delete</a>
					  </div>
					</div>
				</center>
			  </td>


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
	   {{ $matricules->links() }}
	   </div>
	  </div>
	</div>
  </div>

</div>
<script>
	
$('#new_matricule').click(function(){
	uni_modal('New Matricule','<?= route("man_matricule") ?>')
})
$('#new_mass_matricule').click(function(){
	uni_modal('New Mass Matricule','<?= route("man_matricule") ?>?type=mass')
})

$('.edit_matricule').click(function(){
	uni_modal('Edit Matricule','<?= route("man_matricule") ?>?id='+$(this).attr('data-id'))
})
$('.delete_matricule').click(function(){
	uni_modal('Delete Matricule','<?= route("man_matricule") ?>?type=del&id='+$(this).attr('data-id'))
})

</script>



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
					title: "Liste Des Matricules",
				},
				{
					extend: "excel",
					className: "btn-sm",
					title: "Liste Des Matricules",
				},
				{
					extend: "pdfHtml5",
					className: "btn-sm",
					title: "Liste Des Matricules",
				},
				{
					extend: "print",
					title: "Liste Des Matricules",
					className: "btn-sm"
				},
			],
			responsive: true
		});
	  });
   
   
   </script>
@endsection