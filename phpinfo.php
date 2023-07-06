<!doctype html>
<html lang="en">
<head>
<?php include("common.php"); ?>
	<title>phpinfo - <?php echo $sitename;?></title>
</head>
<style>
	.bi {
		vertical-align: -4px;
	}
</style>
<body>
	<?php include("masthead.php"); ?>
		<div class="container">
        <?php phpinfo(); ?>
		</div>
		<?php include("footer.php");?>
</body>
</html>
