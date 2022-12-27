@extends('layouts.vote')

@section('content')
<style>
	.candidate {

margin: auto;
width: 16vw;
padding: 10px;
cursor: pointer;
border-radius: 3px;
margin-bottom: 1em;

}

@media(max-width:600px) {

.candidate {
width: 100%;
}
}
	.candidate img {
		height: 100%;
	    width: 100%;
	    margin: auto;
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
                        <a class="btn btn-info btn-sm  col-md-2 float-left" href="{{ route('userVote') }}">Vote
                        </a>
                    </div>
                </div>
				<div class="col-lg-12">
						
					<div class="text-center">

						<br>
						@if ($categories->count() == 0)
							<h1>Les Votes Ont Ete Arreter</h1>
						@else
						<h6><b>Liste Des Candidat Aux Elections</b></h6>
						@endif	
						
						
					</div>
					@foreach ($categories as $categorie)
					<br><center><h3><b>{{ $categorie->cat }}</b></h3></center>
						<div class="row mt-3">
                            @foreach ($categorie->voters as $voter)
                          
                            
							<div class="candidate" style="position: relative;">
								<a href="{{ route('show.about.candidate', $voter->name) }}" class="item">
								<div style="display: flex">
									<img src="{{ asset('storage/' . $voter->image_profile) }}" alt="">
								</div>
								<br>
								<div class="text-center">
									<large class="text-center"><b><?php echo ucwords($voter->name); ?></b></large>

								</div>
                               </a>
							</div>
                           
						@endforeach
						</div>
						@endforeach
				</div>
				<hr>
			</div>
		</div>
	</div>
</div>
@endsection