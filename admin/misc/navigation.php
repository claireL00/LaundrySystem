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
 
            <!-- Change "Site Admin" to your site name -->
            <a class="navbar-brand" href="<?php echo $home_url; ?>admin/index.php">LAUNDRY SYSTEM</a>
        </div>
 
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
 
 
                <!-- highlight for order related pages -->
                <li <?php echo $page_title=="Admin Index" ? "class='active'" : ""; ?>>
                    <a href="<?php echo $home_url; ?>admin/index.php">Home</a>
                </li>
                
 
                <!-- highlight for user related pages -->
                <li <?php
                        echo $page_title=="Users" ? "class='active'" : ""; ?> >
                    <a href="<?php echo $home_url; ?>admin/read_users.php">Users</a>
                </li>

                <!-- highlight for order related pages -->
                <li <?php echo $page_title=="Job Orders" ? "class='active'" : ""; ?>>
                    <a href="<?php echo $home_url; ?>admin/orders.php">Job Orders</a>
                </li>

                <!-- highlight for laundry categories related pages -->
                <li <?php echo $page_title=="Laundry Categories" ? "class='active'" : ""; ?>>
                    <a href="<?php echo $home_url; ?>admin/laundryCategories.php">Laundry Categories</a>
                </li>

                <!-- highlight for laundry categories related pages -->
                <li <?php echo $page_title=="Reports-PDF" ? "class='active'" : ""; ?>>
                    <a href="<?php echo $home_url; ?>admin/reportsPDF.php">Reports-PDF</a>
                </li>
            </ul>

            
 
            <!-- options in the upper right corner of the page -->
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                          <?php echo $_SESSION['firstname']; ?>
                          <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <!-- log out user -->
                        <li><a href="<?php echo $home_url; ?>logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
 
        </div><!--/.nav-collapse -->
 
    </div>
</div>
<!-- /navbar -->