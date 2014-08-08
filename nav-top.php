<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
    <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="http://webdesignby.com/programming">webdesignby.com/programming</a>
  </div>
    <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="<?php echo isset($menu1_class)?$menu1_class:""; ?>"><a href="qr_code.php">Generate QR Code</a></li>
            <li class="<?php echo isset($menu2_class)?$menu2_class:"";?>"><a href="authenticate.php">Authenticate</a></li>
          </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>