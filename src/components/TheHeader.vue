<template>
  <header id="wrapper-header">
    <canvas id="rect" />

    <div class="content-header">
      <h1 class="btn"
        v-scroll-reveal="{
          delay: 700,
          distance: '0px',
          opacity: 0,
          duration: 0}"
      >
        <span class="text and">Webdesign </span>
        <span class="text">Development</span>
      </h1>
      
      <p class="header-me"
        v-scroll-reveal="{
          origin: 'left',
          delay: 100,
          distance: '900px',
          opacity: null,
          duration: 2000}"
        ><strong class="text"
          v-scroll-reveal="{
            origin: 'right',
            delay: 100,
            distance: '900px',
            opacity: null,
            duration: 2000}"
        >Florian Nuẞbaum</strong>
      </p>
    </div>
  
    <TheScrollBottom class="icon-position" />
  </header>
</template>

<script>
import TheScrollBottom from '@/components/TheScrollBottom';

export default {
  components: {
    TheScrollBottom,
  },
  mounted() {

    // var ctx = document.getElementById('canvas').getContext('2d');
    let canvas = document.querySelector("#rect");
    let ctx = canvas.getContext("2d");
    let vh = window.innerHeight;
    let vw = window.innerWidth;
    canvas.height = vh;
    canvas.width = vw;
    // ctx.globalCompositeOperation = 'destination-over';
    // ctx.clearRect(100, 100, 300, 300); // clear canvas
    // ctx.fillStyle = 'rgba(0, 0, 0, 0.4)';
    // ctx.strokeStyle = 'rgba(0, 153, 255, 0.4)';
    // ctx.strokeStyle = "#616161";
    ctx.fillStyle = 'rgba(0, 0, 0, 0.3)';
    // ctx.strokeStyle = "black";
    // ctx.globalAlpha = 0.3;
    ctx.lineWidth = 1;
    ctx.lineJoin = 'round';
    ctx.lineCap = 'butt';

    // shadow
    // ctx.shadowColor = 'rgba(0, 0, 0, 0.3)';
    // ctx.shadowColor = 'black';
    // ctx.shadowOffsetX = 300;
    // ctx.shadowOffsetY = 300;
    // ctx.shadowBlur = 3;

    // glow
    // var grad = ctx.createLinearGradient(0, 0, 300, 0);
    // grad.addColorStop(0, "black");
    // grad.addColorStop(0.5, "red");
    // grad.addColorStop(1, "white");
    // ctx.fillStyle = grad;

    // W2
    // var grad = ctx.createLinearGradient(0, 0, 300, 0);
    // grad.addColorStop(0, 'rgba(0, 0, 0, 0.3)');
    // grad.addColorStop(.5, 'rgba(250, 250, 250, 0.3)');
    // grad.addColorStop(1, 'rgba(0, 0, 0, 0.3)');
    // ctx.fillStyle = grad;


    // var grad = ctx.createRadialGradient(90, 90, 500, 90, 90, 70);  
    // grad.addColorStop(.5, 'rgba(250, 250, 250, 0.3)');        
    // grad.addColorStop(0, 'rgba(0, 0, 0, 0.3)');
    // ctx.fillStyle = grad;




    // function getRandomArbitrary(min, max) {
    //   return Math.random() * (max - min) + min;
    // }
    // let point1 = [getRandomArbitrary(40, vw/2), getRandomArbitrary(40, vh/2), 105, 0];
    // let point2 = [getRandomArbitrary(40, vw/2), getRandomArbitrary(vh/2, vh), 60, 0];
    // let point3 = [getRandomArbitrary(vw/2, vw), getRandomArbitrary(40, vh/2), 105, 0];
    // let point4 = [getRandomArbitrary(vw/2, vw), getRandomArbitrary(vh/2, vh), 105, 0];

    let point1 = [150, 150, 105, 0];
    let point2 = [200, 600, 60, 0];
    let point3 = [500, 200, 105, 0];
    let point4 = [900, 500, 105, 0];

    // Radius Line
    // ctx.beginPath();
    // ctx.arc(150, 150, 105, 40, Math.PI * 2, false); // Earth orbit
    // ctx.arc(500, 200, 105, 0, Math.PI * 2, false); // Earth orbit
    // ctx.arc(200, 600, 60, 0, Math.PI * 2, false); // Earth orbit
    // ctx.arc(900, 500, 105, 0, Math.PI * 2, false); // Earth orbit
    // ctx.stroke();


    function draw() {
      var time = new Date();
      // let region = new Path2D();

      // clear canvas
      ctx.clearRect(0, 0, vw, vh);

      // Intersections
      function intersection(points) {
        ctx.translate(points[0], points[1]);
        ctx.rotate(((2 * Math.PI) / 60) * time.getSeconds() + ((2 * Math.PI) / 60000) * time.getMilliseconds());
        ctx.translate(points[2], points[3]);

        var grad = ctx.createLinearGradient(points[0], points[1], points[2], points[3]);
        grad.addColorStop(0, 'rgba(0, 0, 0, 0.3)');
        grad.addColorStop(.5, 'rgba(250, 250, 250, 0.3)');
        grad.addColorStop(1, 'rgba(0, 0, 0, 0.3)');
        ctx.fillStyle = grad;
      }

      
      // TEST 1
      // function polygon(ctx, x, y, radius, sides, rotateAngle) {
      //   if (sides < 3) return;
      //   var a = (Math.PI * 2)/sides;
      //   ctx.beginPath();
      //   ctx.translate(x,y);
      //   // ctx.rotate(rotateAngle);
      //   ctx.rotate(((2 * Math.PI) / 60) * time.getSeconds() + ((2 * Math.PI) / 60000) * time.getMilliseconds());
      //   ctx.moveTo(radius,0);
      //   for (var i = 1; i < sides; i++) {
      //   ctx.lineTo(radius*Math.cos(a*i),radius*Math.sin(a*i));
      //   }
      //   ctx.closePath();
      // }

      // polygon(ctx, vw/2,vh/2,100,3,-Math.PI/2);      
      // ctx.stroke()


      // TEST 2
      // ctx.moveTo(0, 0);
      // ctx.translate(vw,vh);
      // // ctx.moveTo(30, 90);
      // ctx.lineTo(30, 90);
      // ctx.lineTo(110, 20);
      // ctx.lineTo(240, 130);
      // // ctx.translate(vw,vh);
      //   ctx.rotate(((2 * Math.PI) / 60) * time.getSeconds() + ((2 * Math.PI) / 60000) * time.getMilliseconds());
      //   ctx.translate(105, 0);
      // ctx.lineTo(60, 130);
      // ctx.lineTo(190, 20);
      // ctx.lineTo(270, 90);
      // ctx.closePath();

      // // Fill path
      // // ctx.stroke();
      // ctx.fill();
      // // ctx.fillStyle = 'green';
      // // ctx.fill(region, 'evenodd');




      // Earth
      ctx.save();
      // ctx.strokeStyle = "red";
      ctx.beginPath();
      ctx.moveTo(0, 0);
      // ctx.translate(150, 150);
      // ctx.rotate(((2 * Math.PI) / 60) * time.getSeconds() + ((2 * Math.PI) / 60000) * time.getMilliseconds());
      // ctx.translate(105, 0);
      intersection(point1);
      ctx.lineTo(0, 0);
      // ctx.fill();
      ctx.stroke();
      ctx.restore();

      ctx.save();
      // ctx.strokeStyle = "red";
      // ctx.translate(200, 600);
      // ctx.rotate(((2 * Math.PI) / 60) * time.getSeconds() + ((2 * Math.PI) / 60000) * time.getMilliseconds());
      // ctx.translate(60, 0);
      intersection(point2);
      ctx.lineTo(0, 0);
      // ctx.fill();
      ctx.stroke();
      ctx.restore();


      // Earth2
      ctx.save();
      // ctx.strokeStyle = "green";
        ctx.beginPath();
        ctx.moveTo(0, 0);
      // ctx.translate(500, 200);
      // ctx.rotate(((2 * Math.PI) / 60) * time.getSeconds() + ((2 * Math.PI) / 60000) * time.getMilliseconds());
      // ctx.translate(105, 0);
      intersection(point3);
      ctx.lineTo(0, 0);
        // ctx.closePath();
      ctx.restore();

      ctx.save();
      // ctx.strokeStyle = "green";
      // ctx.translate(150, 150);
      // ctx.rotate(((2 * Math.PI) / 60) * time.getSeconds() + ((2 * Math.PI) / 60000) * time.getMilliseconds());
      // ctx.translate(105, 0);
      intersection(point1);
      ctx.lineTo(0, 0);
        // ctx.closePath();
      ctx.fill();
      ctx.restore();


      // Earth3      
      ctx.save();
      // ctx.strokeStyle = "blue";
        // ctx.lineTo(0, 0);
        ctx.lineTo(0, vh);
      // ctx.translate(200, 600);
      // ctx.rotate(((2 * Math.PI) / 60) * time.getSeconds() + ((2 * Math.PI) / 60000) * time.getMilliseconds());
      // ctx.translate(60, 0);
      intersection(point2);
      ctx.lineTo(0, 0);
      ctx.fillStyle = 'rgba(0, 0, 0, 0.5)';
      ctx.fill();
      ctx.restore();

      ctx.save();
      // ctx.strokeStyle = "blue";
      // ctx.translate(500, 200);
      // ctx.rotate(((2 * Math.PI) / 60) * time.getSeconds() + ((2 * Math.PI) / 60000) * time.getMilliseconds());
      // ctx.translate(105, 0);
      intersection(point3);
      ctx.lineTo(0, 0);
      ctx.fillStyle = 'rgba(0, 0, 0, 0.2)';
      ctx.fill();
      ctx.restore();


      // Earth4
      ctx.save();
      // ctx.strokeStyle = "orange";
      ctx.beginPath();
      ctx.moveTo(vw, vh);
      // ctx.translate(900, 500);
      // ctx.rotate(((2 * Math.PI) / 60) * time.getSeconds() + ((2 * Math.PI) / 60000) * time.getMilliseconds());
      // ctx.translate(105, 0);
      intersection(point4);
      ctx.lineTo(0, 0);
      ctx.fill();
      ctx.restore();

      ctx.save();
      // ctx.strokeStyle = "orange";
      ctx.lineTo(vw, 0);
      // ctx.translate(500, 200);
      // ctx.rotate(((2 * Math.PI) / 60) * time.getSeconds() + ((2 * Math.PI) / 60000) * time.getMilliseconds());
      // ctx.translate(105, 0);
      intersection(point3);
      ctx.lineTo(0, 0);
      // ctx.closePath();
      ctx.fill();
      ctx.restore();

      ctx.save();
      // ctx.strokeStyle = "orange";
      // ctx.translate(900, 500);
      // ctx.rotate(((2 * Math.PI) / 60) * time.getSeconds() + ((2 * Math.PI) / 60000) * time.getMilliseconds());
      // ctx.translate(105, 0);
      intersection(point4);
      ctx.lineTo(0, 0);
      ctx.fill();
      ctx.restore();

      ctx.save();
      // ctx.strokeStyle = "orange";
      // ctx.translate(200, 600);
      // ctx.rotate(((2 * Math.PI) / 60) * time.getSeconds() + ((2 * Math.PI) / 60000) * time.getMilliseconds());
      // ctx.translate(60, 0);
      intersection(point2);
      ctx.lineTo(0, 0);
      ctx.closePath();
      ctx.fill();
      ctx.restore();
    }

    function headerLoop() {
      setTimeout(function() {
        window.requestAnimationFrame(draw);
          headerLoop();
      }, 100)
    }
    headerLoop();


    // ctx.closePath();
    // ctx.stroke();

    // Canvas
    // https://developer.mozilla.org/de/docs/Web/API/CanvasRenderingContext2D
    // https://developer.mozilla.org/de/docs/Web/API/CanvasRenderingContext2D/createLinearGradient
    // https://developer.mozilla.org/de/docs/Web/API/CanvasRenderingContext2D/fill
    // https://wiki.selfhtml.org/wiki/JavaScript/Canvas/Stile_und_Farben

    // greensock animationen
    // https://greensock.com/forums/topic/14879-greensock-canvas-animate/

    // clip-path polygon
    // https://developer.mozilla.org/en-US/docs/Web/CSS/basic-shape

    // animation idee
    // https://www.shutterstock.com/de/video/clip-31850140-abstract-triangle-geometric-surface-loop-1d-yellow
    // https://www.shutterstock.com/de/video/clip-1013590274-loopable-abstract-yellow-low-poly-3d-surface
  },
}
</script>

