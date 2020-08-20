@extends('layouts.single')

@section('content')
<div class="container">
    <h1 style="margin-bottom: 60px;">GALLEGA DEMO</h1>
    <!-- <a class="button js-fullscreen" href="#">Fullscreen</a> -->
    <div class="content-wrapper">
      <div class="exterior">
        <div class="spritespin-wrapper">
          <div class="spritespin"></div>
          <input class="spritespin-slider" type="range" />
          <ul>
            <li class="cd-single-point hotspot-1">
              <a class="cd-img-replace" href="#0">More</a>
              <div
                class="cd-more-info cd-right"
                style="width: 300px; height: auto;"
              >
                <h2>This is just a Demo</h2>
                <p>
                  Lorem ipsum dolor sit amet consectetur adipisicing elit.
                  Tempora magni, molestiae placeat nisi hic impedit natus.
                  Facere repudiandae deserunt cumque corrupti iste id debitis,
                  at, possimus praesentium commodi impedit laborum?
                </p>
                <a href="#0" class="cd-close-info cd-img-replace">Close</a>
              </div>
            </li>
            <li class="cd-single-point hotspot-2">
              <a class="cd-img-replace" href="#0">More</a>
              <div
                class="cd-more-info cd-left"
                style="width: 300px; height: auto;"
              >
                <h2>A Demo Text</h2>
                <p>
                  Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                </p>
                <img
                  width="100%"
                  height="auto"
                  src="https://gallega.com/demo/images/panoramic/rim.jpg"
                  alt="Gallega Demo"
                />
                <a href="#0" class="cd-close-info cd-img-replace">Close</a>
              </div>
            </li>
          </ul>
          <div class="action-wrapper">
            <div class="spritespin-buttons-wrapper">
              <div class="button" onclick="api.prevFrame();">&larr;</div>
              <!-- <div class="button" onclick="api.requestFullscreen();">FULLSCREEN</div> -->
              <div class="button" onclick="api.nextFrame();">&rarr;</div>
            </div>
          </div>
        </div>
      </div>
      <div class="interior">
        <div style="max-width: 800px; margin: 0 auto;">
          <div id="panorama"></div>
        </div>
      </div>
    </div>
    <div class="content-action">
      <div class="open-exterior">exterior</div>
      <div class="open-interior">interior</div>
    </div>
  </div>
@endsection
