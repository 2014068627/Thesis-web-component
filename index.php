<html>
<head>
  <link rel="stylesheet" type="text/css" href="includes/css/index.css">
</head>
<body>

  <video preload="auto" autoplay="true" loop="loop">
    <source src="includes/src/main_x264.mp4" type="video/mp4" />
    <source src="includes/src/main_VP8.webm" type="video/webm" />
    <source src="includes/src/main_libtheora.ogv" type="video/ogv" />
  </video>
  <br><br><br>
  <div class="container"><br><br><br><br>
    <form action="login.php" method="POST">
      <img src="includes/src/logo.png"/><span>LIGHTS AND SOCKETS</span><br>
      <input class="input" type="text" name="username" placeholder="USERNAME" required>
      <br><br>
      <input class="input" type="password" name="password" placeholder="PASSWORD" required>
      <br><br>
      <input id="submit" type="submit" value="LOGIN">
    </form>
  </div>

</body>
</html>
