<?php
require "head.php";
?>

<body onload="show_func()">
  <div class="wrapper">
    <?php
    include "head1.php";
    ?>
    <script type="text/javascript">
      $('li').removeClass('active');
      $('#chatphp').addClass('active');
    </script>
    <script type="text/javascript">
      $("#chatphp").click(
      );
    </script>
    <?php
    require 'pdo.php';
    if (isset($_POST['status'])) {
      $sql = "UPDATE chats SET stat=1 where rname='" . $_SESSION['username'] . "' AND uname='admin'";
      $st = $pdo->prepare($sql);
      $st->execute();
    }
    if (isset($_POST['submit'])) {
      /* Attempt MySQL server connection. Assuming
      you are running MySQL server with default
      setting (user 'root' with no password) */
      // Escape user inputs for security
      $un = $_REQUEST['uname'];
      $rn = $_REQUEST['rname'];
      $m = $_REQUEST['msg'];
      date_default_timezone_set('Asia/Kolkata');
      $ts = date('y-m-d h:ia');
      $data = array(
        ':uname' => $un,
        ':rname' => $rn,
        ':msg' => $m,
        ':dt' => $ts
      );
      // Attempt insert query execution
      $sql = "INSERT INTO chats (uname,rname, msg, dt)
    VALUES (:uname,:rname, :msg, :dt)";
      $st = $pdo->prepare($sql);
      $st->execute($data);
      if ($st) {
      } else {
        echo "ERROR: Message not sent!!!";
      }
      // Close connection
    }
    ?>
    <style>
      #chat-cont {
        height: 500px;
        background: white;
        margin: 0 auto;
        font-size: 0;
        border-radius: 5px;
        overflow: hidden;
      }

      main {
        width: 100%;
        height: 500px;
        display: inline-block;
        font-size: 15px;
        vertical-align: top;
      }

      main header {
        height: 70px;
        background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #360c88), color-stop(1, #6f0c79)) !important;
      }

      main header>* {
        vertical-align: top;
        width: 100%;
        padding: .7rem 1rem;
        margin: 0;
        display: flex;
        -webkit-box-align: start;
        align-items: flex-start;
        height: 70px;
      }

      main header img:first-child {
        width: 24px;
        margin-top: 8px;
      }

      main header img:last-child {
        width: 24px;
        margin-top: 8px;
      }

      main header h4 {
        margin-top: 5px;
        text-align: center;
        color: #FFFFFF;
        font-size: 20px;
        display: block;
        padding-left: .5rem !important;
        padding-right: .5rem !important;
        align-self: center !important;
        margin-bottom: .5rem;
      }

      main .inner_div {
        padding-left: 0;
        margin: 0;
        list-style-type: none;
        position: relative;
        overflow: auto;
        height: 330px;
        background: url(images/backgr.jpg);
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        position: relative;
        border-top: 2px solid #fff;
        border-bottom: 2px solid #fff;
      }

      main .triangle {
        width: 0;
        height: 0;
        border-style: solid;
        border-width: 0 8px 8px 8px;
        border-color: transparent transparent #58b666 transparent;
        margin-left: 5px;
        clear: both;
        transform: rotate(270deg);
        position: relative;
        top: 13px;
      }

      main .message {
        padding: 10px;
        float: left;
        min-width: 100px;
        max-width: 200px;
        color: #000;
        margin-left: 15px;
        background-color: #58b666;
        position: relative;
        display: -webkit-inline-box;
        text-align: left;
        border-radius: 5px;
        clear: both;
        padding-bottom: 20px;
      }

      main .triangle1 {
        width: 0;
        height: 0;
        border-style: solid;
        border-width: 0 8px 8px 8px;
        border-color: transparent transparent #ff9800 transparent;
        margin-right: 5px;
        float: right;
        clear: both;
        position: relative;
        top: 13px;
        transform: rotate(90deg);
      }

      main .message1 {
        padding: 10px;
        padding-bottom: 20px;
        min-width: 100px;
        max-width: 200px;
        margin-right: 15px;
        background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #ff9800), color-stop(1, #ff9800)) !important;
        float: right;
        position: relative;
        display: -webkit-inline-box;
        text-align: left;
        border-radius: 5px;
        clear: both;
      }

      main footer {
        height: 100px;
        padding: 20px 30px 10px 20px;
        background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #360c88), color-stop(1, #6f0c79)) !important;
      }

      main footer textarea {
        outline: none;
        float: left;
        height: 50px;
        border-radius: 100px;
        padding-right: 100px;
        white-space: pre-wrap;
      }

      #myBtn {
        position: absolute;
        margin-left: 2%;
        border-radius: 5px;
        background: dodgerblue;
        border: none;
        color: white;
        border-radius: 50%;
        font-size: 24px;
        padding: 8px;
        float: right;
        padding-right: 15px;
        padding-left: 15px;
        right: 20px;
      }

      #myBtn:disabled {
        background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #360c88), color-stop(1, #1a001d)) !important;
        color: white;
      }

      .date {
        background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #2f2a2a), color-stop(1, #3c3636)) !important;
        clear: both;
        color: #fff;
        position: relative;
        margin: auto;
        display: block;
        width: 300px;
        text-align: center;
        border-radius: 5px;
        padding: 2px;
      }

      .navbar-toggle .icon-bar {
        background-color: #00AF6F;
        width: 30px;
        height: 4px;
      }

      .fa-user-circle-o {
        margin-right: 12px;
        color: #fff;
        font-size: 50px;
      }

      #myNavbar2>.connect:focus,
      #myNavbar2>.connect:hover,
      #myNavbar2>.connect:active {
        text-decoration: none;
        background-color: #E5E5E5;
        border-left: 4px solid #FF9600;
        border-right: 4px solid #FF9600;
      }

      #myNavbar2>.connect:focus i,
      #myNavbar2>.connect:hover i {
        color: black;
      }

      #myNavbar2 {
        width: 100%;
        padding-right: 0;
        padding-left: 0;
      }

      #contact>.navbar-toggle {
        position: absolute;
        right: 0;
      }

      div#message::first-line {
        line-height: 0;
      }

      div#message1::first-line {
        line-height: 0;
      }

      .clear-fix {
        clear: both;
      }

      pre {
        background: transparent;
        border: none;
        color: white;
        padding: 0;
        margin: 0;
        white-space: pre-wrap;
        /* Since CSS 2.1 */
        white-space: -moz-pre-wrap;
        /* Mozilla, since 1999 */
        white-space: -pre-wrap;
        /* Opera 4-6 */
        white-space: -o-pre-wrap;
        /* Opera 7 */
        word-wrap: break-word;
      }

      span.conimg {
        position: relative;
      }

      .dark,
      .dark * {
        background: #222;
        color: #e6e6e6;
        border-color: #e6e6e6;
      }

      .switch {
        align-self: flex-end;
        margin: 0.9375rem;
      }

      .inner-switch {
        display: inline-block;
        cursor: pointer;
        border: 1px solid #555;
        border-radius: 1.25rem;
        width: 3.125rem;
        text-align: center;
        font-size: 1rem;
        padding: 0.1875rem;
        margin-left: 0.3125rem;
      }

      .dark main header,
      .dark main footer {
        background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #aaaaad), color-stop(1, #676767)) !important;
      }

      .dark #myNavbar2>.connect:focus,
      .dark #myNavbar2>.connect:hover,
      .dark #myNavbar2>.connect:active {
        text-decoration: none;
        background-color: transparent;
        border-left: 4px solid #FF9600;
        border-right: 4px solid #FF9600;
      }

      .dark #myNavbar2>.connect:focus i,
      .dark #myNavbar2>.connect:hover i {
        color: #ff9800;
      }

      .dark .uppernum3 {
        background: #0020ff;
      }

      .dark div#chat-head,
      .dark h4,
      .dark .conimg,
      .dark .conimg i,
      .dark span,
      .dark span i,
      .dark h6,
      .dark button i,
      .dark main .triangle,
      .dark main .triangle1,
      .dark .spdat,
      .dark .spdat i,
      .dark pre {
        background: transparent;
      }

      .spdat {
        color: white;
        font-size: 10px;
        clear: both;
        position: absolute;
        bottom: 0;
        right: 5px;
      }

      .dark .switch {
        background: white;
        color: #000;
      }

      .dark .date {
        background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #000000), color-stop(1, #000000)) !important;
      }
    </style>
    <div id="chat">
      <div class="newhed">New Chats</div>
      <div class="switch">Dark mode:
        <button class="inner-switch">OFF</button>
      </div>
      <div id="contact" class="col-sm-3">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar2">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <div class="connect" style="background: #000000;text-align: center;">
          <span><i class="fa fa-user-circle-o
