<?php session_start()?>
<!DOCTYPE html>
<html>
  <head>
  <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.css" rel="stylesheet"/>
 
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300&display=swap" rel="stylesheet">
    
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/png" sizes="16x16" href="assets/img/favicon.ico">
    
    
    <link rel="stylesheet" href="assets/css/logout.css">
    <script src="jquery-2.1.4.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/css/logout.css" />
  </head>
  <body>
      <?php 
    include 'lib/config.php';
    echo '<div class="content">';
    echo '  <img src="https://picsum.photos/300/300/?random" />';
    echo '</div>';
  
    echo '
    <div class="loader-wrapper">';
    echo '
      <span class="loader"><span class="loader-inner"></span></span>';
    echo'</div>';
  
    
        unset($_SESSION['username']);
        session_destroy();
        session_write_close();
        
        header("Location: login.php");
        exit();
    ?>
    <script>
        $(window).on("load",function(){
          $(".loader-wrapper").fadeOut("slow");
        });
    </script>
  </body>
</html>