@extends('layouts.vote')

@section('content')

<div class="container main-secction bg-white">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 image-section">
            <img width="100%" height="250" src="{{ asset('storage/' . $voter->image_campagne) }}">
        </div>
        <div class="row user-left-part">
            <div class="col-md-3 col-sm-3 col-xs-12 user-profil-part pull-left">
                <div class="row ">
                    <div class="col-md-12 col-md-12-sm-12 col-xs-12 user-image text-center">
                        <img width="150" height="150" src="{{ asset('storage/' . $voter->image_profile) }}" class="rounded-circle">
                    </div>
                   
                </div>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-12 pull-right profile-right-section">
                <div class="row profile-right-section-row">
                    <div class="col-md-12 profile-header">
                        <div class="row">
                            <div class="col-md-8 col-sm-6 col-xs-6 profile-header-section1 pull-left">
                                <h1>{{ $voter->name }}</h1>  <b>Candidat {{ $voter->category->cat  }}</b>
                                
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-6 profile-header-section1 text-right pull-rigth">
                                <a href="{{ route('userVote') }}" class="btn btn-warning">Page De Vote</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                       
                            <div class="col-md-9">
                                    <ul class="nav nav-tabs" role="tablist">
                                            <li class="nav-item">
                                              <a class="nav-link active" href="#profile" role="tab" data-toggle="tab"><i class="fas fa-info-circle"></i> A propos</a>
                                            </li>
                                                                                         
                                          </ul>
                                          
                                          <!-- Tab panes -->
                                          <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane fade show active" id="profile">
                                                    <div class="row col-lg-9 col-sm-9 col-md-9 col-xs-9 catd" style="padding-left: 26px;">
                                                          
                                                        <div class="row">
                                                          
                                                            <div class=" text-center" >
                                                                <h4> {{ $voter->description }}</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                    
                                            
                                          </div>
                      
                            </div>
                            <div class="ccol-lg-9 col-sm-9 col-md-9 col-xs-9">
                               
                                    <video width="100%" autoplay controls="" src="{{ asset('storage/' . $voter->video_campagne) }}"></video>
                               
                            </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection