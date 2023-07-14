<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
      <symbol id="check2" viewBox="0 0 16 16">
        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
      </symbol>
      <symbol id="circle-half" viewBox="0 0 16 16">
        <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
      </symbol>
      <symbol id="moon-stars-fill" viewBox="0 0 16 16">
        <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"/>
        <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"/>
      </symbol>
      <symbol id="sun-fill" viewBox="0 0 16 16">
        <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
      </symbol>
    </svg>
<nav id="navbar" class="navbar  navbar-light bg-light  navbar-static-top navbar-expand-md">
		<div class="container">
			<a class="navbar-brand" href="."><img src="<?php echo $logosrc;?>" alt="<?php echo $sitename;?>" height="32" class="d-inline-block align-text-top"></a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div id="navbarCollapse" class="collapse navbar-collapse">
      <form class="d-flex" method="GET" action="results.php">
			<div class="input-group">
			        <span class="input-group-text" id="basic-addon1"><svg class="bi" width="16" height="16" fill="currentColor">
	<use xlink:href="icons.svg#search"/>
</svg></span>
				<input name="q" class="form-control" type="search" placeholder="Search" aria-label="Search">
			</div>
			</form>
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
                     <img class="img-thumbnail" src="content/pfp/'.getUserPic($_SESSION['profileuser3']).'" style="border-radius: 5px;" width="32px" height="32px">
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
									<!-- <li class="nav-item"><a href="https://discord.gg/zwsM2MSATd" class="nav-link link-light px-2"><svg class="bi" width="16" height="16" fill="currentColor">
	<use xlink:href="icons.svg#discord"/>
</svg> Discord</a></li> -->
							</ul>
		</div>
	</nav>
    </div>
<!-- 	<div class="dropdown position-fixed bottom-0 end-0 mb-3 me-3 bd-mode-toggle">
      <button class="btn btn-bd-primary py-2 dropdown-toggle d-flex align-items-center" id="bd-theme" type="button" aria-expanded="false" data-bs-toggle="dropdown" aria-label="Toggle theme (dark)">
        <svg class="bi my-1 theme-icon-active" width="1em" height="1em"><use href="#moon-stars-fill"></use></svg>
        <span class="visually-hidden" id="bd-theme-text">Toggle theme</span>
      </button>
      <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text" style="">
        <li>
          <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light" aria-pressed="false">
            <svg class="bi me-2 opacity-50 theme-icon" width="1em" height="1em"><use href="#sun-fill"></use></svg>
            Light
            <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
          </button>
        </li>
        <li>
          <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="dark" aria-pressed="true">
            <svg class="bi me-2 opacity-50 theme-icon" width="1em" height="1em"><use href="#moon-stars-fill"></use></svg>
            Dark
            <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
          </button>
        </li>
        <li>
          <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="auto" aria-pressed="false">
            <svg class="bi me-2 opacity-50 theme-icon" width="1em" height="1em"><use href="#circle-half"></use></svg>
            Auto
            <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
          </button>
        </li>
      </ul>
    </div> -->
