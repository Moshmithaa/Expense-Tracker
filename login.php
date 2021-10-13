<?php 
   include("Database/connect.php");


   $errors = array("username" => "", "email" => "", "password" => "");
   $username = $email = $password = "";

   if(isset($_POST["submit"])){

     if(empty($_POST["username"])) {
       $errors["username"] = "Empty!";
     }else{
       $username = $_POST["username"];
     }

     if(empty($_POST["email"])){
       $errors["email"] = "Empty!";
     }else {
       $email = $_POST["email"];
       if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
         $errors["email"] = "Fill In!";
       }
     }


     if(empty($_POST["password"])) {
       $errors["password"] = "Empty!";
     }else {
       $password = $_POST["password"];
     }
     
     if(array_filter($errors)){
      echo "error";
     }else {
       $username = mysqli_real_escape_string($conn, $_POST["username"]);
       $email = mysqli_real_escape_string($conn, $_POST["email"]);
       $password = mysqli_real_escape_string($conn, $_POST["password"]);

       $emailexists = mysqli_query($conn, "SELECT * FROM register WHERE email = '$email'");
       $usernameexists = mysqli_query($conn, "SELECT * FROM register WHERE username = '$username'");

      if(mysqli_num_rows($emailexists) > 0) {
         $errors["email"] = "Email already exists!";
       }elseif(mysqli_num_rows($usernameexists) > 0){
         $errors["username"] = "Username already exists!";
       }else {
        $sql = "INSERT INTO register(username, email, password) VALUES('$username', '$email', '$password')";
        if(mysqli_query($conn, $sql)) {
          header('Location:log.php');
        }else {
          echo "query error: " . mysqli_error($conn);
        }
       }

       

     }


   } // End of post

  
   
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
    <label for="name">Username</label>
    <input type="text" name="username" id="username">
    <div class="error"><?php echo htmlspecialchars($errors["username"]);?></div>
    <label for="email">E-mail Address</label>
    <input type="text" name="email" id="email">
    <div class="error"><?php echo htmlspecialchars($errors["email"]);?></div>
    <label for="password">Password</label>
    <input type="password" name="password" id="password">
    <div class="error"><?php echo htmlspecialchars($errors["password"]);?></div>
    <input type="submit" value="Get Started" name="submit">
    <span class="sign-in">Already have an account? <a href="log.php">Sign In</a></span>
    </form>


   </div>
</body>
</html>