<?php 
   include("Database/connect.php");
   session_start();
   if(isset($_POST["button1"])) {
    session_start();
    session_unset();
    if(session_destroy()){
        header("Location:index.php");
    }
   }




?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="dashboard.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Name', 'Money spent'],
            <?php
          include("Database/connect.php");
          $email = $_SESSION["email"];
          $sql = mysqli_query($conn,"SELECT id FROM register WHERE email='$email'") or die (mysqli_error($conn));
               while($row = mysqli_fetch_assoc($sql)) {
                     $id = $row["id"];
                  }
          $sql = "SELECT * from dashboard WHERE e_id='$id'";
          $result = mysqli_query($conn, $sql);
          while($data = mysqli_fetch_assoc($result)){
              $name = $data["ename"];
              $cost = $data["ecost"];
          ?>
          ['<?php echo $name; ?>', <?php echo $cost; ?>],
          <?php } ?>
        ]);

        var options = {
          title: 'Expense Chart',
          colors: ['#8566DB', '#BEB2E1', '#858080', '#F84141', '#101010'],
          is3D: true
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      } // End of pie chart

      google.charts.load('current', {'packages':['table']});
      google.charts.setOnLoadCallback(drawTable);

      function drawTable() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Name');
        data.addColumn('number', 'cost');
        data.addColumn('string', 'Date');
        data.addColumn('string', 'Time');
        data.addRows([
            <?php
          include("Database/connect.php");
          $email = $_SESSION["email"];
          $sql = mysqli_query($conn,"SELECT id FROM register WHERE email='$email'") or die (mysqli_error($conn));
               while($row = mysqli_fetch_assoc($sql)) {
                     $id = $row["id"];
                  }
          $sql = "SELECT * from dashboard WHERE e_id='$id'";
          $result = mysqli_query($conn, $sql);
          while($data = mysqli_fetch_assoc($result)){
              $name = $data["ename"];
              $cost = $data["ecost"];
              $date = $data["edate"];
              $time = $data["etime"];
          ?>
          ['<?php echo $name; ?>', <?php echo $cost; ?>, '<?php echo $date; ?>', '<?php echo $time; ?>'],
          <?php } ?>
        ]);

        var table = new google.visualization.Table(document.getElementById('table_div'));
        var formatter = new google.visualization.NumberFormat({prefix: '₹'});
        formatter.format(data, 1);
        

        table.draw(data, {allowHtml: true, showRowNumber: true, width: '100%', height: '100%'});
      } // End of table chart



    </script>
    
</head>
<body>

    <div class="container">
        <div class="left-container" >
            <span class="home"><img src="Images/home.png" alt="home">
            </span>
            <span class="settings"><img src="Images/Settings.jpg" alt="settings"></span>
            <span class="manage"><img src="Images/manage.jpg" alt="manage"></span>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
            <input type="submit" name="button1" value = " " class="logout" style="background: url(Images/logout.jpg); border: none; text-color:"/>
            </form>
        </div>
        <div class="center-container">
            <span class="greets">Welcome Back, <?php echo $_SESSION["username"]; ?></span>
        </div>
        <div class="centre-left">
            <span class="exp-txt">Add your Expenses every day to know your stats, <?php echo $_SESSION["email"]; ?>.</span>
            <span class="add"><a href="addExpense.php"><img src="Images/add.jpg" alt="add"></a></span>
        </div>
        <div class="bottom" id="table_div"> </div>
        <div class="centre-right" id="piechart_3d"></div>
    </div>
</body>
</html>

