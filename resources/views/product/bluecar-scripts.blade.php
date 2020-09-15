<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://unpkg.com/spritespin@4.0.11/release/spritespin.js"></script>
<script>
  var api;
        $(function () {
          let imagesArray = [
            "./images/0.jpg",
            "./images/2.jpg",
            "./images/3.jpg",
            "./images/4.jpg",
            "./images/5.jpg",
            "./images/6.jpg",
            "./images/7.jpg",
            "./images/8.jpg",
            "./images/9.jpg",
            "./images/10.jpg",
            "./images/11.jpg",
            "./images/12.jpg",
            "./images/13.jpg",
            "./images/14.jpg",
            "./images/15.jpg",
            "./images/16.jpg",
            "./images/17.jpg",
            "./images/18.jpg",
            "./images/19.jpg",
            "./images/20.jpg",
            "./images/21.jpg",
            "./images/22.jpg",
            "./images/23.jpg",
            "./images/24.jpg",
            "./images/25.jpg",
            "./images/26.jpg",
            "./images/27.jpg",
            "./images/28.jpg",
            "./images/29.jpg",
            "./images/30.jpg",
            "./images/31.jpg",
          ];
          $("a.js-fullscreen").click(function (e) {
            e.preventDefault();
            $(".spritespin").spritespin("api").requestFullscreen();
          });
          api = $(".spritespin")
            .spritespin({
              // source: SpriteSpin.sourceArray("/images/{frame}.jpg", {
              //   frame: [31],
              //   digits: 2,
              // }),
              source: imagesArray,
              width: 800,
              height: 450,
              sense: -1,
              responsive: true,
              animate: false,
              onFrame: function (e, data) {
                console.log(e);
                console.log(data.frame);
                // $(".spritespin-slider").val(data.frame);
              },
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
        });
</script>