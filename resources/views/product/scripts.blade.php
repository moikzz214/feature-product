<script type="text/javascript">
var slideIndex = 1;
 function openModal() { 
    document.getElementById("myModal").style.display = "block"; 
    
      showSlides(slideIndex)
    
  }

  function closeModal() {
    document.getElementById("myModal").style.display = "none";
  }

  $('body').on('click','.photos',function(e){
      e.preventDefault();
      hideVideo();
      openModal();
  });

  function showVideo(){ 
    $('.display-videos-thumbnails').show();
  }

  function hideVideo(){
    $('.display-videos-thumbnails').hide();
  }

  function plusSlides(n) {
    showSlides(slideIndex += n);
  }
  
  function currentSlide(n) {
    showSlides(slideIndex = n);
  }

  function showSlides(n) {
     var i;
    var slides = document.getElementsByClassName("mySlides");
    
    var captionText = document.getElementById("caption");
    if (n > slides.length) {slideIndex = 1}
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
     
    slides[slideIndex-1].style.display = "block"; 
    
  } 
 
  </script>
  <script type="text/javascript">
    var api;
    var sls = '{{ $slug }}';
      $(function () {
        var hpEdit = [];  
 
        function getUnique(arr, comp) {

              // store the comparison  values in array
              const unique =  arr.map(e => e[comp])

              // store the indexes of the unique objects
              .map((e, i, final) => final.indexOf(e) === i && i)

              // eliminate the false indexes & return unique objects
              .filter((e) => arr[e]).map(e => arr[e]);

              return unique;
        }
        
        var datazz = base_url+ '/api/product/'+sls;
        
        var dataApi = $.get(datazz, function(data) {
                    if (data.length == 0 && !p) {
                        $('form').remove();
                        return false;
                    }
                    return data;
                }, 'json');

        dataApi.always(function(data) {
            if (data.length == 0) { return false; }
            if (data) { 

                var imgs = []; 
                var panaromicImg = [];
               
                var conf_hotspots = [];  
                var blk = 'none'; 
            
                var intHps = [];
                var cnts = 1;

                var hpLabel = '';  
               
                let hpSlider = '';


                var x = 1;

                if(data.videos.length > 0){
                  $(".videos.img").show();
                }

                $('body').on('click','.videos', function(e){
                  e.preventDefault();  

                      if(x == 1){ 
                      var vds = '';
                          $.each(data.videos, function(i,o){   
                              vds +=  '<div> <video preload="metadata"  width="220" height="140" controls>'+
                                              '<source src="'+o.video_path+'" type="video/mp4">'+
                                              'Your browser does not support the video tag.'+
                                            '</video>'+
                                        '</div>';
                          });
                        $(".video-slider").html( vds );

                          setTimeout(() => {
                              $('.video-slider').slick({
                                  infinite: true,
                                  slidesToShow: 4,
                                  slidesToScroll: 4
                              });
                          }, 500);
                      }
                      x++;

                      showVideo();
                });

               
                $.each(data.hpItems, function(i,o){   
                  
                       var hpContents =  JSON.parse(o.content);
                        if(o.hotspot_for == "exterior"){
                          hpLabel +=    '<li id="'+o.id+'" data-ids="'+o.id+'" class="cd-single-point">';  
                          hpLabel +=       '<a class="cd-img-replace" data-ids="'+ cnts++ +'" href="#">More</a>'; 
                          hpLabel +=    '</li>';
                        }

                        hpSlider += '<div class="mySlides text-center" id="'+o.id+'">';
                        if(o.title){
                          hpSlider +=       '<h2 class="text-uppercase">'+o.title+'</h2>';
                        }
                        if(hpContents && hpContents.description){
                          hpSlider +=       '<p> '+hpContents.description+' </p>';
                        }
                        if(hpContents && hpContents.image){
                         
                          hpSlider +=       '<img  width="100%" height="auto" src="'+hpContents.image+'" style="width:100%" alt="'+o.title+'" />';
                        }
                        if(hpContents && hpContents.cta_url){
                          if(hpContents.cta_new_tab){
                            var target = "_blank";
                          }else{
                            var target = "_parent";
                          }
                          hpSlider +=      '<a href="'+hpContents.cta_url+'" target="'+target+'">'+hpContents.cta_label+'</a>';
                        }
                        hpSlider += '</div>';
                });

                $('.slider-content').html(hpSlider);
                $('#hp-draggable').html(hpLabel);   

                $.each(data.dataItems, function(i, o) {  
              
                    var items = o.items;  
                    
                    Object.keys(items).map(function (ii) {  
                            if(items[ii].item_type == "panorama"){
                              panaromicImg[ii] = base_url + '/storage/uploads/'+o.user.company_id+'/'+items[ii].media_file.path; 
                            } else{
                              conf_hotspots[ii] = [];      
                              conf_hotspots[ii]['hotspot_setting'] = [];    
                              imgs[ii] = base_url + '/storage/uploads/'+o.user.company_id+'/'+items[ii].media_file.path;
                            }
                            if(items[ii].hotspot_setting){
                                    Object.keys(items[ii].hotspot_setting).map(function (iii) {  
                                                // INTERIOR HOTSPOTS SETTINGS
                                          if(items[ii].item_type == "panorama"){
                                               
                                                var parseData = JSON.parse(items[ii].hotspot_setting[iii].hotspot_settings); 
                                                var pitch = parseData.pitch;
                                                var yaw = parseData.yaw;
                                                intHps[iii] = { pitch: pitch, yaw: yaw, display: "block", ids: cnts++, id: items[ii].hotspot_setting[iii].hotspot_id, cssClass: "custom-hotspot" };
                                                
                                          }else{
                                            // EXTERIOR HOTSPOTS SETTINGS
                                          
                                                
                                                var parseData = JSON.parse(items[ii].hotspot_setting[iii].hotspot_settings);
                                              
                                                var left = parseData.left;
                                                var top = parseData.top;
                                                conf_hotspots[ii]['hotspot_setting'][iii] = { hpID: items[ii].hotspot_setting[iii].hotspot_id, left: left+"%", top: top+"%", display: "block" };
                                          }
                                    });
                            }
                    });   
                    
                });   
                
                // REMOVE EMPTY ARRAY
                var panaromicImg = panaromicImg.filter(function (el) {
                                return el != null;
                              });
                 
                var imgs = imgs.filter(function (el) {
                  return el != null;
                });
               
                var conf_hotspots = conf_hotspots.filter(function (el) {
                  return el != null; 
                });
                
                var intHps = intHps.filter(function (el) {
                  return el != null;
                });    
                
                
                
                
                imgs.forEach(function(img){
                    new Image().src = img; 
                    // caches images, avoiding white flash between background replacements
                }); 

                let imagesArray = imgs;   
             
                function init360(){ 

                api = $(".spritespin")
                .spritespin({
                     
                    source: imagesArray,
                    // width: 800,
                    // height: 450,
                    width: 1366,
                    height: 768,
                     sense: -1,
                    responsive: true,
                    animate: false, 
                    plugins: [ 
                    "drag", 
                    "360", 
                    ],
                    onFrameChanged: function (e, data) { 

                        $('#hp-draggable li').hide();
                        
                        if(conf_hotspots){
                            Object.keys(conf_hotspots).map(function (i) { 
                             
                              if (conf_hotspots[data.frame] && conf_hotspots[data.frame].hotspot_setting.length > 0) {  
                                 
                                Object.keys(conf_hotspots[data.frame].hotspot_setting).map(function (ii) {   
                                  console.log(conf_hotspots[data.frame].hotspot_setting[ii]);
                                    $('#'+conf_hotspots[data.frame].hotspot_setting[ii].hpID).css({ 
                                        top: conf_hotspots[data.frame].hotspot_setting[ii].top,
                                        left: conf_hotspots[data.frame].hotspot_setting[ii].left,
                                        display: conf_hotspots[data.frame].hotspot_setting[ii].display,
                                    });
                                
                                }); 
                              }
                            }); 
                        }
                    },
                    onInit: function (e) { 
                      $('#hp-draggable li').hide();
                      
                       $(".spritespin-wrapper").css({"background-image":'url("'+ base_url + '/storage/uploads/'+data.dataItems[0].user.company_id+'/'+data.dataItems[0].items[0].media_file.path +'")', "background-size": "cover","background-position": "center", "background-repeat": "no-repeat"});
                    },
                    onLoad: function (e, data) {
                      if(conf_hotspots){
                            Object.keys(conf_hotspots).map(function (i) { 
                             
                              if (conf_hotspots[data.frame] && conf_hotspots[data.frame].hotspot_setting.length > 0) {  
                                 
                                Object.keys(conf_hotspots[data.frame].hotspot_setting).map(function (ii) {   
                                    $('#'+conf_hotspots[data.frame].hotspot_setting[ii].hpID).css({ 
                                        top: conf_hotspots[data.frame].hotspot_setting[ii].top,
                                        left: conf_hotspots[data.frame].hotspot_setting[ii].left,
                                        display: conf_hotspots[data.frame].hotspot_setting[ii].display,
                                    });
                                
                                }); 
                              }
                            }); 
                        }
                        $(".open-exterior").show();
                        $(".content-action").attr("style","display:flex");
                    },
                })
                .spritespin("api");  
              }
              init360();
                
                if(data.hpItems.length > 0){
                  $(".photos.img").show();
                }

                if(panaromicImg.length > 0){
                  $('.open-interior').show();

                galviewer = pannellum.viewer("panorama", {
                              // hotSpotDebug: true,
                              default: {
                                firstScene: "default_scene_start",
                                // author: "Moikzz",
                                autoLoad: true,
                                sceneFadeDuration: 1000,
                              },
                              scenes: {
                                "default_scene_start": {  
                                  hfov: 80,
                                  pitch: -16.834687202204037,
                                  yaw: -36.30724382948786, 
                                  type: "equirectangular",
                                  panorama: panaromicImg, 
                                  hotSpots: intHps, // dynamically add hotspots 
                                
                                },
                              },
                            }); 
                }
                      /**
                      * HotSpot
                      * */
                      //open interest point description
                      $(".cd-single-point")
                        .children("a")
                        .on("click", function (e) {
                            e.preventDefault();
                            var rw = $(this).attr('data-ids');
                            hideVideo();
                            openModal();currentSlide(rw); 
                      }); 
                      
                      
                      $("div").on("click",".custom-hotspot", function(e){
                            e.preventDefault();
                            var rw = $(this).attr('data-ids');
                              hideVideo();
                              openModal();
                              currentSlide(rw);  
                      });

                      // Tab
                      var $interior = $(".interior");
                      var $exterior = $(".exterior");
                      var $interiorBtn = $(".open-interior");
                      var $exteriorBtn = $(".open-exterior");

                      $interior.hide();

                      $interiorBtn.on("click", function (e) {
                        e.preventDefault();
                        hideVideo();
                        $exteriorBtn.removeClass("active");
                        $interiorBtn.addClass("active");
                        $interior.show();
                        $exterior.hide(); 
                      });
                      $exteriorBtn.on("click", function () {
                        hideVideo();
                        init360();
                        $exteriorBtn.addClass("active");
                        $interiorBtn.removeClass("active");
                        $interior.hide();
                        $exterior.show();
                      });
            }
        }); 
       
      });
  </script>
