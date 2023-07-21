<!doctype html>
<html lang="en">
<head>
<?php include("common.php"); ?>
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/@vime/core@^5/themes/default.css"
/>
<script
  type="module" rel="preload"
  src="https://cdn.jsdelivr.net/npm/@vime/core@^5/dist/vime/vime.esm.js"
></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script> -->
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script> -->
<?php 
            $statement = $mysqli->prepare("SELECT * FROM videos WHERE vid = ? LIMIT 1");
            $statement->bind_param("s", $_GET['v']);
            $statement->execute();
            $result = $statement->get_result();
            while($row = $result->fetch_assoc()) {
              if ($row['privacy'] == 'unlisted') {
                $unlisted = '<span class="badge text-bg-primary"><i class="bi bi-link-45deg"></i> UNLISTED</span>';
              } else {
                $unlisted = "";
              }  
              echo '
		<meta name="title" content="'.$row['videotitle'].' - '.$sitename.'">
	<meta name="description" content="'.$row['description'].'">
	<meta property="og:site_name" content="'.$sitename.'"/>
	<meta property="og:title" content="'.$row['videotitle'].' - '.$sitename.'">
	<meta property="og:description" content="'.$row['description'].'">
	<meta property="og:image" content="content/thumb/'.$row['vid'].'.jpg">
	<meta property="og:url" content="watch.php?v='.$row['videotitle'].'">
	<meta property="twitter:title" content="'.$row['videotitle'].' - '.$sitename.'">
	<meta property="twitter:description" content="'.$row['description'].'">
	<meta property="twitter:image" content="content/thumb/'.$row['vid'].'.jpg">
	<meta name="twitter:card" content="summary_large_image">
	<title>'.$row['videotitle'].' - '.$sitename.'</title>';
    $who = $row['author'];
    $rows = getSubscribers($row['author'], $mysqli);
    $idk = strtotime($row['date']);
    $upload = date("F d, Y", $idk);}
    $statement = $mysqli->prepare("SELECT * FROM `users` WHERE `username` = ? LIMIT 1");
        $statement->bind_param("s", $who);
        $statement->execute();
        $result = $statement->get_result();
        while($row = $result->fetch_assoc()) {
          if($row['displayname'] !== null) {
          $displayname = $row['displayname'];
          } else {
            $displayname = $who;
          }
        if ($row['is_verified'] == 1) {
            $verified = '<svg data-bs-toggle="tooltip" data-bs-placement="top" title="This user is verified." style="margin-left: 0.75%;" class="bi" width="16" height="16" fill="currentColor">
            <use xlink:href="icons.svg#patch-check-fill"/>
        </svg>';
        } else {
            $verified = '';
        }
        $likec = getLikes($_GET['v'], $mysqli);
        $dislikec = getDislikes($_GET['v'], $mysqli);
        $views = getViews($_GET['v'], $mysqli); 
		if(isset($_SESSION["profileuser3"])) {
		addView($_GET['v'], session_id(), $mysqli);
		$commentplaceholder = "Enter your comment here.";
		$commentbutton = '<input name="submit" type="submit" style="margin-top:5px;" class="btn btn-primary mb-3" value="Comment"></input>';
		if($_SESSION['profileuser3'] == $who) {
		$delbutton = '<div><a style="width:100%;margin-bottom:10px;" href="#deleteconfirmation" data-bs-toggle="modal" class="btn btn-danger">Delete</a></div>';
		} else {
			$delbutton = '';
		}
	} else {
		$commentplaceholder = "Please sign in to comment.";
		$commentbutton = '<input value="Comment" type="submit" style="margin-top:5px;" class="btn btn-primary mb-3" disabled></input>';
		$delbutton = '';
		}
    }?>
</head>
<style>
	/* .bi {
		vertical-align: -4px;
	} */
    :root {
    --plyr-color-main: #FF7F00;
    }
