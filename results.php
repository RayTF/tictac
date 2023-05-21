<!doctype html>
<html lang="en">
<head>
<?php include("common.php"); ?>
	<title>Search for "<?php echo $_GET['q'];?>" - <?php echo $sitename;?></title>
</head>
<style>
	.bi {
		vertical-align: -4px;
	}
</style>
<body>
	<?php include("masthead.php"); ?>
		<div class="container">
<h1>Results for "<?php echo $_GET['q'];?>"</h1>
<?php
    if(($_GET['search_type'] == "search_users")) {
        $query = $_GET['q'];
        header("Location: results_users.php?q=$query"); 
    }
    $results = '';
    $searchErr = '';
    if(isset($_GET['q']))
{
	if(!empty($_GET['q']))
	{
		$search = htmlspecialchars($_GET['q']);
		$stmt = $mysqli->prepare("select * from videos where videotitle like '%$search%' or description like '%$search%'");
		$stmt->execute();
		$results = $stmt->get_result();
		
	}
	else
	{
		$searchErr = "You didn't put anything in the box.";
	}
   
}
?>
<?php
		    	 if(!$results)
		    	 {
		    		echo 'No videos found.';
		    	 }
		    	 else{
		    	 	foreach($results as $key=>$value)
		    	 	{
                        $upload = time_elapsed_string($value['date']);
						$views = getViews($value['vid'], $mysqli); 
		    	 		?>
                        <div class="card" style="margin-bottom:10px">
	<div class="card-body">
		<div class="row">
			<div class="col-4">
				<a href="watch.php?v=<?php echo $value['vid']; ?>">
					<div class="img-thumbnail">
						<img class="img-fluid" width="960" height="540" src="content/thumb/<?php echo $value['thumb']; ?>">
					</div>
				</a>
			</div>
			<div class="col-6">
				<h3><a href="watch.php?v=<?php echo $value['vid']; ?>"><?php echo $value['videotitle']; ?></a></h3>
																					<p>			<a class="user" href="@<?php echo $value['author']; ?>"><?php echo $value['author']; ?></a> &bull; <?php echo $views; ?> views	&bull;
				<span class="text-muted"><?php echo $upload; ?></span></p>
				<p><?php echo $value['description']; ?></p>
			</div>
		</div>
	</div>
</div>
		    	 		
		    	 		<?php
		    	 	}
		    	 	
		    	 }
		    	?>
</div>
		<?php include("footer.php");?>
</body>
</html>