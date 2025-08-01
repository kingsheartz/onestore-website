<!DOCTYPE html>
<html>

<head>
  <title>BAD REQUEST || ONESTORE</title>
  <!-- SCRIPTS GOES HERE OR IN HEAD -->
  <link href="../../../../images/logo/favicon.png" rel="icon" />
  <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
  <script src="../../../../js/jquery-1.11.1.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
</head>
<style type="text/css">
  @media(min-width: 851px) {
    #image {
      height: auto;
      width: 400px;
    }
  }

  @media(max-width: 850px) {

    #image {
      height: auto;
      width: 380px;
    }
  }

  @media(max-width: 567px) {

    #image {
      height: auto;
      width: 350px;
    }

    .main-footer {
      text-align: center;
    }
  }

  @media(max-width: 400px) {

    #image {
      height: 120px;
      width: 300px;
    }

  }

  @media(max-width: 330px) {

    #image {
      height: auto;
      width: 200px;
    }

  }


  @import url(https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300);


  .wordsearch {
    z-index: 1;
    background-color: #335B67;
    background: -ms-radial-gradient(ellipse at center, #335B67 0%, #2C3E50 100%) fixed no-repeat;
    background: -moz-radial-gradient(ellipse at center, #335B67 0%, #2C3E50 100%) fixed no-repeat;
    background: -o-radial-gradient(ellipse at center, #335B67 0%, #2C3E50 100%) fixed no-repeat;
    background: -webkit-gradient(radial, center center, 0, center center, 497, color-stop(0, #335B67), color-stop(1, #2C3E50));
    background: -webkit-radial-gradient(ellipse at center, #335B67 0%, #2C3E50 100%) fixed no-repeat;
    background: radial-gradient(ellipse at center, #335B67 0%, #2C3E50 100%) fixed no-repeat;
    font-family: 'Source Sans Pro', sans-serif;
    -webkit-font-smoothing: antialiased;
    margin: 0px;
  }

  ::selection {
    background-color: rgba(0, 0, 0, 0.2);
  }

  ::-moz-selection {
    background-color: rgba(0, 0, 0, 0.2);
  }

  .four_zero_four_bg {

    background-image: url(dribbble_1.gif);
    height: 400px;
    background-position: center;
  }


  a {
    color: white;
    text-decoration: none;
    border-bottom: 1px solid rgba(255, 255, 255, 0.5);
    transition: all 0.5s ease;
    -moz-transition: all 0.5s ease;
    -o-transition: all 0.5s ease;
    -webkit-transition: all 0.5s ease;
    margin-right: 10px;
  }

  a:last-child {
    margin-right: 0px;
  }

  a:hover {
    text-shadow: 0px 0px 1px rgba(255, 255, 255, .5);
    border-bottom: 1px solid rgba(255, 255, 255, 1);
  }

  #noscript-warning {
    width: 100%;
    text-align: center;
    background-color: rgba(0, 0, 0, 0.2);
    font-weight: 300;
    color: white;
    padding-top: 10px;
    padding-bottom: 10px;
  }



  /* === WRAP === */

  #wrap {
    width: 80%;
    max-width: 1400px;
    margin: 0 auto;
    height: auto;
    position: relative;
    margin-top: 8%;
  }



  /* === MAIN TEXT CONTENT === */

  #main-content {
    float: right;
    max-width: 45%;
    color: white;
    font-weight: 300;
    font-size: 18px;
    padding-bottom: 40px;
    line-height: 28px;
  }

  #main-content h1 {
    margin: 0px;
    font-weight: 400;
    font-size: 42px;
    margin-bottom: 40px;
    line-height: normal;
  }



  /* === NAVIGATION BUTTONS === */

  #navigation {
    margin-top: 2%;
  }

  #navigation a.navigation {
    display: block;
    float: left;
    background-color: rgba(0, 0, 0, 0.2);
    padding-left: 15px;
    padding-right: 15px;
    color: white;
    height: 41px;
    line-height: 41px;
    text-decoration: none;
    font-size: 16px;
    transition: all 0.5s ease;
    -moz-transition: all 0.5s ease;
    -o-transition: all 0.5s ease;
    -webkit-transition: all 0.5s ease;
    margin-right: 2%;
    margin-bottom: 2%;
    border-bottom: none;
  }

  #navigation a.navigation i {
    line-height: 41px;
  }

  #navigation a.navigation:hover {
    background-color: rgba(26, 188, 156, 0.7);
    border-bottom: none;
  }



  /* === WORDSEARCH === */

  #wordsearch {
    width: 45%;
    float: left;
  }

  #wordsearch ul {
    margin: 0px;
    padding: 0px;

  }

  #wordsearch ul li {
    float: left;
    width: 12%;
    background-color: #335B67;
    list-style: none;
    margin-right: 0.5%;
    margin-bottom: 0.5%;
    padding: 0;
    display: block;
    text-align: center;
    color: rgba(255, 255, 255, 0.7);
    text-transform: uppercase;
    overflow: hidden;
    font-size: 24px;
    font-size: 1.6vw;
    font-weight: 300;
    transition: background-color 0.75s ease;
    -moz-transition: background-color 0.75s ease;
    -webkit-transition: background-color 0.75s ease;
    -o-transition: background-color 0.75s ease;
  }

  #wordsearch ul li.selected {
    background-color: rgba(26, 188, 156, 0.7);
    color: rgba(255, 255, 255, 1);
    font-weight: 400;
  }



  /* === SEARCH FORM === */

  #search {
    margin-top: 30px;
  }

  #search input[type='text'] {
    width: 88%;
    height: 41px;
    padding-left: 15px;
    padding-rigt: 15px;
    box-sizing: border-box;
    -moz-box-sizing: border-box;
    background-color: rgba(0, 0, 0, 0.2);
    border: none;
    outline: none;
    -webkit-appearance: none;
    font-size: 16px;
    font-weight: 300;
    color: white;
    font-family: 'Source Sans Pro', sans-serif;
    transition: all 0.5s ease;
    -moz-transition: all 0.5s ease;
    -o-transition: all 0.5s ease;
    -webkit-transition: all 0.5s ease;
    border-radius: 0px;
  }

  #search .input-search {
    width: 10%;
    float: right;
    height: 41px;
    background-color: rgba(0, 0, 0, 0.2);
    outline: none;
    border: none;
    -webkit-appearance: none;
    font-family: 'Source Sans Pro', sans-serif;
    color: white;
    font-weight: 300;
    font-size: 16px;
    cursor: pointer;
    transition: all 0.5s ease;
    -moz-transition: all 0.5s ease;
    -o-transition: all 0.5s ease;
    -webkit-transition: all 0.5s ease;
    text-align: center;
  }

  #search .input-search:hover {
    background-color: rgba(26, 188, 156, 0.7);
  }


  /* === RESPONSIVE CSS === */

  @media all and (max-width: 899px) {
    #wrap {
      width: 90%;
    }
  }

  @media all and (max-width: 799px) {
    #wrap {
      width: 90%;
      height: auto;
      margin-top: 40px;
      top: 0%;
    }

    #wordsearch {
      width: 90%;
      float: none;
      margin: 0 auto;
    }

    #wordsearch ul li {
      font-size: 4vw;
    }

    #main-content {
      float: none;
      width: 90%;
      max-width: 90%;
      margin: 0 auto;
      margin-top: 30px;
      text-align: justify;
    }

    #main-content h1 {
      text-align: left;
    }

    #search input[type='text'] {
      width: 84%;
    }

    #search .input-search {
      width: 15%;
    }
  }

  @media all and (max-width: 499px) {
    #main-content h1 {
      font-size: 28px;
    }
  }
