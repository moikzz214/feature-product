@extends('layouts.single')

@section('content')
<div class="container"> 
    <div class="content-wrapper">
      <div class="exterior">
        <div class="spritespin-wrapper" id="spritespin-wrapper">
          <div class="spritespin"></div>
        
          <ul id="hp-draggable" class="hp-draggable-ext">  </ul>
          
        </div>
      </div>
      <div class="interior">
        <div style="max-width: 1366px; margin: 0 auto;">
          <div id="panorama"> <ul class="hp-draggable-int"> </ul></div>
        </div>
      </div>
    </div> 
    <div class="content-action">
      <div class="open-exterior active">exterior</div>
      <div class="open-interior">interior</div>
        <div class="divider"></div>
      <div class="videos img">VIDEOS</div>
      <div class="photos img">PHOTOS</div>
    </div>

        <div class="display-videos-thumbnails">
              <div class="video-slider slider">  
              </div>
        </div>

  </div> 

  <div id="myModal" class="modal fade" role="dialog">
    <span class="close cursor" onclick="closeModal()">&times;</span>
    <div class="modal-content">

      <div class="slider-content">
        <div class="mySlides"><img src="{{URL::to('/')}}/storage/uploads/user-1/_A739845.JPG"  width="100%" height="auto"> </div>
        <div class="mySlides"><img src="{{URL::to('/')}}/storage/uploads/user-1/_A739846.JPG"  width="100%" height="auto"> </div>

      </div> 
              
      <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
      <a class="next" onclick="plusSlides(1)">&#10095;</a>
  
      <div class="caption-container">
            <p id="caption"></p>
      </div>
    </div>
  </div>
@endsection
