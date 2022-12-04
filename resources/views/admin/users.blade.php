@extends('layouts.admin')

@section('content')
<div class="container-fluid">
	<br><br><br>
	<div class="row">
	<div class="col-lg-12">
			<button class="btn btn-primary float-right btn-sm" id="new_user"><i class="fa fa-plus"></i> New user</button>
	</div>
	</div>
	<br>
	<div class="row">
		<div class="card col-lg-9 col-sm-9 col-md-9 col-xs-9 catd">
            <center><h3>{{ $tip }} ({{ $nbre }})</h3></center>
			<div class="card-body">

                <div class="card-box table-responsive">
				<table class="table-striped table-bordered col-md-12">
			<thead>
				<tr>
					<th class="text-center">#</th>
					<th class="text-center">Name</th>
					<th class="text-center">Username</th>
                    <th class="text-center">Email</th>
					<th class="text-center">Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($users as $user)
				 <tr>
				 	<td>
				 		{{ $user->id }}
				 	</td>
				 	<td>
				 		{{ $user->name }}
				 	</td>
				 	<td>
				 		{{ $user->username }}
				 	</td>

                     <td>
                        {{ $user->email }}
                    </td>
				 	<td>
				 		<center>
								<div class="btn-group">
								  <button type="button" class="btn btn-primary">Action</button>
								  <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								    <span class="sr-only">Toggle Dropdown</span>
								  </button>
								  <div class="dropdown-menu">
								    <a class="dropdown-item edit_user" href="javascript:void(0)" data-id = '<?php echo $user->id ?>'>Edit</a>
								    <div class="dropdown-divider"></div>
								    <a class="dropdown-item delete_user" href="javascript:void(0)" data-id = '<?php echo $user->id ?>'>Delete</a>
								  </div>
								</div>
								</center>
				 	</td>
				 </tr>
                 @endforeach
			</tbody>
		</table>

       
                </div>
                <div class="text-center">
                    <center>{{ $users->links() }}</center>
                </div>
			</div>
		</div>
	</div>

</div>
<script>
	
$('#new_user').click(function(){
	uni_modal('New User','<?= route("man_user") ?>')
})
$('.edit_user').click(function(){
	uni_modal('Edit User','<?= route("man_user") ?>?id='+$(this).attr('data-id'))
})
$('.delete_user').click(function(){
	uni_modal('Delete User','<?= route("man_user") ?>?type=del&id='+$(this).attr('data-id'))
})

</script>
@endsection