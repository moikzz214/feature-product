@extends('layouts.single')

@section('content')
<div>
    <div class="container">
        <h1>GALLEGA DEMO</h1>
        <!-- <a class="button js-fullscreen" href="#">Fullscreen</a> -->
        <div class="spritespin-wrapper">
            <div class="spritespin"></div>
            <input class="spritespin-slider" type="range" />
            <!-- <a class="hotspot hotspot--macbook" href="#">
            <span class="hotspot--title">MacBook</span>
            <span class="hotspot--cta"></span>
          </a> -->
            <ul>
                <li class="cd-single-point">
                    <a class="cd-img-replace" href="#0">More</a>
                    <div class="cd-more-info cd-right">
                        <h2>This is just a Demo</h2>
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora
                            magni, molestiae placeat nisi hic impedit natus. Facere
                            repudiandae deserunt cumque corrupti iste id debitis, at,
                            possimus praesentium commodi impedit laborum?
                        </p>
                        <a href="#0" class="cd-close-info cd-img-replace">Close</a>
                    </div>
                </li>
                <!-- .cd-single-point -->
                <li class="cd-single-point">
                    <a class="cd-img-replace" href="#0">More</a>
                    <div class="cd-more-info cd-left">
                        <h2>A Demo Text</h2>
                        <p>
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                            Architecto deserunt voluptatem perspiciatis minus eveniet,
                            dolores dolore maiores atque velit debitis quaerat aliquam nihil
                            dolorem iusto molestias quam rem doloremque ab.
                        </p>
                        <a href="#0" class="cd-close-info cd-img-replace">Close</a>
                    </div>
                </li>
            </ul>
        </div>
        <div class="spritespin-buttons-wrapper">
            <div class="button" onclick="api.prevFrame();">&larr;</div>
            <div class="button" onclick="api.requestFullscreen();">FULLSCREEN</div>
            <div class="button" onclick="api.nextFrame();">&rarr;</div>
        </div>
    </div>
</div>
@endsection