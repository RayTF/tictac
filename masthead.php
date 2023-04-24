<nav id="navbar" class="navbar  navbar-light bg-light  navbar-static-top navbar-expand-md">
		<div class="container">
			<a class="navbar-brand" href="."><img src="logo2.png" alt="ticTac" height="32" class="d-inline-block align-text-top"></a>
			<form class="d-flex" method="GET" action="results.php">
			<div class="input-group">
			        <span class="input-group-text" id="basic-addon1"><svg class="bi" width="16" height="16" fill="currentColor">
	<use xlink:href="icons.svg#search"/>
</svg></span>
				<input name="q" class="form-control" type="search" placeholder="Search" aria-label="Search">
			</div>
			</form>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div id="navbarCollapse" class="collapse navbar-collapse">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>
				<ul class="navbar-nav dropdown-center">
										<div class="d-grid gap-2 d-md-block">
                                        <?php
      if(!$loggedIn) {
        echo '<a href="login.php" class="btn btn-primary me-md-1">Login</a>
        <a href="register.php" class="btn btn-secondary">Register</a>';
      } else {
        $statement = $mysqli->prepare("SELECT * FROM users WHERE username = ? LIMIT 1");
			    $statement->bind_param("s", $_SESSION['profileuser3']);
			    $statement->execute();
			    $result = $statement->get_result();
			    if($result->num_rows === 0) exit('No rows');
			    while($row = $result->fetch_assoc()) {
			        echo '
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                     <img src="content/pfp/'.getUserPic($_SESSION['profileuser3']).'" style="border-radius: 5px;" width="32px" height="32px">
                    </a>
                    <ul class="dropdown-menu">
                      <li><a class="align-middle dropdown-item" href="#">@<b>'.$row['username'].'</b></a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" href="upload.php"><svg class="align-middle" width="15" height="15" fill="currentColor"><use xlink:href="icons.svg#upload"/></svg> Upload</a>
                      <li><a class="align-middle dropdown-item" href="@'.$row['username'].'"><svg class="align-middle" width="15" height="15" fill="currentColor"><use xlink:href="icons.svg#person-circle"/></svg> Your Channel</a></li>
                      <li><a class="align-middle dropdown-item" href="account.php"><svg class="align-middle" width="15" height="15" fill="currentColor"><use xlink:href="icons.svg#pencil-square"/></svg> Edit Profile</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="align-middle dropdown-item" href="logout.php"><svg class="align-middle" width="15" height="15" fill="currentColor"><use xlink:href="icons.svg#door-open"/></svg> Logout</a></li>
                    </ul>
                  </li>
          ';
			    }
			    $statement->close();
      }
    ?>				
</div>
									<!--	<div class="dropdown">
						<li class="nav-item">
							<style>
								#openSettings.nav-link {
									padding: 0.25rem;
								}
							</style>
							<a href="#" id="openSettings" class="dropdown-toggle nav-link" data-bs-toggle="dropdown" aria-expanded="false">
								<svg class="bi" width="30" height="30" fill="currentColor">
	<use xlink:href="icons.svg#three-dots-vertical"/>
</svg>							</a>
						</li>
						<ul class="dropdown-menu" aria-labelledby="navbarDropdown" id="mainMenu">
														<li><a class="dropdown-item" id="themeSelect" href="#"><svg class="bi" width="16" height="16" fill="currentColor">
	<use xlink:href="icons.svg#brush"/>
</svg> Change theme</a></li>
													</ul>
						<ul class="dropdown-menu" id="themeSelection" aria-labelledby="navbarDropdown">
							 <li><a class="dropdown-item" id="back" href="#">Back</a></li>
							<li><a class="dropdown-item" id="finalium" href="#">Light</a></li>
							<li><a class="dropdown-item" id="light" href="#">Classic</a></li>
						</ul>
					</div> -->
				</ul>
			</div>
			<!--/.nav-collapse -->
		</div>
	</nav>
    <div class="mb-4">
	<nav class="py-1 bg-dark">
		<div class="container">
			<ul class="nav me-auto">
				<li class="nav-item"><a href="." class="nav-link link-light px-2"><svg class="bi" width="16" height="16" fill="currentColor">
	<use xlink:href="icons.svg#house-door"/>
</svg> Home</a></li>
				<li class="nav-item"><a href="browse.php" class="nav-link link-light px-2"><svg class="bi" width="16" height="16" fill="currentColor">
	<use xlink:href="icons.svg#play-btn"/>
</svg> Browse</a></li>
				<li class="nav-item"><a href="channels.php" class="nav-link link-light px-2"><svg class="bi" width="16" height="16" fill="currentColor">
	<use xlink:href="icons.svg#people"/>
</svg> Channels</a></li>
									<li class="nav-item"><a href="https://discord.gg/quadium" class="nav-link link-light px-2"><svg class="bi" width="16" height="16" fill="currentColor">
	<use xlink:href="icons.svg#discord"/>
</svg> Discord</a></li>
							</ul>
		</div>
	</nav>
    </div>
