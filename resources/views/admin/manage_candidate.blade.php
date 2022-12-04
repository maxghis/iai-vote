@extends('layouts.admin')

  @section('content')
<style>
	.candidate {
	    margin: auto;
	    width: 16vw;
	    padding: 10px;
	    cursor: pointer;
	    border-radius: 3px;
	    margin-bottom: 1em
	}
	.candidate:hover {
	    background-color: #80808030;
	    box-shadow: 2.5px 3px #00000063;
	}
	.candidate img {
	    height: 14vh;
	    width: 8vw;
	    margin: auto;
	}
	span.rem_btn {
	    position: absolute;
	    right: 0;
	    top: -1em;
	    z-index: 10
	}
</style>
<div class="container-fluid">
    <br><br><br>
	<div class="col-lg-9 col-sm-9 col-md-9 col-xs-9 catd">
		<div class="card">
			<div class="card-body">
				<div class="col-lg-12">
					<div class="text-center">
						<h3><b>Candidats Aux Elections</b></h3>
						
					</div>
					<hr>
					<div class="row">
						<div class="col-md-12">
							<button class="btn btn-sm btn-primary float-right" type="button" id="new_opt">New Candidate</button>
						</div>
					</div>
                    @foreach ($categories as $categorie)
						<hr>
						<div class="row mb-4">
							<div class="col-md-12">
									<div class="text-center">
										<h3><b>{{ $categorie->cat }}</b></h3>
									</div>
							</div>
						</div>
						<div class="row mt-3">
                            @foreach ($categorie->voters as $voters)
							<div class="candidate" style="position: relative;">
								<span class="rem_btn"><button class="btn btn-rounded btn-sm btn-outline-danger del_candidated" data-id="<?php echo $voters->id ?>"><i class="fa fa-trash"></i></button></span>
								<div class="item"  data-id="<?php echo $voters->id ?>">
								<div style="display: flex">
									<img src="{{ asset('storage/' . $voters->image_profile) }}" alt="">
								</div>
								<br>
								<div class="text-center">
									<large class="text-center"><b><?php echo ucwords($voters->name) ?></b></large>

								</div>
								</div>
							</div>
                            @endforeach	
						</div>
                        
                        @endforeach	
				</div>
				
			</div>
		</div>
	</div>
</div>
<script>
	$('#new_opt').click(function(){
		uni_modal("New Candidate",'<?= route("man_candidate") ?>')
	})
	$('.candidate>.item').click(function(){
		uni_modal("Edit Candidate",'<?= route("man_candidate") ?>?vid=>&id='+$(this).attr('data-id'))
	})
	$('.del_candidated').click(function(e){
		e.preventDefault()
		_conf("Are you sure to delete this candidate?","delete_candidate",[$(this).attr('data-id')])
	})
	function delete_candidate($id){
	
		$.ajax({
			url:'<?= route("candidate_manager", "delete") ?>',
			method:'POST',
			data:{id:$id, _token:'<?= csrf_token() ?>'},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			},
            error:function(xhr, ajaxOptions, thrownError){
                alert_toast(xhr.responseText,'success', 10000)

                end_load();
                
                
            }
		})
	}
</script>
@endsection