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
<?php
if (empty($_POST['employeenumber']) || empty($_POST['newlastname']))
     echo "<p>You must enter an Employee Number and Last Name. Please re-enter required information.</p>";
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
		  $DBLast = "LastName";
		  $DBId = "EmployeeNumber";
			
			//$MaidenName = stripslashes($_POST['maidenname']);
            $LastName = test_input($_POST['newlastname']);
            $EmployeeNumber = stripslashes($_POST['employeenumber']);
            $SQLstring = "UPDATE $TableName SET $DBLast='$LastName' WHERE $DBId='$EmployeeNumber'"; //VALUES(NULL, '$LastName', '$FirstName')";
            $QueryResult = @mysqli_query($DBConnect, $SQLstring);
               if ($QueryResult === FALSE)
                    echo "<p>Unable to update your last name.</p>"
                       . "<p>Error code " . mysqli_errno($DBConnect)
                       . ": " . mysqli_error($DBConnect) . "</p>";
          }
          mysqli_close($DBConnect);
     }
}
    function test_input($LastName) {
  $LastName = trim($LastName);
  $LastName = stripslashes($LastName);
  $LastName = htmlspecialchars($LastName);
  $LastName = preg_replace('~[0-9]~', "",$LastName);
  $LastName = preg_replace('/[^A-Za-z0-9.#\\-$]/', "",$LastName);
  return $LastName;
}
?>
</section>
<section id="main">
<br>
<br>
<h3>Updated Employee List</h3>
         <table border="1">
        <thead>
            <tr>
                <td><center>Emp#<td><center></center>
                <td><center>First Name<td><center></center>
				<td><center>Last Name<td><center></center>
				<td><center>Department<td><center></center>
				<td><center>Position<td><center></center>
				<td><center>Supervisor<td><center></center>
				<td><center>Office Phone<td><center></center>
				
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
            $results = $conn->query("select employeenumber, firstname, lastname, department, position, supervisor, officephone from employee where not employeenumber ='10'");
            while($row = $results->fetch_assoc()) {
            ?>
                <tr>
					<td><center><?php echo $row['employeenumber']?><td><center></center>
                    <td><center><?php echo $row['firstname']?><td><center></center>
                    <td><center><?php echo $row['lastname']?><td><center></center>
					<td><center><?php echo $row['department']?><td><center></center>
					<td><center><?php echo $row['position']?><td><center></center>
                    <td><center><?php echo $row['supervisor']?><td><center></center>
					<td><center><?php echo $row['officephone']?><td><center></center>
					
                </tr>

            <?php
            }
            ?>
            </tbody>
            </table>
<h4>Update Last Name</h4>
<form method="post" action="changelastname.php">
<!-- <p>First Name:  &nbsp&nbsp&nbsp &nbsp&nbsp<input type="text" name="firstname"/></p> -->
<p>Employee Number:   &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" name="employeenumber" required pattern= "[0-9]+" title="Please enter a digit. 0-9" size="4" maxlength="4"/></p>
<p>New Last Name:   &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" required pattern
="[a-z A-Z-]+" title="A-Z, Space, or - Only" name="newlastname"/></p>
  <input type="submit" value="Submit">
</form> 
<section id="footer">
<footer>
<center>© 2019 - Wedgewood Pacific</center
</footer>
</section>

</body>


</html>