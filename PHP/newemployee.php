<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"> 
<title>Wedgewood Pacific</title>
<link rel="stylesheet" type="text/css" href="wpstyle.css">
</head>

<body>
<section id="top">
<img src="banner.jpg" alt="banner" style="width:1500px;height:300px;" >
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


  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "wp";
  $firstname= $_POST["firstname"];
  $lastname=  $_POST["lastname"];
  $department= $_POST["department"];
  $position=  $_POST["position"];
  $supervisor=  $_POST["supervisor"];
  $officenumber=  $_POST["officephone"];
  $emailaddress= $_POST["emailaddress"];
  $user= $_POST["username"];
  $pass= $_POST["password"];
  
  
  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  } 

	$result = $conn->query("insert into employee (EmployeeNumber,FirstName, LastName, Department, Position, Supervisor, OfficePhone, EmailAddress, Username, Password) value (NULL, '$firstname','$lastname','$department','$position','$supervisor','$officenumber', '$emailaddress', '$user', '$pass' )");
   if($result === true)
      echo "<br/><h3> New Employee Add Successful. </h3>";
   else 
      echo "<br/> <h3>Failed to add new employee. </h3><br/>";
  

   $conn->close(); // close connection
   
   
   
?>
</section>
<section id="main">
<h3>Updated Employee List</h3>
         <table border ="1">
        <thead>
            <tr>
                <td><center>Emp#<td></center>
                <td><center>First Name<td></center>
				<td><center>Last Name<td></center>
				<td><center>Department<td></center>
				<td><center>Position<td></center>
				<td><center>Supervisor<td></center>
				<td><center>Phone Number<td></center>
				<td><center>Email Address<td></center>
				<td><center>Username<td></center>
				<td><center>Password<td></center>
				
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
            $results = $conn->query("select employeenumber, firstname, lastname, department, position, supervisor, officephone, emailaddress, username, password from employee where not employeenumber ='10'");
            while($row = $results->fetch_assoc()) {
            ?>
                <tr>
					<td><center><?php echo $row['employeenumber']?><td></center>
                    <td><center><?php echo $row['firstname']?><td></center>
                    <td><center><?php echo $row['lastname']?><td></center>
					<td><center><?php echo $row['department']?><td></center>
					<td><center><?php echo $row['position']?><td></center>
                    <td><center><?php echo $row['supervisor']?><td></center>
					<td><center><?php echo $row['officephone']?><td></center>
					<td><center><?php echo $row['emailaddress']?><td></center>
					<td><center><?php echo $row['username']?><td></center>
					<td><center><input disabled type ="" size="8" placeholder="***********"<?php echo $row['password']?></input></center><td>
					
                </tr>

            <?php
            }
            ?>
            </tbody>
            </table>
</section>
<section id="footer">
<footer>
<center>© 2019 - Wedgewood Pacific</center
</footer>
</section>

</body>


</html>