</style>

<body style="overflow-x: hidden;">

  <div class="row" style="display:flex;justify-content: center;align-items: center;margin: 0;">
    <center id="logo">

      <img id="image" src="../../../../images/logo/logost.svg">


    </center>
  </div>
  <div class="row" style="width:100%;background-color: white;padding:0px;margin: 0px; ">
    <section class="page_404">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 ">
            <div class="col-sm-10 col-sm-offset-1  text-center">
              <div class="four_zero_four_bg">
                <h1 class="text-center "></h1>
              </div>
              <!-- Main content -->
              <section class="content" style="margin-bottom: -20px">
                <div class="error-page">
                  <div class="error-content">
                    <h3><i class="fas fa-exclamation-triangle text-danger"></i> 400 Bad Request.</h3>
                    <!--
      <br>
      <h5 style="text-align: left;">
      We could not find the page you were looking for.
      Meanwhile, you may return to <a href="../../../../index.php" style="color:#007BFF ">Home Page</a>or try to <a style="color:#007BFF " href="../../../../login.php">Logging in</a> .
      </h5>
-->

                  </div>
                  <!-- /.error-content -->
                </div>
                <!-- /.error-page -->
              </section>
              <!-- /.content -->
            </div>
          </div>
        </div>
      </div>
    </section>


  </div>
  <div id="wrap">
    <div id="wordsearch">
      <ul>
        <li>k</li>

        <li>v</li>

        <li>b</li>

        <li>n</li>

        <li>i</li>

        <li>x</li>

        <li>m</li>

        <li>e</li>

        <li>t</li>


        <li>w</li>

        <li>y</li>

        <li>v</li>

        <li class="one">4</li>

        <li class="two">0</li>

        <li class="three">0</li>

        <li>y</li>

        <li>o</li>

        <li>a</li>

        <li>k</li>

        <li>x</li>

        <li>r</li>

        <li>O</li>

        <li>q</li>

        <li>y</li>

        <li>e</li>

        <li>h</li>

        <li class="five">b</li>

        <li class="six">a</li>

        <li class="seven">d</li>

        <li>R</li>

        <li>y</li>

        <li>y</li>

        <li>e</li>

        <li>h</li>

        <li>R</li>

        <li>y</li>

        <li>y</li>

        <li>e</li>

        <li>h</li>

        <li>e</li>

        <li>h</li>

        <li class="eight">r</li>

        <li class="nine">e</li>

        <li class="ten">q</li>

        <li class="eleven">u</li>

        <li class="twelve">e</li>

        <li class="thirteen">s</li>

        <li class="fourteen">t</li>

        <li>s</li>

        <li>c</li>

        <li>e</li>

        <li>w</li>

        <li>v</li>

        <li>x</li>

        <li>e</li>

        <li>e</li>

        <li>c</li>

        <li>f</li>

        <li>h</li>

        <li>q</li>

        <li>e</li>

        <li>w</li>

        <li>t</li>

        <li>r</li>

      </ul>
    </div>

    <div id="main-content" style="color: #335B67">
      <h1>We couldn't establish a connection.</h1>

      <p>Unfortunately the page you were looking for is considered as Bad Request.</p>

      <p>Please try again with another URL or Go to <a href="../../../../onestore.php"
          style="color:#007BFF;;font-weight: bold;">Home Page</a>or try to <a style="color:#007BFF;font-weight: bold;"
          href="../../../../login.php">Log in</a> .</p>

    </div>
  </div>

  <br>

  <script type="text/javascript">
    $(function () {
      var liWidth = $("li").css("width");
      $("li").css("height", liWidth);
      $("li").css("lineHeight", liWidth);
      var totalHeight = $("#wordsearch").css("width");
      $("#wordsearch").css("height", totalHeight);
    });
    causeRepaintsOn = $("h1, h2, h3, p");
    $(window).resize(function () {
      causeRepaintsOn.css("z-index", 1);
    });
    $(window).on('resize', function () {
      var liWidth = $(".one").css("width");
      $("li").css("height", liWidth);
      $("li").css("lineHeight", liWidth);
      var totalHeight = $("#wordsearch").css("width");
      $("#wordsearch").css("height", totalHeight);
    });



    $(document).ready(function () {
      /* 4 */
      $(this).delay(1500).queue(function () {
        $(".one").addClass("selected");
        $(this).dequeue();
      })
        /* 0 */
        .delay(500).queue(function () {
          $(".two").addClass("selected");
          $(this).dequeue();
        })
        /* 4 */
        .delay(500).queue(function () {
          $(".three").addClass("selected");
          $(this).dequeue();
        })
        /* P */
        .delay(500).queue(function () {
          $(".four").addClass("selected");
          $(this).dequeue();
        })
        /* A */
        .delay(500).queue(function () {
          $(".five").addClass("selected");
          $(this).dequeue();
        })
        /* G */
        .delay(500).queue(function () {
          $(".six").addClass("selected");
          $(this).dequeue();
        })
        /* E */
        .delay(500).queue(function () {
          $(".seven").addClass("selected");
          $(this).dequeue();
        })
        /* N */
        .delay(500).queue(function () {
          $(".eight").addClass("selected");
          $(this).dequeue();
        })
        /* O */
        .delay(500).queue(function () {
          $(".nine").addClass("selected");
          $(this).dequeue();
        })
        /* T */
        .delay(500).queue(function () {
          $(".ten").addClass("selected");
          $(this).dequeue();
        })
        /* F */
        .delay(500).queue(function () {
          $(".eleven").addClass("selected");
          $(this).dequeue();
        })
        /* O */
        .delay(500).queue(function () {
          $(".twelve").addClass("selected");
          $(this).dequeue();
        })
        /* U */
        .delay(500).queue(function () {
          $(".thirteen").addClass("selected");
          $(this).dequeue();
        })
        /* N */
        .delay(500).queue(function () {
          $(".fourteen").addClass("selected");
          $(this).dequeue();
        })
        /* D */
        .delay(500).queue(function () {
          $(".fifteen").addClass("selected");
          $(this).dequeue()
        });
    });


  </script>
</body>

</html>