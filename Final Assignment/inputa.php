<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" type="text/css" href="amit.css">
<link rel="icon" type="image/png" href="C:\Users\Lenovo\Desktop\tudip.png">
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" href="bootstrap-3.3.6-dist\bootstrap-3.3.6-dist\css\bootstrap.css">
<link rel="stylesheet" href="C:\Users\Lenovo\Desktop\amit1\amit2.css">
<script src="jquery-1.12.4.js"></script>
<script src="bootstrap-3.3.6-dist\bootstrap-3.3.6-dist\js\bootstrap.min.js"></script>
<script src = "angular.min.js"></script>
<script src="C:\Users\Lenovo\Desktop\amit1\amit\a1.js"></script>

</head>
 
<body>
    <div class="container">
            <div class="row">
                <h3>Total Visitors</h3>
            </div>
            <div class="row">
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Mobile</th>
                      <th>InTime</th>
					  <th>OutTime</th>
					  <th>Email</th>
					 
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   include 'db.php';
                   $pdo = Database::connect();
                   $sql = 'SELECT `FullName`, `Mobile Number`, `In Time`, `Out Time`, `Email Id` FROM `guestbook3`;
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['FullName'] . '</td>';
                            echo '<td>'. $row['Mobile Number'] . '</td>';
                            echo '<td>'. $row['In Time'] . '</td>';
							echo '<td>'. $row['Out Time'] . '</td>';
							echo '<td>'. $row['Email Id'] . '</td>';
							
							
                            echo '</tr>';
                   }
                   Database::disconnect();
                  ?>
                  </tbody>
            </table>
        </div>
    </div> <!-- /container -->
  </body>
</html>
