<?php
   include("Database/connect.php");
   session_start();
   $errors = array("ename" =>"", "ecost" =>"", "edate" => "", "etime"=>"");
   $ename = $ecost = $edate = $etime = "";
   if(isset($_POST["submit"])) {
       if(empty($_POST["expName"])) {
           $errors["ename"] = "Expense Name should not be empty!";
       }else {
           $ename = $_POST["expName"];
       }

       if(empty($_POST["expCost"])) {
           $errors["ecost"] = "Expense Cost should not be empty!";
       }else {
           $ecost = $_POST["expCost"];
       }

       if(empty($_POST["expDate"])) {
           $errors["edate"] = "Expense Date should not be empty!";
       }else {
           $edate = $_POST["expDate"];
       }

       if(empty($_POST["expTime"])) {
           $errors["etime"] = "Expense Time should not be empty!";
       }else {
           $ename = $_POST["expTime"];
       }
        $ename = mysqli_real_escape_string($conn, $_POST["expName"]);
        $ecost = mysqli_real_escape_string($conn, $_POST["expCost"]);
        $edate = mysqli_real_escape_string($conn, $_POST["expDate"]);
        $etime = mysqli_real_escape_string($conn, $_POST["expTime"]);
        $email = $_SESSION["email"];
        $sql = mysqli_query($conn,"SELECT id FROM register WHERE email='$email'") or die (mysqli_error($conn));
        while($row = mysqli_fetch_assoc($sql)) {
            $id = $row["id"];
        }
       
        $sql_insert = "INSERT INTO dashboard(e_id,ename,ecost,edate,etime) VALUES($id,'$ename',$ecost,'$edate','$etime')";
        $query_2 = mysqli_query($conn,$sql_insert);
        if($query_2) {
            echo "SUCCESS";
        }else {
            echo "Error: " . $sql_insert . "<br>" . mysqli_error($conn);
        }
   }


?>


<!DOCTYPE html>
<html> 
    <head>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="task.css">
        </head>
        <body>
        <button class="redirect"><a href="dashboard.php">&xlarr;</a></button>
            <p id="expen">Add your every day expenses here to know your stats, <?php echo $_SESSION["username"]; ?>.</p>
            <div id="circle"></div>
            <p id="pic">Expense Picture</p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
            <label class="name">Expense Name</label>
            <input type="text" class="ename" name="expName">
            <div class="error"><?php echo htmlspecialchars($errors["ename"]);?></div>
            <label class="number">Expense Cost</label>
            <input type="number" class="ecost" name="expCost">
            <div class="error"><?php echo htmlspecialchars($errors["ecost"]);?></div>
            <label class="date">Expense Date</label>
            <input type="date" class="edate" name="expDate">
            <div class="error"><?php echo htmlspecialchars($errors["edate"]);?></div>
            <label class="time">Expense Time</label>
            <input type="time" class="etime" name="expTime">
            <div class="error"><?php echo htmlspecialchars($errors["etime"]);?></div>
            <button class="btn" name="submit">Add</button>
            </form>
            
            <?php 
            ?>

            <div id="rectangle">
                 <span class="addexpense">
                 <?php include("Database/connect.php"); 
                     $email = $_SESSION["email"];
                     $sql = mysqli_query($conn,"SELECT id FROM register WHERE email='$email'") or die (mysqli_error($conn));
                          while($row = mysqli_fetch_assoc($sql)) {
                                $id = $row["id"];
                             }
                     $sql = "SELECT ename, ecost from dashboard WHERE e_id='$id'";
                     $result = mysqli_query($conn, $sql);
                         while($row = mysqli_fetch_assoc($result)) {
                            //  echo $row["ename"].  " ".  $row["ecost"]."<br>";
                   ?>
                   <p>
                       <form action="" method="POST">
                       <?php echo $row["ename"] ." ". $row["ecost"]; ?>
                           <input type="submit" value="delete" class="delete" name="delete">
                       </form>
                    </p>
                   <?php } ?>
                 </span>
            </div>
            </body>
    </html>