<!doctype html>
<html lang="en">
<head>
<?php include("common.php"); ?>
	<title>Video Manager - Quadium</title>
</head>
<style>
	.bi {
		vertical-align: -4px;
	}
</style>
<body>
	<?php include("masthead.php"); ?>
		<div class="container">
        <?php 
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
} ?>
		<div class="row">
	<div class="col-xl-8">
				<div class="row">
			<div class="col-8">
			<h3>Video Manager</h3>
			</div><div class="col-4">
			<div class="text-end"><a href="browse.php" class="btn btn-light btn-sm">Browse videos</a></div>
			</div>
		</div>
		<?php
		$statement = $mysqli->prepare("SELECT * FROM `videos` WHERE `author` = ?");
        $statement->bind_param("s", $_SESSION['profileuser3']);
        $statement->execute();
                $result = $statement->get_result();
                if($result->num_rows !== 0){
                    while($row = $result->fetch_assoc()) {
						$upload = time_elapsed_string($row['date']);
						$views = getViews($row['vid'], $mysqli); 
                        $delbutton = '<div><a style="width:100%;margin-bottom:10px;" href="deletevideo.php?v='.$row['vid'].'" class="btn btn-danger">Delete</a></div>';
                        echo '
					<div class="card" style="margin-bottom:10px">
	<div class="card-body">
		<div class="row">
			<div class="col-4">
				<a href="watch.php?v='.$row['vid'].'">
					<div class="img-thumbnail">
						<img class="img-fluid" width="960" height="540" src="content/thumb/'.$row['thumb'].'">
					</div>
				</a>
			</div>
			<div class="col-6">
				<h3><a href="watch.php?v='.$row['vid'].'">'.$row['videotitle'].'</a></h3>
																					<p>			<a class="user" href="@'.$row['author'].'">'.$row['author'].'</a> &bull; '.$views.' views	&bull;
				<span class="text-muted">'.$upload.'</span></p>
				<p>'.$row['description'].'</p>
                '.$delbutton.'
			</div>
		</div>
	</div>
</div>';}}?>
			</div>
</div>
		</div>
		<?php include("footer.php");?>
</body>
</html>