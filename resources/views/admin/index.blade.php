@extends('layouts.admin')

  @section('content')
  <style>
	.custom-menu {
        z-index: 1000;
	    position: absolute;
	    background-color: #ffffff;
	    border: 1px solid #0000001c;
	    border-radius: 5px;
	    padding: 8px;
	    min-width: 13vw;
}
a.custom-menu-list {
    width: 100%;
    display: flex;
    color: #4c4b4b;
    font-weight: 600;
    font-size: 1em;
    padding: 1px 11px;
}
	span.card-icon {
    position: absolute;
    font-size: 3em;
    bottom: .2em;
    color: #ffffff80;
}

.image {
    border-radius:2px 2px 2px 2px;
    -webkit-border-radius:2px 2px 2px 2px;
    float:left;margin-right:10px;
    
}
.file-item{
	cursor: pointer;
}
a.custom-menu-list:hover,.file-item:hover,.file-item.active {
    background: #80808024;
}
table th,td{
	/*border-left:1px solid gray;*/
}
a.custom-menu-list span.icon{
		width:1em;
		margin-right: 5px
}
.candidate {
    margin: auto;
    width: 100%;
    padding: 0 10px;
    border-radius: 20px;
    margin-bottom: 1em;
    display: flex;
    border: 3px solid #00000008;
    background: #8080801a;

}
.candidate_name {
    margin: 8px;
    margin-left: 3.4em;
    margin-right: 3em;
    width: 100%;
}
	.img-field {
	    display: flex;
	    width: 80px;
	    padding: .3em;
	    background: #80808047;
	    border-radius: 50%;
	    position: absolute;
	    left: -.7em;
	    top: -.7em;
	}

    .cont{
        float: none;
       margin: 0 auto;
    }
	
	.candidate img {
    height: 100%;
    width: 100%;
    margin: auto;
    border-radius: 50%;
}
.vote-field {
    position: absolute;
    right: 0;
    bottom: -.4em;
}
</style>

<div class="containe-fluid col-lg-9 col-sm-9 col-md-9 col-xs-9 catd">
<br><br><br><br>
	<div class="row mt-8 ml-5 mr-1">
		<div class="col-lg-12">
			<div class="card col-md-4 offset-2 bg-info ml-4 float-left">
				<div class="card-body text-white">
					<h4><b>Electeurs</b></h4>
					<hr>
					<span class="card-icon"><i class="fa fa-users"></i></span>
					<h3 class="text-right"><b>{{ $voters }}</b></h3>
				</div>
			</div>

            <div class="card col-md-4 offset-2 bg-primary ml-4 float-left">
				<div class="card-body text-white">
					<h4><b>Votes</b></h4>
					<hr>
					<span class="card-icon"><i class="fa fa-user-tie"></i></span>
					<h3 class="text-right"><b>{{ $user_votes }}</b></h3>
				</div>
			</div>
		</div>
	</div>

	<div class="row mt-3 ml-4 mr-2">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <a class="btn btn-primary btn-sm  col-md-2 float-right" href="{{ route('vote.about.candidate') }}">A propos Des Candidats</a>
                        </div>
                    </div>
    
                    <div class="row">
                        <div class="col-md-12">
                            <a class="btn btn-info btn-sm  col-md-2 float-left" href="{{ route('userVote') }}">Vote
                            </a>
                        </div>
                    </div>
                    
					<div class="text-center">
						<h3><b>Vote</b></h3>
						
					</div>
					
                    
					@foreach ($categories as $categorie)
                    
					<div>
						<hr>
					<div class="row mb-4">
						<div class="col-md-12">
								<div class="text-center">
									<h3><b>{{ $categorie['categorie']->cat }}</b></h3>
								</div>
						</div>
					</div>

					<div class="col-lg-7 col-sm-7 col-md-7 col-xs-7 cont">
					@foreach ($categorie['electTries'] as $electTrie)
					<div class="row mt-3">
				
						<div class="candidate" style="position: relative;">
							<div class="img-field">
								<img src="{{ asset('storage/' . $electTrie['voter']->image_profile) }}" alt="">
							</div>
							<div class="candidate_name">{{ $electTrie['voter']->name }}</div>
							<div class="vote-field">
								<span class="badge badge-success"><large><b>{{ $electTrie['voter']->votes()->count()   }}</b></large></span>
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

</div>
<script>
	
</script>
  @endsection
