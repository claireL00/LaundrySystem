<!-- navbar -->
<div class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container-fluid">
 
        <div class="navbar-header">
            <!-- to enable navigation dropdown when viewed in mobile device -->
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
 
            <!-- Change "Your Site" to your site name -->
            <a class="navbar-brand" href="<?php echo $home_url; ?>">Laundry System</a>
        </div>
 
        <div class="navbar-collapse collapse">
          

    <ul class="nav navbar-nav navbar-right">
        <li <?php echo $page_title=="Login" ? "class='active'" : ""; ?>>
            <a href="<?php echo $home_url; ?>login">
                <span class="glyphicon glyphicon-log-in"></span> Log In
            </a>
        </li>
     
        <li <?php echo $page_title=="Register" ? "class='active'" : ""; ?>>
            <a href="<?php echo $home_url; ?>register">
                <span class="glyphicon glyphicon-check"></span> Register
            </a>
        </li>
    </ul>
    
             
        </div><!--/.nav-collapse -->
 
    </div>
</div>
<!-- /navbar -->