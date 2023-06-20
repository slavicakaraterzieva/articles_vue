
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
       <meta name="viewport" content="width=device-width, initial-scale=1">
         {{--<meta name="csrf-token" content="{{csrf_token()}}"> 
          <script>window.Laravel={csrfToken:'{{csrf_token()}}'}</script>--}}

        <title>ArticlesVue</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!--bootstrap-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    </head>
  
    <body class="antialiased">
     
    <div id="app">
          
              <canvas id="canvas">
              </canvas>

        <div class="row">
          <div style="
            position: absolute; 
            z-index: 1;
            margin-left:1.8%;
            transform:translate(-1%)"> 
              <navbar></navbar>
              <div class="container">
                
                  <articles></articles>
                
              </div>
              <foot></foot>
          </div>
        </div>
        
    </div>
  
     
   <!--background image and snow animation-->
      <script>
        document.addEventListener('DOMContentLoaded', function() {
       
        function drawCanvas() {
            var can = document.getElementById("canvas"),
            //ctx is the brush to draw with
            ctx = can.getContext("2d");
            var canh = can.height = window.innerHeight;
            var canw = can.width = window.innerWidth;
           
              var flakes = [];
        
            function addFlakes() {
                var x = Math.floor(Math.random()*canw)+1;
                var y = 0;
                var s = Math.floor(Math.random() * 3) + 1;
                flakes.push({"x":x,"y":y,"s":s});
            };

            function snow() {
                addFlakes();

                for (var i = 0; i < flakes.length; i++) {
                    ctx.fillStyle = "white";
                    ctx.beginPath();
                    //arc x, y, radius, startAngle, endAngle, clockwise or anticlockwise
                    ctx.arc(flakes[i].x, flakes[i].y += flakes[i].s * .3, flakes[i].s * .4, 0, Math.PI * 2, false);
                    ctx.fill();
                    if (flakes[i].y > canh) {
                        flakes.splice(i, 1);
                    };
                    ctx.closePath;
                };
            };

                function animatecan() {
                    ctx.save();
                    ctx.clearRect(0, 0, canw, canh);
                    ctx.restore();
                    snow();
                
                };
                var interval = setInterval(animatecan, 30);
            };

            window.addEventListener("load", drawCanvas());
              });
      </script>

      <!--bootstrap-->
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
      <!--end bootstrap-->
 
   <style>
      #canvas{
        background-image:url(https://wallpaperaccess.com/full/634020.jpg);
        position:fixed;
        z-index:-1;

      }
    </style> 

<script src="{{asset('js/app.js')}}"></script>
    </body>
</html>
