<!doctype html>
<html lang="en">
<head>
<?php include("common.php"); ?>
	<title>Login - clipIt</title>
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
                                         window.location.href = "index.php?err=You are already logged in!";
                                         </script>');
                                }
                                if(!empty($_POST)){
                                    $username = htmlspecialchars($_POST['name']);
                                    $statement = $mysqli->prepare("SELECT `password` FROM `users` WHERE `username` = ? LIMIT 1");
                                    $statement->bind_param("s", $username);
                                    $statement->execute();
                                    $result = $statement->get_result();
                                    if($result->num_rows !== 0){
                                    while($row = $result->fetch_assoc()){
                                            $hash = $row['password'];
                                            if(!isset($row['banned'])) {
                                            if(password_verify($_POST['password'], $hash)){
                                                session_start();
                                                $_SESSION["profileuser3"] = htmlspecialchars($_POST['name']);
                                                header("Location: .");
                                            }
                                            else {
                                                echo 'These credentials do not match our records.';
                                            }
                                        }
                                    }
                                    }
                                    else{
                                        echo 'These credentials do not match our records.';
                                    }
                                }
                            ?>
  <form method="POST" action="">
    <img class="mb-4" src="logoci.png" alt="" height="57">
    <h1 class="h3 mb-3 fw-normal">Login to access all of clipIt</h1>

    <div class="form-floating">
      <input type="text" name="name" class="form-control" id="name" placeholder="Username">
      <label for="floatingInput">Username</label>
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