	<nav id="sidebar">
        <div class="user-panel">
       		<table>
        		<tr>
        			<td>
        				<?php  
        					$profile_picture == null ?
        					$profileElement = '<img class="img-circle img-responsive" width="56px" height="56px" src="images/user.jpg">':
        					$profileElement = '<img class="img-circle" width="56px" height="56px" src="'.$profile_picture.'">';
        					echo $profileElement;
        				?>
        			</td>
        			<td>
        				<h5 class="to-hide ellipse"><?php echo $first_name.' '.$last_name; ?> <br><span>
        				<?php 
        					if ($user_permissions == 1) {
        						echo "Admin";
        					}elseif($user_permissions == 2){
        						echo "Moderator";
        					}elseif($user_permissions == 3){
        						echo "Viewer";
        					}
        				 ?></span></h5>		
        			</td>
        		</tr>
        	</table>
        </div>
        <?php 
        if ($user_permissions == 4) {
        ?>
        	<div class="sidebar-links">
	        <div data-toggle="tooltip" data-placement="right" title="Dashboard">
	       		<a href="index.php" class="active-sidebar-link">
					<i class="fa fa-tachometer-alt"></i>
					<span class="to-hide">Dashboard <i class="fa fa-angle-right pull-right angle-icon"></i></span>
				</a>	        	
			</div>
			<div data-toggle="tooltip" data-placement="right" title="Blogs">
	       		<a href="blogs.php" class="">
					<i class="fas fa-rss"></i>
					<span class="to-hide">Blogs <i class="fa fa-angle-right pull-right angle-icon"></i></span>
				</a>	        	
			</div>
			<div data-toggle="tooltip" data-placement="right" title="Profile">
	       		<a href="profile.php" class="">
					<i class="far fa-user"></i>
					<span class="to-hide">Profile <i class="fa fa-angle-right pull-right angle-icon"></i></span>
				</a>	        	
			</div>
			<div data-toggle="tooltip" data-placement="right" title="Logout">
	       		<a href="logout.php">
					<i class="fa fa-sign-out-alt"></i>
					<span class="to-hide">Log out <i class="fa fa-angle-right pull-right angle-icon"></i></span>
				</a>        	
			</div>
        </div>
        <?php
        }else{
        ?>
        <div class="sidebar-links">
	        <div data-toggle="tooltip" data-placement="right" title="Dashboard">
	       		<a href="index.php" class="active-sidebar-link">
					<i class="fa fa-tachometer-alt"></i>
					<span class="to-hide">Dashboard <i class="fa fa-angle-right pull-right angle-icon"></i></span>
				</a>	        	
			</div>
			<div data-toggle="tooltip" data-placement="right" title="Commissions">
	       		<a href="commissions.php">
					<i class="fas fa-pound-sign"></i>
					<span class="to-hide">Commissions <i class="fa fa-angle-right pull-right angle-icon"></i></span>
				</a>	        	
			</div>
			<div data-toggle="tooltip" data-placement="right" title="Universities">
	       		<a href="universities.php">
					<i class="fas fa-university"></i>
					<span class="to-hide">Universities <i class="fa fa-angle-right pull-right angle-icon"></i></span>
				</a>	        	
			</div>
			<div data-toggle="tooltip" data-placement="right" title="Portals">
	       		<a href="portals.php">
					<i class="fas fa-window-restore"></i>
					<span class="to-hide">Portals <i class="fa fa-angle-right pull-right angle-icon"></i></span>
				</a>	        	
			</div>
			<div data-toggle="tooltip" data-placement="right" title="Users">
	       		<a href="users.php">
					<i class="fas fa-user-friends"></i>
					<span class="to-hide">Users <i class="fa fa-angle-right pull-right angle-icon"></i></span>
				</a>	        	
			</div>
			<div data-toggle="tooltip" data-placement="right" title="Profile">
	       		<a href="profile.php">
					<i class="far fa-user"></i>
					<span class="to-hide">Profile <i class="fa fa-angle-right pull-right angle-icon"></i></span>
				</a>	        	
			</div>
			<div data-toggle="tooltip" data-placement="right" title="Logout">
	       		<a href="logout.php">
					<i class="fa fa-sign-out-alt"></i>
					<span class="to-hide">Log out <i class="fa fa-angle-right pull-right angle-icon"></i></span>
				</a>        	
			</div>
        </div>
        <?php
        }

        ?>
        
	</nav>