
<script type="text/javascript">
    // pannellum.viewer('panorama', {
    //   "type": "equirectangular",
    //   "panorama": "./images/panoramic/panoramic-4k.jpg",
    //   "preview": "./images/panoramic/panoramic-preview-1.png",
    //   "autoLoad": true
    // });

  </script>
  <script type="text/javascript">
    var api;
    $(function () {

        var galviewer = pannellum.viewer("panorama", {
      // hotSpotDebug: true,
      default: {
        firstScene: "circle",
        // author: "Matthew Petroff",
        sceneFadeDuration: 1000,
      },
      scenes: {
        circle: {
          // title: "Mason Circle",
          // hfov: 92.49266381856185,
          hfov: 50,
          pitch: -16.834687202204037,
          yaw: -36.30724382948786,
          type: "equirectangular",
          panorama: "http://127.0.0.1:8000/product/images/panoramic/panoramic-4k.jpg",
          autoLoad: true,
          hotSpots: [
            {
              pitch: -14.94618622367452,
              yaw: -174.5048581866088,
              type: "scene",
              text: "Passenger Seats",
              sceneId: "back",
            },
            {
              pitch: -27.263801777525146,
              yaw: 5.051667495791323,
              type: "info",
              text: "Dashboard",
              cssClass: "custom-hotspot",
              createTooltipFunc: hotspot,
              createTooltipArgs: "<p>Sample Dashboard</p><img width='100%' height='auto' src='images/panoramic/dashboard.png' alt='Gallega Demo'/>",
            },
          ],
        },

        back: {
          // title: "Spring House or Dairy",
          hfov: 86.3912764763318,
          pitch: -20.907854035165947,
          yaw: 4.400363480152841,
          type: "equirectangular",
          panorama: "./images/panoramic/panoramic-4k.jpg",
          hotSpots: [
            {
              pitch: -49.96017430532255,
              yaw: 52.51385734540035,
              type: "scene",
              text: "Front Seat",
              sceneId: "circle",
              targetYaw: -23,
              targetPitch: 2,
            },
            {
              pitch: -19.608579305039225,
              yaw: 5.808652817516894,
              type: "info",
              text: "Dashboard",
            },
          ],
        },
      },
    });

    function hotspot(hotSpotDiv, args) {
      console.log(hotSpotDiv);
      console.log(args);
      hotSpotDiv.classList.add("custom-tooltip");
      var span = document.createElement("span");
      span.innerHTML = args;
      hotSpotDiv.appendChild(span);
      span.style.width = span.scrollWidth - 20 + "px";
      span.style.marginLeft =
        -(span.scrollWidth - hotSpotDiv.offsetWidth) / 2 + "px";
      span.style.marginTop = -span.scrollHeight - 12 + "px";
    }

    galviewer.on("mousedown", function (event) {
      console.log(galviewer.getPitch(), galviewer.getYaw());
      // For pitch and yaw of mouse location
      console.log(galviewer.mouseEventToCoords(event));
    });

      var $hotspot1 = $(".hotspot-1");
      var $hotspot2 = $(".hotspot-2");
      let hotspot2Settings = [
        {
          item: 0,
          bottom: "45%",
          right: "38%",
          display: "block",
        },
        {
          item: 1,
          bottom: "45%",
          right: "34%",
          display: "block",
        },
        {
          item: 2,
          bottom: "47%",
          right: "29%",
          display: "block",
        },
        {
          item: 3,
          bottom: "49%",
          right: "27%",
          display: "block",
        },
        {
          item: 4,
          bottom: "50%",
          right: "25%",
          display: "block",
        },
        {
          item: 5,
          bottom: "52%",
          right: "23%",
          display: "block",
        },
        {
          item: 6,
          bottom: "53%",
          right: "22%",
          display: "block",
        },
        {
          item: 7,
          bottom: "56%",
          right: "21%",
          display: "block",
        },
        {
          item: 8,
          bottom: "58%",
          right: "21%",
          display: "block",
        },
        {
          item: 9,
          bottom: "60%",
          right: "22%",
          display: "block",
        },
        {
          item: 10,
          bottom: "61%",
          right: "23%",
          display: "block",
        },
        {
          item: 11,
          bottom: "62%",
          right: "24%",
          display: "block",
        },
        {
          item: 12,
          bottom: "62%",
          right: "24%",
          display: "block",
        },
        {
          item: 13,
          bottom: "64%",
          right: "25%",
          display: "block",
        },
        { item: 14, display: "none" },
        { item: 15, display: "none" },
        { item: 16, display: "none" },
        { item: 17, display: "none" },
        { item: 18, display: "none" },
        { item: 19, display: "none" },
        { item: 20, display: "none" },
        { item: 21, display: "none" },
        { item: 22, display: "none" },
        { item: 23, display: "none" },
        { item: 24, display: "none" },
        { item: 25, display: "none" },
        { item: 26, display: "none" },
        { item: 27, display: "none" },
        { item: 28, display: "none" },
        { item: 29, display: "none" },
        { item: 30, display: "none" },
        { item: 31, display: "none" },
        { item: 32, display: "none" },
        { item: 33, display: "none" },
        { item: 34, display: "none" },
        { item: 35, display: "none" },
        { item: 36, display: "none" },
        { item: 37, display: "none" },
        { item: 38, display: "none" },
        { item: 39, display: "none" },
        { item: 40, display: "none" },
        { item: 41, display: "none" },
        { item: 42, display: "none" },
        { item: 43, display: "none" },
        {
          item: 44,
          bottom: "43%",
          right: "57%",
          display: "block",
        },
        {
          item: 45,
          bottom: "43%",
          right: "52%",
          display: "block",
        },
        {
          item: 46,
          bottom: "43%",
          right: "50%",
          display: "block",
        },
        {
          item: 47,
          bottom: "43%",
          right: "48%",
          display: "block",
        },
        {
          item: 48,
          bottom: "43%",
          right: "44%",
          display: "block",
        },
        {
          item: 49,
          bottom: "45%",
          right: "40%",
          display: "block",
        },
        { item: 50, display: "none" },
        { item: 51, display: "none" },
      ];
      let hotspot1Settings = [
        {
          item: 0,
          bottom: "55%",
          right: "23%",
          display: "block",
        },
        {
          item: 1,
          bottom: "56%",
          right: "20%",
          display: "block",
        },
        {
          item: 2,
          bottom: "58%",
          right: "18%",
          display: "block",
        },
        {
          item: 3,
          bottom: "60%",
          right: "16%",
          display: "block",
        },
        {
          item: 4,
          bottom: "50%",
          right: "25%",
          display: "block",
        },
        {
          item: 5,
          bottom: "52%",
          right: "23%",
          display: "block",
        },
        {
          item: 6,
          bottom: "53%",
          right: "22%",
          display: "block",
        },
        {
          item: 7,
          bottom: "56%",
          right: "21%",
          display: "block",
        },
        {
          item: 8,
          bottom: "58%",
          right: "21%",
          display: "block",
        },
        {
          item: 9,
          bottom: "60%",
          right: "22%",
          display: "block",
        },
        {
          item: 10,
          bottom: "61%",
          right: "23%",
          display: "block",
        },
        { item: 11, display: "none" },
        { item: 12, display: "none" },
        { item: 13, display: "none" },
        { item: 14, display: "none" },
        { item: 15, display: "none" },
        { item: 16, display: "none" },
        { item: 17, display: "none" },
        { item: 18, display: "none" },
        { item: 19, display: "none" },
        { item: 20, display: "none" },
        { item: 21, display: "none" },
        { item: 22, display: "none" },
        { item: 23, display: "none" },
        { item: 24, display: "none" },
        { item: 25, display: "none" },
        { item: 26, display: "none" },
        { item: 27, display: "none" },
        { item: 28, display: "none" },
        { item: 29, display: "none" },
        { item: 30, display: "none" },
        { item: 31, display: "none" },
        { item: 32, display: "none" },
        { item: 33, display: "none" },
        { item: 34, display: "none" },
        { item: 35, display: "none" },
        { item: 36, display: "none" },
        { item: 37, display: "none" },
        { item: 38, display: "none" },
        {
          item: 39,
          bottom: "58%",
          right: "75%",
          display: "block",
        },
        {
          item: 40,
          bottom: "56%",
          right: "71%",
          display: "block",
        },
        {
          item: 41,
          bottom: "55%",
          right: "67%",
          display: "block",
        },
        {
          item: 42,
          bottom: "54%",
          right: "63%",
          display: "block",
        },
        {
          item: 43,
          bottom: "53%",
          right: "52%",
          display: "block",
        },
        {
          item: 44,
          bottom: "53%",
          right: "47%",
          display: "block",
        },
        {
          item: 45,
          bottom: "53%",
          right: "41%",
          display: "block",
        },
        {
          item: 46,
          bottom: "54%",
          right: "38%",
          display: "block",
        },
        {
          item: 47,
          bottom: "54%",
          right: "36%",
          display: "block",
        },
        {
          item: 48,
          bottom: "54%",
          right: "31%",
          display: "block",
        },
        {
          item: 49,
          bottom: "55%",
          right: "27%",
          display: "block",
        },
        { item: 50, display: "none" },
        { item: 51, display: "none" },
      ];
      let imagesArray = [
        "http://www.voidcanvas.com/demo/28823deye/images/1.png",
        "http://www.voidcanvas.com/demo/28823deye/images/2.png",
        "http://www.voidcanvas.com/demo/28823deye/images/3.png",
        "http://www.voidcanvas.com/demo/28823deye/images/4.png",
        "http://www.voidcanvas.com/demo/28823deye/images/5.png",
        "http://www.voidcanvas.com/demo/28823deye/images/6.png",
        "http://www.voidcanvas.com/demo/28823deye/images/7.png",
        "http://www.voidcanvas.com/demo/28823deye/images/8.png",
        "http://www.voidcanvas.com/demo/28823deye/images/9.png",
        "http://www.voidcanvas.com/demo/28823deye/images/10.png",
        "http://www.voidcanvas.com/demo/28823deye/images/11.png",
        "http://www.voidcanvas.com/demo/28823deye/images/12.png",
        "http://www.voidcanvas.com/demo/28823deye/images/13.png",
        "http://www.voidcanvas.com/demo/28823deye/images/14.png",
        "http://www.voidcanvas.com/demo/28823deye/images/15.png",
        "http://www.voidcanvas.com/demo/28823deye/images/16.png",
        "http://www.voidcanvas.com/demo/28823deye/images/17.png",
        "http://www.voidcanvas.com/demo/28823deye/images/18.png",
        "http://www.voidcanvas.com/demo/28823deye/images/19.png",
        "http://www.voidcanvas.com/demo/28823deye/images/20.png",
        "http://www.voidcanvas.com/demo/28823deye/images/21.png",
        "http://www.voidcanvas.com/demo/28823deye/images/22.png",
        "http://www.voidcanvas.com/demo/28823deye/images/23.png",
        "http://www.voidcanvas.com/demo/28823deye/images/24.png",
        "http://www.voidcanvas.com/demo/28823deye/images/25.png",
        "http://www.voidcanvas.com/demo/28823deye/images/26.png",
        "http://www.voidcanvas.com/demo/28823deye/images/27.png",
        "http://www.voidcanvas.com/demo/28823deye/images/28.png",
        "http://www.voidcanvas.com/demo/28823deye/images/29.png",
        "http://www.voidcanvas.com/demo/28823deye/images/30.png",
        "http://www.voidcanvas.com/demo/28823deye/images/31.png",
        "http://www.voidcanvas.com/demo/28823deye/images/32.png",
        "http://www.voidcanvas.com/demo/28823deye/images/33.png",
        "http://www.voidcanvas.com/demo/28823deye/images/34.png",
        "http://www.voidcanvas.com/demo/28823deye/images/35.png",
        "http://www.voidcanvas.com/demo/28823deye/images/36.png",
        "http://www.voidcanvas.com/demo/28823deye/images/37.png",
        "http://www.voidcanvas.com/demo/28823deye/images/38.png",
        "http://www.voidcanvas.com/demo/28823deye/images/39.png",
        "http://www.voidcanvas.com/demo/28823deye/images/40.png",
        "http://www.voidcanvas.com/demo/28823deye/images/41.png",
        "http://www.voidcanvas.com/demo/28823deye/images/42.png",
        "http://www.voidcanvas.com/demo/28823deye/images/43.png",
        "http://www.voidcanvas.com/demo/28823deye/images/45.png",
        "http://www.voidcanvas.com/demo/28823deye/images/46.png",
        "http://www.voidcanvas.com/demo/28823deye/images/47.png",
        "http://www.voidcanvas.com/demo/28823deye/images/48.png",
        "http://www.voidcanvas.com/demo/28823deye/images/49.png",
        "http://www.voidcanvas.com/demo/28823deye/images/50.png",
        "http://www.voidcanvas.com/demo/28823deye/images/51.png",
      ];
      // let imagesArray = [
      //   "./images/0.jpg",
      // ];
      // $("a.js-fullscreen").click(function (e) {
      //   e.preventDefault();
      //   $(".spritespin").spritespin("api").requestFullscreen();
      // });
      api = $(".spritespin")
        .spritespin({
          // source: SpriteSpin.sourceArray("/images/{frame}.jpg", {
          //   frame: [31],
          //   digits: 2,
          // }),
          // frame: 50,
          source: imagesArray,
          // width: 800,
          // height: 450,
          width: 1366,
          height: 650,
          // sense: -1,
          responsive: true,
          animate: false,
          // onFrame: function (e, data) {
          //   console.log(e);
          //   console.log(data.frame);
          //   // $(".spritespin-slider").val(data.frame);
          // },
          plugins: [
            // module that changes frame on drag
            "drag",
            // module that eases out an animation after mouse is released
            // "ease",
            // module to display array or sprite of images
            "360",
            // module that render and fades additional frames to somulate blur
            // "blur",
            // 'zoom'
          ],
          onFrame: function (e, data) {
            $(".spritespin-slider").val(data.frame);
            // console.log(data.frame);
            console.log(data.frame);
            Object.keys(hotspot1Settings).map(function (i) {
              // let h1Display = "none";
              // console.log(hotspot1Settings[i].item);
              // if (hotspot1Settings[i].item) {
              //   h1Display = "block";
              if (hotspot1Settings[i].item == data.frame) {
                $hotspot1.css({
                  bottom: hotspot1Settings[i].bottom,
                  right: hotspot1Settings[i].right,
                  display: hotspot1Settings[i].display,
                });
              }
              // }
            });

            Object.keys(hotspot2Settings).map(function (i) {
              if (hotspot2Settings[i].item == data.frame) {
                $hotspot2.css({
                  bottom: hotspot2Settings[i].bottom,
                  right: hotspot2Settings[i].right,
                  display: hotspot2Settings[i].display,
                });
              }
            });

            // if (data.frame == 0) {
            //   hotspot2.css({ "bottom": "66%", "right": "53%" });
            // } else if (data.frame == 1) {
            //   hotspot2.css({ "bottom": "66%", "right": "52%" });
            // } else if (data.frame == 2) {
            //   hotspot2.css({ "bottom": "66%", "right": "51%" });
            // } else if (data.frame == 3) {
            //   hotspot2.css({ "bottom": "66%", "right": "50%" });
            // } else if (data.frame == 4) {
            //   hotspot2.css({ "bottom": "66%", "right": "49%" });
            // }
          },
          onInit: function (e, data) {
            $(".spritespin-slider")
              .attr("min", 0)
              .attr("max", data.source.length - 1)
              .attr("value", 0)
              .on("input", function (e) {
                SpriteSpin.updateFrame(data, e.target.value);
              });
          },
        })
        .spritespin("api");
      // $(".spritespin")
      //   .spritespin("api")
      //   .onFrame(function (e) {
      //     console.log("hey");
      //   });

      /**
       * HotSpot
       * */
      //open interest point description
      $(".cd-single-point")
        .children("a")
        .on("click", function () {
          var selectedPoint = $(this).parent("li");
          if (selectedPoint.hasClass("is-open")) {
            selectedPoint.removeClass("is-open").addClass("visited");
          } else {
            selectedPoint
              .addClass("is-open")
              .siblings(".cd-single-point.is-open")
              .removeClass("is-open")
              .addClass("visited");
          }
        });
      //close interest point description
      $(".cd-close-info").on("click", function (event) {
        event.preventDefault();
        $(this)
          .parents(".cd-single-point")
          .eq(0)
          .removeClass("is-open")
          .addClass("visited");
      });

      // Tab
      var $interior = $(".interior");
      var $exterior = $(".exterior");
      var $interiorBtn = $(".open-interior");
      var $exteriorBtn = $(".open-exterior");

      $interior.hide();

      $interiorBtn.on("click", function () {
        $exteriorBtn.removeClass("active");
        $interiorBtn.addClass("active");
        $interior.show();
        $exterior.hide();
      });
      $exteriorBtn.on("click", function () {
        $exteriorBtn.addClass("active");
        $interiorBtn.removeClass("active");
        $interior.hide();
        $exterior.show();
      });
    });
  </script>
