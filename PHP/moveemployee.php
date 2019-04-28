<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"> 
<title>Wedgewood Pacific</title>
<link rel="stylesheet" type="text/css" href="wpstyle.css">
</head>

<body>
<section id="top">
<center><img src="banner.jpg" alt="banner" style="width:1500px;height:300px;" border="2"></center>
</section>
<section id="menu">
<h3> Administrator </h3>
	<ul>
		<li><b>Menu</b></li>
		<li><a href="newemployee.html">&nbsp &nbsp Add Employee</a></li>
		<li><a href="changelastnm.php">&nbsp &nbsp Update Last Name</a></li>
		<li><a href="changeph.php">&nbsp &nbsp Update Phone Number</a></li>
		<li><a href="moveemp.php">&nbsp &nbsp Transfer Employee</a></li>
		<li><a href="querydb.html">&nbsp &nbsp Query DB</a></li>
		<li><a href="Reports.html">Reports</a></li>
		<li><a href="wphome.html">Logout</a></li>
	</ul>
</section>
<section id="main">
<?php
if (empty($_POST['employeenumber']) || empty($_POST['department']))
     echo "<p>You must enter an Employee Number and Sep. Please re-enter required information.</p>";
else {
     $DBConnect = @mysqli_connect('localhost', 'root');
     if ($DBConnect === FALSE)
          echo "<p>Unable to connect to the database server.</p>"
               . "<p>Error code " . mysqli_connect_errno()
               . ": " . mysqli_connect_error() . "</p>";
			  
     else {
          $DBName = "wp";
          if (@mysqli_select_db($DBConnect, $DBName)) {
               
		  $TableName = "employee";
		  $DBId = "EmployeeNumber";
		  $DBDepartment = "Department";
			
			
            $EmployeeNumber =$_POST['employeenumber'];
            $Department = stripslashes($_POST['department']);
            $SQLstring = "UPDATE $TableName SET $DBDepartment='$Department' WHERE $DBId='$EmployeeNumber'"; //VALUES(NULL, '$LastName', '$FirstName')";
            $QueryResult = @mysqli_query($DBConnect, $SQLstring);
               if ($QueryResult === FALSE)
                    echo "<p>Unable to update your phone number.</p>"
                       . "<p>Error code " . mysqli_errno($DBConnect)
                       . ": " . mysqli_error($DBConnect) . "</p>";
          }
          mysqli_close($DBConnect);
     }
}

?>
<br>
<br>
<h3>Updated Employee List</h3>
         <table border ="1">
        <thead>
            <tr>
                <td><center>Emp#<td><center></center>
                <td><center>First Name<td><center></center>
				<td><center>Last Name<td><center></center>
				<td><center>Department<td><center></center>			
            </tr>
        </thead>
        <tbody>
        <?php
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "wp";
			$conn = new mysqli($servername, $username, $password, $dbname);
            if (!$conn) {
                die(mysql_error());
            }
            $results = $conn->query("select employeenumber, firstname, lastname, department, officephone from employee where not employeenumber ='10'");
            while($row = $results->fetch_assoc()) {
            ?>
                <tr>
					<td><center><?php echo $row['employeenumber']?><td><center></center>
                    <td><center><?php echo $row['firstname']?><td><center></center>
                    <td><center><?php echo $row['lastname']?><td><center></center>
					<td><center><?php echo $row['department']?><td><center></center>
					
                </tr>

            <?php
            }
            ?>
            </tbody>
            </table>
<section id="main">
<h4>Transfer Employee</h4>
<form method="post" action="moveemployee.php">
<p>Employee Number:   &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" name="employeenumber" required pattern= "[0-9]+" title="Please enter a digit. 0-9"  size="4" maxlength="4" /></p>
<p>Department:    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <select name="department" required>
	<option></option>
	<option value="Accounting">Accounting</option>
    <option value="Administration">Administration</option>
	<option value="Finance">Finance</option>
	<option value="Human Resources">Human Resources</option>
	<option value="InfoSystems">Infomation System</option>
    <option value="Legal">Legal</option>
    <option value="Production">Production</option>
	<option value="Research and Development">Research and Development</option>
	<option value="Sales and Marketing">Sales and Marketing</option>
 </select></p>
  <input type="submit" value="Submit">
</form> 

</section>
<section id="footer">
<footer>
<center>© 2019 - Wedgewood Pacific</center
</footer>
</section>

</body>


</html>