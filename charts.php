<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['table']});
      google.charts.setOnLoadCallback(drawTable);

      function drawTable() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Name');
        data.addColumn('number', 'cost');
        data.addColumn('string', 'Date');
        data.addColumn('string', 'Time');
        data.addRows([
            ['Mike',  {v: 10000, f: '$10,000'}, '12.09.21', '12:34'],
        ]);

        var table = new google.visualization.Table(document.getElementById('table_div'));

        table.draw(data, {showRowNumber: true, width: '50%', height: '50%'});
      }
    </script>
  </head>
  <body>
    <div id="table_div"></div>
  </body>
</html>
