@extends('layouts.admin')

  @section('content')

<div class="containe-fluid">
<br><br><br>
	

	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-body">
                    
					@foreach ($categories as $categorie)
                    
				
						<b><hr></b>
					<div class="row mb-4">
						<div class="col-md-12">
								<div class="text-center">
									<h3><b>{{ $categorie['categorie']->cat }}</b></h3>
								</div>
						</div>
					</div>

					<div class="row mt-8 ml-5">
					
							
								<div class="card-body pull-left">
									<h4><b>Electeurs</b> {{ $voters }}</h4>
								</div>
							
								<div class="card-body pull-right">
									<h4><b>Votes</b> {{ $categorie['categorie']->votes->count() }}</h4>
								</div>
							
					</div>

					<div class="col-md-12 col-sm-12 col-md-12 col-xs-12">
					@foreach ($categorie['electTries'] as $electTrie)
					<div class="col-md-12 col-sm-12 ">
						<div>
						
						  <ul class="list-unstyled top_profiles scroll-view">
							<li class="media event">
							  <a class="pull-left border-aero profile_thumb" style="padding: 0;">
								<img width="100%" src="{{ asset('storage/' . $electTrie['voter']->image_profile) }}" alt="">
							  </a>
							  <div class="media-body">
								<h5 class="title" href="#">{{ $electTrie['voter']->name }}</h5>
								<h6 class="pull-right"><strong>{{ $electTrie['voter']->votes()->count()   }} </strong> vote(s) </h6>
								
								</p>
							  </div>
							</li>
						  </ul>
						</div>
					</div>
				
				
					
					@endforeach
					</div>
					<hr>
					@endforeach
                        
                    
                        
                       			
				</div>
			</div>

		
			
		 
		</div>
	</div>

</div>
<script>
	
</script>
  @endsection
