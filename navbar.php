<!--
    <form class="form-inline my-2 my-lg-0">
       <div id="shareRoundIcons" class="jssocials  social-network social-circle " style="font-size: 16px" ></div>
    </form>
-->
 <nav class="navbar sticky-top navbar-expand-md navbar-light bg-light border">
            <a class="navbar-brand" href="index.php"><span class="red">Russia 2018 World Cup</span></a>
			
            <button aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler" data-target="#navbar" data-toggle="collapse" type="button">
                <span class="navbar-toggler-icon"></span>
            </button>
			
            <div class="collapse navbar-collapse" id="navbar">
            <?php if (isset($_SESSION['username']) && $_SESSION['username']!="") { ?>
                    <ul class="navbar-nav mr-auto mt-2">
					
                        <li class="nav-item"><a class="nav-link" href="bookings.php">My Bookings</a></li>
                        <li class="nav-item"><a class="nav-link" href="profile.php">My Profile</a></li>

						
						<?php if (isset($_SESSION['username']) && $_SESSION['username']=="admin") { ?>
						<li class="nav-item"><a class="nav-link" href="generate">Generate Cards</a></li>
						<?php } ?>
						
                    </ul>
                    <ul class="navbar-nav ml-auto mt-2">
					    <li class="nav-item"><a class="nav-link "  href="profile.php">Welcome <?php echo $_SESSION['firstname'].' '.$_SESSION['lastname'].'/'; ?> </a></li>
						<li class="nav-item"><span class="nav-link" >|</span></li>
                        <li class="nav-item"><a class="nav-link" href="logout.php">Log Out</a></li>
                    </ul>
            <?php }else{ ?>
                    <ul class="navbar-nav ml-auto mt-2">
                        <li class="nav-item"><a class="nav-link" href="signup.php">Sign Up</a></li>
                        <li class="nav-item"><a class="nav-link" href="login.php">Log In</a></li>
                    </ul>
            <?php } ?>
            </div>
        </nav>