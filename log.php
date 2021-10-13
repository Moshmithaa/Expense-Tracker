<?php 
   include("Database/connect.php");

   session_start();

   $errors = array("username" => " ","email"=>" ","password"=> " "); 
   $username = $email = $password = " ";
   if(isset($_POST["submit"])) {

    if(empty($_POST["email"]) || empty($_POST["password"])) {
      $errors["password"] = "Email and password should not be empty!";
    }else {
      $sql = "SELECT * FROM register WHERE email ='".$_POST["email"]."' AND password = '".$_POST["password"]."'";
      $result = mysqli_query($conn, $sql);
      if($row = mysqli_fetch_assoc($result)) {
        $_SESSION["email"] = $_POST["email"];
        $_SESSION["password"] = $_POST["password"];
        $_SESSION["username"] =  $row["username"];
        header("Location:dashboard.php");
      }else {
        $errors["email"] = "Email does not exists!";
        $errors["password"] = "Password does not exists!";
      }
    }
     


   } // End of POST
   
  
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login-style.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="split left" style="background-color:#8566DB;">
    <span class="welcome">Welcome to EXPENSES</span>
    <span class="small-text">Let’s our journey begin !</span>
    <img src="Images/login-model.png" alt="Background-Image">
    </div>
   <div class="split right">
    <button class="redirect"><a href="index.php">&xlarr;</a></button>
    <span class="get-started">Get Started</span>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
    <label for="email">E-mail Address</label>
    <input type="text" name="email" id="email">
    <div class="error"><?php echo htmlspecialchars($errors["email"]);?></div>
    <label for="password">Password</label>
    <input type="password" name="password" id="password">
    <div class="error"><?php echo htmlspecialchars($errors["password"]);?></div>
    <input type="submit" value="Sign In" name="submit">
    <span class="sign-in">Don't have an account? <a href="login.php">Get Started</a></span>
    </form>

   </div>
</body>
</html>