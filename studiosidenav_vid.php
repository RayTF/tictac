<div class="col-xl-4">
			<?php
			if(isset($_SESSION['profileuser3'])){
				$rows = getSubscribers($_SESSION['profileuser3'], $mysqli);
			    $statement = $mysqli->prepare("SELECT * FROM users WHERE username = ? LIMIT 1");
			    $statement->bind_param("s", $_SESSION['profileuser3']);
			    $statement->execute();
			    $result = $statement->get_result();
			    if($result->num_rows === 0) exit('No rows');
			    while($row = $result->fetch_assoc()) {
					$uname = $row['username'];
					$pfp = getUserPic($_SESSION['profileuser3']);
				}
			}
				?>
			<div class="d-inline-block d-flex flex-row my-auto">
          <img class="rounded-circle me-2" src="content/pfp/<?php echo $pfp; ?>" alt="<?php echo $uname;?>" width="54" height="54">
          <div class="align-self-center"><span class="h4 text-body"><!--<span class="text-muted">@</span>--><?php echo $uname;?></span>
          <p class="text-muted h6 h5-sm mt-2 subcount" style="margin-top: 3px !important;"  id="subcount"><?php echo $rows;?> subscribers</p></div>
          </div><hr style="margin-top: 0px;margin-bottom: 5px;">
				<!-- <h1>Studio</h1> -->
			<nav class="nav flex-column nav-pills">
  <a class="nav-link"  href="account.php">Profile</a>
  <a class="nav-link active" aria-current="page" href="my_videos.php">Videos</a>
  <a class="nav-link" href="inbox.php">Messages</a>
  <a class="nav-link disabled">Verified</a>
</nav><br>
</div>