"></i></span>
          <h6 style="color:white;">CONTACTS</h6>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar2">
          <?php
          require "pdo.php";
          $query = $pdo->query("SELECT username FROM admin");
          $cn = 0;
          while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $cn++;
            $query1 = "SELECT COUNT(*) FROM chats WHERE uname='admin' AND rname='" . $_SESSION['username'] . "' AND stat=0";
            $statement1 = $pdo->prepare($query1);
            $statement1->execute();
            $row1 = $statement1->fetch(PDO::FETCH_ASSOC);
            ?>
            <div id="<?= $row['username'] ?>" class="connect" onclick="getfile('<?= $row['username'] ?>')">
              <span class="conimg"><i id="<?= $row['username'] ?><?= $cn ?>" class="fa fa-user-circle-o"></i> <span
                  class="uppernum3"><?= $row1['COUNT(*)'] ?></span></span>
              <h6>
                <?= $row['username'] ?>
              </h6>
            </div>
            <?php
          }
          ?>
        </div>
      </div>
      <div id="chat-cont" class="col-sm-9">
        <main>
          <header>
            <div id="chat-head">
              <?php
              if (isset($_GET['name'])) {
                $query1 = "SELECT username FROM admin where username = :name";
                $statement = $pdo->prepare($query1);
                $statement->execute(array(':name' => $_GET['name']));
                $row1 = $statement->fetch(PDO::FETCH_ASSOC);
                $_SESSION['name'] = $row1['username'];
                ?>
                <span class="conimg"><i class="fa fa-user-circle-o" style="color:white;"></i></span>
                <h4><?= $_SESSION['name'] ?></h4>
                <?php
              }
              ?>
            </div>
          </header>
          <script>
            $(document).ready(function () {
              var container = $('#chathist')[0];
              var containerHeight = container.clientHeight;
              var contentHeight = container.scrollHeight;
              container.scrollTop = container.scrollHeight - container.clientHeight;
              var pageRefresh = 5000; //5 s
              setInterval(function () {
                $('#chathist').load(location.href + " #chathist >");
                $('#myNavbar2').load(location.href + " #myNavbar2 >");
              }, pageRefresh);
            });
            function show_func() {
              var element = document.getElementById("chathist");
              element.scrollTop = element.scrollHeight;
            }
            function sub() {
              $('#myform').on("submit", function (e) {
                var dataString = new FormData(this);
                dataString.append('submit', '1');
                $.ajax({
                  type: "POST",
                  url: "message.php",
                  data: dataString,
                  contentType: false,
                  cache: false,
                  processData: false,
                  success: function () {
                    $('textarea').val('');
                  }
                });
                e.preventDefault();
              });
              return false;
            }
          </script>
          <form id="myform" method="POST">
            <div class="inner_div" id="chathist">
              <input type="hidden" id="rname" name="rname" value="admin">
              <input type="hidden" id="uname" name="uname" value="<?= $_SESSION['username'] ?>">
              <?php
              require 'pdo.php';
              $c = $_SESSION['username'];
              $query = "SELECT * FROM chats where (uname='$c' and rname='admin') or (uname='admin' and rname='$c')";
              $run = $pdo->query($query);
              $i = 0;
              $ct = 0;
              while ($row = $run->fetch(PDO::FETCH_ASSOC)):
                $date = explode(' ', $row['dt']);
                $date[0] = date("d-m-Y", strtotime($date[0]));
                if ($date[0] != $ct) {
                  $ct = date("d-m-Y", strtotime($date[0]));
                  ?>
                  <div class="clear-fix"></div><br><br>
                  <div class="date"><?= $ct ?></div><br><br>
                  <div class="clear-fix"></div><?php
                }
                if ($i == 0) {
                  $i = 5;
                  $first = $row;
                  ?>
                  <div id="triangle1" class="triangle1"></div>
                  <div id="message1" class="message1">
                    <div style="color: white;
    float: right;
    padding: 0;
    width: 100%;">
                      <pre><?php echo trim($row['msg']); ?></pre>
                    </div>
                    <div class="spdat">
                      <i style="font-size:16px;margin-right:4px" class="fa fa-clock"></i><?php echo $date[1]; ?>
                    </div>
                  </div>
                  <br /><br />
                  <?php
                } else {
                  if ($row['uname'] != $first['uname']) {
                    ?>
                    <div id="triangle" class="triangle"></div>
                    <div id="message" class="message">
                      <div style="color: white;
    float: right;
    padding: 0;
    width: 100%;">
                        <pre><?php echo trim($row['msg']); ?></pre>
                      </div>
                      <div class="spdat">
                        <i style="font-size:16px;margin-right:4px" class="fa fa-clock"></i><?php echo $date[1]; ?>
                      </div>
                    </div>
                    <br /><br />
                    <?php
                  } else {
                    ?>
                    <div id="triangle1" class="triangle1"></div>
                    <div id="message1" class="message1">
                      <div style="color: white;
    float: right;
    padding: 0;
    width: 100%;">
                        <pre><?php echo trim($row['msg']); ?></pre>
                      </div>
                      <div class="spdat">
                        <i style="font-size:16px;margin-right:4px" class="fa fa-clock"></i><?php echo $date[1]; ?>
                      </div>
                    </div>
                    <br /><br />
                    <?php
                  }
                }
              endwhile;
              ?>
            </div>
            <script type="text/javascript">
              function handleChange(e) {
                if (e.key === "Enter") {
                  setText(`${e.target.value}\n`);
                }
                setText(e.target.value);
              }
              function change() {
                console.log('helo');
                if ($.trim($("#chat-head").html()) == '') {
                  console.log('helo5656');
                  $('#myBtn').prop('disabled', true);
                  alert('please select a contact');
                  document.getElementById('textarea').value = '';
                  return false;
                }
                else if ($('#textarea').val() == '') {
                  console.log('helo5656');
                  $('#myBtn').prop('disabled', true);
                  return false;
                }
                else {
                  console.log('kildjfrekrh');
                  // $('#myBtn').removeAttr('disabled');
                  $('#myBtn').prop('disabled', false);
                  return true;
                }
              }
              function getfile(x) {
                console.log(x);
                $.ajax({
                  type: "POST",
                  url: "message.php?name=" + x,
                  data: { status: 1 },
                  success: function () {
                  }
                });
                location.href = "message.php?name=" + x;
              }
              if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
              }
            </script>
            <footer>
              <textarea class="col-sm-12" id="textarea" style="white-space: pre-line" wrap="hard" name="msg"
                onChange={handleChange} onkeyup="change()"></textarea>
              <button id="myBtn" disabled name="submit" type="submit">
                <i class="fa fa-arrow-right"></i></button>
            </footer>
          </form>
        </main>
      </div>
    </div>
    <?php
    require 'foot.php';
    ?>
    <script>
      $(".inner-switch").on("click", function () {
        if ($("#chat").hasClass("dark")) {
          $("#chat").removeClass("dark");
          $(".inner-switch").text("OFF");
        } else {
          $("#chat").addClass("dark");
          $(".inner-switch").text("ON");
        }
      });
    </script>