</style>
<body>
<?php include("masthead.php"); ?>
<?php
$stmt = $mysqli->prepare("SELECT * FROM videos WHERE vid = ?");
$stmt->bind_param("s", $_GET['v']);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows === 0) echo('<script>window.location.href = "index.php?err=Video ID '.$_GET['v'].' not found!";</script>');
while($row = $result->fetch_assoc()) {
    error_reporting(~E_ALL & ~E_NOTICE);
    if(isset($_GET['err'])) {
       $err = $_GET['err'];
echo '<div class="alert alert-danger" role="alert">
'.$err.'
    </div>'; 
}
if(isset($_GET['msg'])) {
$msg = $_GET['msg'];
echo '<div class="alert alert-primary" role="alert">
'.$msg.'
</div>'; 
}
if(isset($_GET['success'])) {
$suc = $_GET['success'];
echo '<div class="alert alert-success" role="alert">
'.$suc.'
</div>'; 
}
    echo('
<main class="container-fluid mt-3">
    <div class="d-flex flex-row flex-column flex-md-column flex-lg-column flex-xl-row">
      <div class="w-100 mx-auto mx-lg-auto mx-xl-0">
      <vm-player style="--vm-player-theme: #0078fa">
      <vm-video cross-origin="true" poster="/content/thumb/'.$_GET['v'].'.jpg">
        <source data-src="/content/video/'.$_GET['v'].'.mp4" type="video/mp4" />
      </vm-video>
      <vm-default-ui no-controls>
        <vm-default-controls hide-on-mouse-leave active-duration="2000">
        <vm-pip-control keys="p" />
        </vm-default-controls>
        <vm-default-settings pin="bottomRight">
          <vm-menu-item label="TestTube Player (Powered by Vime)"></vm-menu-item>
        </vm-settings>
      </vm-default-ui>
     </vm-player>
        <div class="card shadow-sm my-2">
         <div class="card-body">
         <div class="d-flex flex-row flex-column">
         <div>
         <h2>'.$row['videotitle'].'</h2>
         '.$unlisted.' '.$views.' views<i class="bi bi-dot"></i>'.$upload.'         </div>
         <div class="mt-3">
         <div class="d-flex flex-row flex-column flex-sm-row">
         <a class="text-decoration-none text-reset me-2" href="/@'.$row['author'].'">
         <div class="d-inline-block d-flex flex-row my-auto">
          <img class="rounded-circle me-2" src="/content/pfp/'.getUserPic($row['author']).'" alt="'.$row['author'].'" width="54" height="54">
          <div class="align-self-center"><span class="h6 text-body">'.$verified.' '.$displayname.'</span>
          <p class="text-muted h6 h5-sm mt-2 subcount" id="subcount">'.$rows.' subscribers</p></div>
          </div>
         </a>

         <div class="ms-0 ms-sm-auto mt-2 mt-sm-0">
         <div class="btn-group my-auto w-100">');
         if($row['author'] == $_SESSION['profileuser3']) {
          echo '
         <a href="editvideo.php?v='.$_GET['v'].'" class="btn btn-primary" id="editprof"">Edit Video</a>';
        } else {
          if(isset($_SESSION['profileuser3'])) {
            if(ifSubscribed($_SESSION['profileuser3'], $row['author'], $mysqli) == false) {
           echo '
           <a href="subscribe.php?name='.$row['author'].'" class="btn btn-danger" id="btnsub">Subscribe</a>';
          } else { 
            echo '<a href="unsubscribe.php?name='.$row['author'].'" class="btn btn-secondary" id="btnsub">Unsubscribe</a>';
          } 
        } else {
            echo'
            <a id="subscribe" class="btn btn-warning" type="button" disabled>Subscribe</a>
        ';
        }
      }
          echo('<a href="like.php?v='.$_GET['v'].'" class="btn btn-success bi bi-hand-thumbs-up" id="like"> '.$likec.'</a>
          <a href="dislike.php?v='.$_GET['v'].'" class="btn btn-danger bi bi-hand-thumbs-down" id="dislike"> '.$dislikec.'</a>
          <button type="button" class="btn btn-dark bi bi-share" data-bs-toggle="modal" data-bs-target="#share"></button>
                  </div>
         </div>
         </div>
         </div>
         </div>
                </div>
       </div>');}?>
  <div class="card">
      <button class="btn text-reset py-2 text-start bi bi-chat-left-text" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
        Comments
      </button>
  </div>
    <div class="offcanvas offcanvas-end" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel" style="max-width: 35rem;">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasExampleLabel">Comments</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <?php
        $stmt = $mysqli->prepare("SELECT * FROM comments WHERE tovideoid = ? ORDER BY date DESC");
        $stmt->bind_param("s", $_GET['v']);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows === 0) echo '<p>No comments.</p>';
  echo '<div class="offcanvas-body me-3 me-lg-2">
   <form method="post" action="comment.php?v='.$_GET['v'].'" class="form-floating mb-2">
    <textarea name="bio" class="form-control" placeholder="'.$commentplaceholder.'" id="comment-text" style="height: 80px"></textarea>
    <label for="floatingTextarea2">'.$commentplaceholder.'</label>
    '.$commentbutton.'
   </form>
   <div id="comments">';        
while($row = $result->fetch_assoc()) {
    $cd = time_elapsed_string($row['date']);
    if ($_SESSION['profileuser3'] == $row['author']) {
      $delcm = "<a style='font-size:14px;color:red;float:right;margin-bottom:-55px;text-decoration:none;' href='deletecomment.php?v=".$row["id"]."'><i class='bi bi-trash3-fill'></i></a>";
    }
echo'
          	<div class="card shadow-sm mb-3" id="comment-'.$row['id'].'">
		<div class="card-body">
		<a class="text-decoration-none text-reset flex-grow-1" href="@'.$row['author'].'">
		<img class="rounded-5 me-2 float-start" src="/content/pfp/'.getUserPic($row['author']).'" alt="" width="48" height="48">
		</a><div class="d-flex flex-column"><a class="text-decoration-none text-reset flex-grow-1" href="@'.$row['author'].'">
		<span class="my-auto">'.$row['author'].'</span><i class="bi bi-dot"></i>'.$cd.'</a>
		<span class="text-break">
        '.$row['comment'].'
        '.$delcm.'
		</span>
		</div></div></div>
';}echo'</div></div></div></div>';?>
      <div class="ms-0 ms-xl-3" style="min-width: 30%; max-width: 100%">
             <div>
             <?php
		$statement = $mysqli->prepare("SELECT * FROM videos WHERE `privacy` = 'public' ORDER BY RAND() LIMIT 6");
                //$statement->bind_param("s", $_POST['fr']); i have no idea what this is but we don't need it
                $statement->execute();
                $result = $statement->get_result();
                if($result->num_rows !== 0){
                    while($row = $result->fetch_assoc()) {
						$upload = time_elapsed_string($row['date']);
						$views = getViews($row['vid'], $mysqli); 
			    $auth = $row['author'];
                        echo '
               <div class="card shadow-sm mt-2 mt-sm-2 mt-xl-0 mb-2" style="cursor: pointer;" onclick="location.href = \'watch.php?v='.$row['vid'].'\'">
          <div class="row g-0">                                                                                                                                                                                                                                                                                                                                                                                                    
            <div class="col-12 col-lg-6 position-relative d-inline-block">
              <div class="ratio ratio-16x9">
              <img src="/content/thumb/'.$row['thumb'].'" height="100px" class="rounded-end rounded-start" alt="'.$row['title'].'">
              </div>
              <!--<span class="position-absolute bottom-0 end-0 badge text-bg-dark mb-1 me-1 opacity-75">0:07</span>-->
            </div>
            <div class="col-6">
              <div class="card-body">
                <p class="h6 text-reset text-truncate">'.$row['videotitle'].'</p>
                <a class="text-decoration-none text-truncate" href="@'.$row['author'].'">'.$row['author'].'</a><br>
                '.$views.' views<i class="bi bi-dot"></i>'.$upload.'             </div>
            </div>
          </div>
        </div>';}}?>
               </div>
      </div>
    </div>
  </main>
  <div class="modal fade" id="share" data-bs-keyboard="false" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Share</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-floating">
         <textarea class="form-control" readonly="" style="height: 5.5rem;" id="floatingTextarea">https://<?php echo $_SERVER["SERVER_NAME"]; echo('/watch.php?v='.$_GET['v'].'');?></textarea>
         <label for="floatingTextarea">URL</label>
        </div>
        <h5 class="text-center mt-1 text-body">Or</h5>
        <div class="form-floating">
         <textarea class="form-control" readonly="" style="height: 6.5rem;" id="floatingTextarea">https://<?php echo $_SERVER["SERVER_NAME"]; echo('/content/video/'.$_GET['v'].'.mp4');?></textarea>
         <label for="floatingTextarea">Direct video link</label>
        </div>
        <!--<div class="form-floating">
         <textarea class="form-control" readonly="" style="height: 6.5rem;" id="floatingTextarea">&lt;iframe width="854" height="480" src="heNL-j"&gt;&lt;/iframe&gt;</textarea>
         <label for="floatingTextarea">Embed url</label>
        </div> -->
      </div>
    </div>
  </div>
</div>
		<?php include("footer.php"); ?>
</body>
</html>
