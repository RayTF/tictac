<meta charset="utf-8">
<?php include("static/lib/profile.php"); ?>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
		<link rel="stylesheet" id="bootstrap" href="classic.css" type="text/css">
		<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="common.js"></script>
	<script>
		subscribe_string = 'Subscribe';
		unsubscribe_string = 'Unsubscribe';
	</script>
	<link rel="manifest" href="site.webmanifest">
	<link rel="mask-icon" href="safari-pinned-tab.svg" color="#fd9814">
	<meta name="apple-mobile-web-app-title" content="Quadium">
	<meta name="application-name" content="Quadium">
	<meta name="msapplication-TileColor" content="#fd9814">
	<meta name="msapplication-TileImage" content="/mstile-144x144.png">
	<meta name="theme-color" content="#fd9814">
	<?php error_reporting(~E_ALL & ~E_NOTICE); ?>
	<?php
	// valid values: source (sourcebracket branding), quad (Quadium branding)
	// not implemented
	$branding="source";
	?>