<style lang="scss">
#wrapper-header {
  background-color: #252934;
  height: 100vh;
  width: 100%;
  overflow: hidden;
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;

  canvas {
    height: 100%;
    width: 100%;
  }

  .icon-position {
    bottom: 10vh;
    position: absolute;
    transform: rotate(180deg);
  }

  .content-header {
    color: white;
    font-size: 2em;
    font-weight: bold;

    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    position: absolute;
    overflow: hidden;
    letter-spacing: 0.1em;
    line-height: 2em;
    text-transform: uppercase;

    .text {
      transform: scaleY(1.6);
    }

    h1 {
      display: flex;
      flex-direction: column;
      align-items: center;
      font-size: 1em;
      padding: 52px 62px;
      overflow: hidden;

      .and {
        margin: -0.2rem 0 2.8rem;
        &::after {
          content: '';
          display: block;
          border-bottom: 2px solid white;
          margin: -5px auto;
          width: 64%;
        }
      }
    }

    .header-me {
      background-color: #fff;
      color: #000;
      mix-blend-mode: screen;

      display: flex;
      justify-content: center;
      align-items: center;
      padding: 24px 41px;
      overflow: hidden;
    }
  }

  // @keyframes blur {
  //   from {
  //     filter: blur(0px);
  //   }
  //   to {
  //     filter: blur(5px);
  //   }
  // }



  // Mixin for shadow button with block sliding up
  @mixin btn-border-slide($color, $borderWidth, $time, $delay) {
    background-repeat: no-repeat;
    background-image:   linear-gradient(to right, $color 100%, $color 100%),
                        linear-gradient(to bottom, $color 100%, $color 100%),
                        linear-gradient(to right, $color 100%, $color 100%),
                        linear-gradient(to bottom, $color 100%, $color 100%);
    background-size:    100% $borderWidth,
                        $borderWidth 0%,
                        100% $borderWidth,
                        $borderWidth 100%;
    background-position:    0 0,
                            100% 0,
                            100% 100%,
                            0 100%;
    animation: bg $time $delay linear backwards;

    @keyframes bg {
      0% {
          background-size:    0 $borderWidth,
                              $borderWidth 0,
                              0 $borderWidth,
                              $borderWidth 0;
      }
      15% {
          background-size:    0% $borderWidth,
                              $borderWidth 0%,
                              100% $borderWidth,
                              $borderWidth 0;
      }
      25% {
          background-size:    0% $borderWidth,
                              $borderWidth 0%,
                              100% $borderWidth,
                              $borderWidth 100%;
      }
      30% {
          background-size:    25% $borderWidth,
                              $borderWidth 0%,
                              100% $borderWidth,
                              $borderWidth 100%;
      }
      50% {
          background-size:    65% $borderWidth,
                              $borderWidth 0%,
                              100% $borderWidth,
                              $borderWidth 100%;
      }
      70% {
          background-size:    90% $borderWidth,
                              $borderWidth 0%,
                              100% $borderWidth,
                              $borderWidth 100%;
      }
      100% {
          background-size:    100% $borderWidth,
                              $borderWidth 0%,
                              100% $borderWidth,
                              $borderWidth 100%;
      }
    }
  }

  @mixin btn-border-slide-mobile($color, $borderWidth, $time, $delay) {
    background-repeat: no-repeat;
    background-image:   linear-gradient(to right, $color 100%, $color 100%),
                        linear-gradient(to bottom, $color 100%, $color 100%),
                        linear-gradient(to right, $color 100%, $color 100%),
                        linear-gradient(to bottom, $color 100%, $color 100%);
    background-size:    100% $borderWidth,
                        $borderWidth 100%,
                        0% $borderWidth,
                        $borderWidth 100%;
    background-position:    0 0,
                            100% 0,
                            100% 100%,
                            0 100%;
    animation: bg $time $delay linear backwards;

    @keyframes bg {
      0% {
          background-size:    0 $borderWidth,
                              $borderWidth 0,
                              0 $borderWidth,
                              $borderWidth 0;
      }
      15% {
          background-size:    0% $borderWidth,
                              $borderWidth 0%,
                              0% $borderWidth,
                              $borderWidth 100%;
      }
      25% {
          background-size:    100% $borderWidth,
                              $borderWidth 0%,
                              0% $borderWidth,
                              $borderWidth 100%;
      }
      30% {
          background-size:    100% $borderWidth,
                              $borderWidth 25%,
                              0% $borderWidth,
                              $borderWidth 100%;
      }
      50% {
          background-size:    100% $borderWidth,
                              $borderWidth 65%,
                              0% $borderWidth,
                              $borderWidth 100%;
      }
      70% {
          background-size:    100% $borderWidth,
                              $borderWidth 90%,
                              0% $borderWidth,
                              $borderWidth 100%;
      }
      100% {
          background-size:    100% $borderWidth,
                              $borderWidth 100%,
                              0% $borderWidth,
                              $borderWidth 100%;
      }
    }
  }

  .btn {
    @include btn-border-slide-mobile(white, 0.2em, 2s, 1.6s);

    @media only screen and (min-width: 782px) {
      @include btn-border-slide(white, 0.2em, 2s, 1.6s);
    }
  }
}
</style>
