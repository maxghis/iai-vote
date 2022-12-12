@extends('layouts.vote')
@section('autre-style')
<link href="{{ asset('assetsn/vendor/lightgallery/css/lightgallery.css')}}" rel="stylesheet">
<link href="{{ asset('assetsn/vendor/lightgallery/css/lg-zoom.css')}}" rel="stylesheet">
<link href="{{ asset('assetsn/vendor/lightgallery/css/lg-thumbnail.css')}}" rel="stylesheet">

<link href="{{ asset('assetsn/vendor/videojs/css/video-js.css')}}" rel="stylesheet">



<script src="{{ asset('assetsn/vendor/videojs/js/videojs.min.js')}}"></script>

<script src="{{ asset('assetsn/vendor/lightgallery/lightgallery.min.js')}}"></script>
<script src="{{ asset('assetsn/vendor/lightgallery/plugins/thumbnail/lg-thumbnail.umd.js')}}"></script>
<script src="{{ asset('assetsn/vendor/lightgallery/plugins/zoom/lg-zoom.umd.js')}}"></script>

@endsection
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
                                <h1>{{ $voter->name }} ({{ Str::upper($voter->classe) }})</h1>  <b>Candidat {{ $voter->category->cat  }}</b>
                                
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
                                                          
                                                            <div class=" text-center ml-3 mb-5" >
                                                                <h4> {{ $voter->description }}</h4>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                    
                                            
                                          </div>
                      
                                  </div>
                            </div>
                    </div>
                    <div class="col-md-12">  
                            
                            <div class="col-lg-9 col-sm-9 col-md-9 col-xs-9">
                               
                                    <div class=""><video     id="my-video"
                                        class="video-js inline-gallery-containe"
                                        controls
                                        preload="auto"
                                        
                                        
                                        data-setup="{}"
                                      controls="">
                                    <source src="{{ asset('storage/' . $voter->video_campagne) }}"></source>
                                    </video></div>

                                    <br>
                                    <hr>
                                    <style>
                                        .inline-gallery-container {
                                            width: 100%;

                                            // set 60% height
                                            height: 0;
                                            padding-bottom: 65%;

                                              }

                                              .inline-gallery-containe {
                                            width: 100%;
                                           margin-top: 10px;
                                            // set 60% height
                                            
                                            padding-bottom: 65%;

                                              }
                                    </style>
                                    <div>
                                        <div id="inline-gallery-container" class="inline-gallery-container"></div>
                                    </div>


                                    <script>
                                                 const lgContainer = document.getElementById('inline-gallery-container');
                                            const inlineGallery = lightGallery(lgContainer, {
                                                container: lgContainer,
                                                dynamic: true,
                                                // Turn off hash plugin in case if you are using it
                                                // as we don't want to change the url on slide change
                                                hash: false,
                                                // Do not allow users to close the gallery
                                                closable: false,
                                                // Add maximize icon to enlarge the gallery
                                                showMaximizeIcon: true,
                                                // Append caption inside the slide item
                                                // to apply some animation for the captions (Optional)
                                                appendSubHtmlTo: '.lg-item',
                                                // Delay slide transition to complete captions animations
                                                // before navigating to different slides (Optional)
                                                // You can find caption animation demo on the captions demo page
                                                slideDelay: 400,
                                                dynamicEl: [
                                                   <?php if(!empty($voter->img1)){ ?> 
                                                    {
                                                        
                                                        src: '<?= asset("storage/". $voter->img1) ?>',
                                                        
                                                    },
                                                   <?php } ?> 

                                                   <?php if(!empty($voter->img2)){ ?> 
                                                    {
                                                        
                                                        src: '<?= asset('storage/' . $voter->img2) ?>',
                                                        
                                                    },
                                                   <?php } ?> 


                                                   <?php if(!empty($voter->img3)){ ?> 
                                                    {
                                                        
                                                        src: '<?= asset('storage/' . $voter->img3) ?>',
                                                        
                                                    },
                                                   <?php } ?> 


                                                   <?php if(!empty($voter->img4)){ ?> 
                                                    {
                                                        
                                                        src: '<?= asset('storage/' . $voter->img4) ?>',
                                                        
                                                    },
                                                   <?php } ?> 


                                                   <?php if(!empty($voter->img5)){ ?> 
                                                    {
                                                        
                                                        src: '<?= asset('storage/' . $voter->img5) ?>',
                                                        
                                                    },
                                                   <?php } ?> 


                                                   <?php if(!empty($voter->img6)){ ?> 
                                                    {
                                                        
                                                        src: '<?= asset('storage/' . $voter->img6) ?>',
                                                        
                                                    },
                                                   <?php } ?> 


                                                   <?php if(!empty($voter->img7)){ ?> 
                                                    {
                                                        
                                                        src: '<?= asset('storage/' . $voter->img7) ?>',
                                                       
                                                    },
                                                   <?php } ?> 

                                                   <?php if(!empty($voter->img8)){ ?> 
                                                    {
                                                        
                                                        src: '<?= asset('storage/' . $voter->img8) ?>',
                                                        
                                                    },
                                                   <?php } ?> 


                                                   <?php if(!empty($voter->img9)){ ?> 
                                                    {
                                                        
                                                        src: '<?= asset('storage/' . $voter->img9) ?>',
                                                        
                                                    },
                                                   <?php } ?> 



                                                   <?php if(!empty($voter->img10)){ ?> 
                                                    {
                                                        
                                                        src: '<?= asset('storage/' . $voter->img10) ?>',
                                                        
                                                    },
                                                   <?php } ?> 


                                                    
                                                ],
                                            });

                                            // Since we are using dynamic mode, we need to programmatically open lightGallery
                                            inlineGallery.openGallery();
                                    </script>
                            </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection