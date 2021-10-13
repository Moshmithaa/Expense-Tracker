<?php 

include("Database/connect.php");

$username = $email = $password = " ";
$pattern = '/^.{8,}$/';
$errors = array("username" => " ","email"=>" ","password"=> " "); 

if(isset($_POST["submit"])) {

 // USERNAME ERROR
 if(empty($_POST["username"])){
     $errors["username"] = "Username is Required!";
 }else {
     $username = $_POST["username"];
 }

 if(empty($_POST["email"])){
    $errors["email"] = "email is Required!";
}else {
    $username = $_POST["email"];
}


 if(empty($_POST["password"])){
    $errors["password"] = "Password is Required!";
}else {
    $username = $_POST["password"];
}

  
  if($result){
    $username = mysqli_real_escape_string($conn,$_POST["username"]);
    $email = mysqli_real_escape_string($conn,$_POST["email"]);
    $password = mysqli_real_escape_string($conn,$_POST['password']);
  
    $sql = "INSERT INTO test (username, password, email) VALUES ('$username', '$password','$email')";
    $result = mysqli_query($conn,$sql);
      exit;
  }else {
    echo "Unable to INSERT into DB: " . mysqli_error($conn);
  }
   

  mysqli_free_result($result);

  mysqli_close($conn);

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
          <label for="name">name</label>
          <input type="text" name="username" value="<?php echo htmlspecialchars($username);?>">
          <div class="error"><?php echo htmlspecialchars($errors["username"]);?></div>
          <label for="email">email</label>
          <input type="email" name="email" value="<?php echo htmlspecialchars($email);?>">
          <div class="error"><?php echo htmlspecialchars($errors["email"]);?></div>
          <label for="password">Password</label>
          <input type="password" name="password" value="<?php echo htmlspecialchars($password);?>">
          <div class="error"><?php echo htmlspecialchars($errors["password"]);?></div>
          <input type="submit" value="submit" name="submit">
        </form>
</body>
</html>