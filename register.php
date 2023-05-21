<!doctype html>
<html lang="en">
<head>
<?php include("common.php"); ?>
	<title>Login - <?php echo $sitename;?></title>
    <style>
    html,
body {
  height: 100%;
}

body {
  display: flex;
  align-items: center;
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #f5f5f5;
}

.form-signin {
  width: 100%;
  max-width: 330px;
  padding: 15px;
  margin: auto;
}

.form-signin .checkbox {
  font-weight: 400;
}

.form-signin .form-floating:focus-within {
  z-index: 2;
}

.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}

.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
</style>
<body class="text-center">
    
<main class="form-signin">
<?php
                if(isset($_SESSION['profileuser3'])) {
                    echo('<script>
                         window.location.href = "index.php";
                         </script>');
                }
            if (!empty($_POST)){
                //if ($_POST['name'] == "") {
                    if(empty($_POST['name'])) {
                    echo('<script>
                    window.location.href = "index.php?err=No username was provided.";
                    </script>');
                }
                if(empty($_POST['password'])) {
                    echo('<script>
                    window.location.href = "index.php?err=No password was provided.";
                    </script>');
                }
                if(empty($_POST['email'])) {
                    echo('<script>
                    window.location.href = "index.php?err=No email was provided.";
                    </script>');
                }
                if (strlen($_POST['name']) > 21) {
                    echo('Username too long.');
                    die('');
                include("footer.php");
                echo("</body>
                </html>");
                }
                //i should add captcha support lol but cloudfront breaks it
                $sql = "SELECT `username` FROM `users` WHERE `username`='". htmlspecialchars($_POST['name']) ."'";
                $result = $mysqli->query($sql);
                if($result->num_rows >= 1) {
                    echo "Username already exists, try something else.";
                } else {
                    $sql2 = "SELECT `email` FROM `users` WHERE `email`='". htmlspecialchars($_POST['email']) ."'";
                $result2 = $mysqli->query($sql2);
                if($result->num_rows >= 1) {
                    echo "Email already in use, try something else.";
                }
                    $statement = $mysqli->prepare("INSERT INTO `users` (`date`, `username`, `email`, `password`) VALUES (now(), ?, ?, ?)");
                    $statement->bind_param("sss", $username, $email, $password);
                    $username = htmlspecialchars($_POST['name']);
                    $email = htmlspecialchars($_POST['email']);
                    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    $statement->execute();
                    $statement->close();
                    $mysqli->close();
                    $_SESSION['profileuser3'] = htmlspecialchars($_POST['name']);
                     echo('<script>
                     window.location.href = "index.php";
                     </script>');
                }
            }
            ?>
  <form method="POST" action="">
    <img class="mb-4" src="<?php echo $logosrc;?>" alt="" height="57">
    <h1 class="h3 mb-3 fw-normal">Register to access all of <?php echo $sitename;?></h1>

    <div class="form-floating">
      <input type="text" name="name" class="form-control" id="name" placeholder="Username">
      <label for="floatingInput">Username</label>
    </div>
    <div class="form-floating">
      <input type="email" name="email" class="form-control" id="email" placeholder="Email">
      <label for="floatingInput">Email</label>
    </div>
    <div class="form-floating">
      <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>

    <!-- <div class="checkbox mb-3">
      <label>
        <input type="checkbox" value="remember-me"> Remember me
      </label>
    </div> -->
    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2022-<?php echo date("Y"); ?> cosmixcode</p>
  </form>
</main>


    
  </body>
</html>