<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"> 
<title>Wedgewood Pacific</title>
<link rel="stylesheet" type="text/css" href="wpstyle.css">
</head>

<body>
<section id="top">
<center><img src="banner.jpg" alt="banner" style="width:1500px;height:300px;" border ="2"></center>
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
<section id="main"><section id="main"><br><br>
<h3>Current Employees</h3>
         <table border="1">
        <thead>
            <tr>
                <td><center>Emp#<td></center>
                <td><center>First Name<td></center>
				<td><center>Last Name<td></center>
				<td><center>Department<td></center>
				<td><center>Office Phone<td></center>
				
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
					<td><center><?php echo $row['employeenumber']?><td></center>
                    <td><center><?php echo $row['firstname']?><td></center>
                    <td><center><?php echo $row['lastname']?><td></center>
					<td><center><?php echo $row['department']?><td></center>
					<td><center><?php echo $row['officephone']?><td></center>
					
                </tr>

            <?php
            }
            ?>
            </tbody>
            </table>
<h4>Update Office Phone Number</h4>
<form method="post" action="changephone.php">
<p>Employee Number:   &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" name="employeenumber" required pattern= "[0-9]+" title="Please enter a digit. 0-9"  size="4" maxlength="4" /></p>
<p>New Office Phone:  &nbsp&nbsp&nbsp&nbsp&nbsp <input type="tel" required pattern="(?:\(\d{3}\)|\d{3})[- ]?\d{3}[- ]?\d{4}" title="123-456-7890" name="officephone"/></p>
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