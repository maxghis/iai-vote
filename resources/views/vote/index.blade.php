@extends('layouts.vote')

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
	    z-index: 10;
	    display: none;
	}
	span.rem_btn.active{
		display: block;
	}
	
	
</style>
<div class="container-fluid">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <a class="btn btn-primary btn-sm  col-md-2 float-right" href="{{ route('vote.result') }}">resultat du vote</a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <a class="btn btn-info btn-sm  col-md-2 float-left" href="{{ route('vote.about.candidate') }}">A propos Des Candidats
                        </a>
                    </div>
                </div>

				<form action="" id="manage-vote">
					
				<div class="col-lg-12">
					<div class="text-center">
						<h3><b>Vote</b></h3>
						
					</div>
					
				@foreach ($categories as $categorie)

				
                    
						<hr>
						<div class="row mb-4">
							<div class="col-md-12">
									<div class="text-center">
										<h3><b>{{  $categorie['categorie']->cat }}</b></h3>
									</div>
							</div>
						</div>
						<div class="row mt-3">
                            @if ($categorie['use'] == null)
							@foreach ($categorie['categorie']->voters as $voter)

						
							<div class="candidate" style="position: relative;" data-cid = '<?php echo $categorie['categorie']->id ?>'  data-max="1" data-name="<?php echo $categorie['categorie']->cat ?>">
									<input type="checkbox" name="opt_id[<?php echo $categorie['categorie']->id ?>][]" value="<?php echo $voter->id ?>" style="display: none">
								<span class="rem_btn">
									<label for="" class="btn btn-primary"><span class="fa fa-check"></span></label>
								</span>
								<div class="item"  data-id="<?php echo $voter->id ?>">
								<div style="display: flex">
									<img src="{{ asset('storage/' . $voter->image_profile) }}" alt="">
								</div>
								<br>
								<div class="text-center">
									<large class="text-center"><b><?php echo ucwords($voter->name) ?></b></large>

								</div>
								</div>
							</div>
                            @endforeach
							@else
							<div class="text-center">

								<br>	
								<center><h6><b>Dans Cette Categorie Vous avez vote :</b></h6></center>
								<div class="row mt-3">
									@foreach ($categorie['categorie']->voters as $voter)
									@if ($categorie['use']->voter_id == $voter->id)
									
									<div class="candidate" style="position: relative;">
										<div class="item">
										<div style="display: flex">
											<img src="{{ asset('storage/' . $voter->image_profile) }}" alt="">
										</div>
										<br>
										<div class="text-center">
											<large class="text-center"><b><?php echo ucwords($voter->name); ?></b></large>
		
										</div>
										</div>
									</div>
									@endif
								@endforeach
								</div>
							</div>
							@endif
						</div>
                        @endforeach
				</div>
				<hr>
                @csrf
				<button class="btn-block btn-primary">Sumbit</button>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
	$('.candidate').click(function(){
		var chk = $(this).find('input[type="checkbox"]').prop("checked");
		
		if(chk == true){
			$(this).find('input[type="checkbox"]').prop("checked",false)
		}else{
			var arr_chk = $("input[name='opt_id["+$(this).attr('data-cid')+"][]']:checked").length
			if($(this).attr('data-max') == 1){
			$("input[name='opt_id["+$(this).attr('data-cid')+"][]']").prop("checked",false)
			$(this).find('input[type="checkbox"]').prop("checked",true)
			}else{
			if(arr_chk >= $(this).attr('data-max')){
					alert_toast("Choose only "+$(this).attr('data-max')+" for "+$(this).attr('data-name')+" category","warning")
					return false;
				}
			}
			$(this).find('input[type="checkbox"]').prop("checked",true)
		}
		$('.candidate').each(function(){
			if($(this).find('input[type="checkbox"]').prop("checked") == true){
				$(this).find('.rem_btn').addClass('active')
			}else{
				$(this).find('.rem_btn').removeClass('active')
			}
		})
		
	})
	$('#manage-vote').submit(function(e){
		e.preventDefault()
		start_load();
		$.ajax({
			url:'<?= route('userVote.submit') ?>',
			method:'POST',
			data:$(this).serialize(),
			success:function(resp){
				if(resp == 1){
					alert_toast("Vote success fully submitted");
					setTimeout(function(){
						location.reload()
					},1500)
				}
			},
            error:function(xhr, ajaxOptions, thrownError){
                end_load();
                
            }
		})
	})
</script>
@endsection