<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"> 
<title>Wedgewood Pacific</title>
<link rel="stylesheet" type="text/css" href="wpstyle.css">
<script>
function goToNewPage() {
    if(document.getElementById('target').value){
        window.location.href = document.getElementById('target').value;
    }
}
</script>
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
<section id="main">
<br>
<br>
<h3>Query Database</h3>
<form name="dropdown">
 <select name="list" id="target">
 <option value="assignment.php">Please select one</option>
 <option value="employee.php">Employee</option>
 <option value="assignment.php">Assignment</option>
 <option value="project.php">Project</option>
 <option value="department.php">Department</option>
 <select>
 <input type=button value="Go" onclick="goToNewPage(document.dropdown.list)">
</form>
<br>
<div style="height:550px;width:375px;font:16px/26px Georgia, Garamond, Serif;overflow:auto;">
                <table border ="1">
        <thead>
            <tr>
                <td><center>ProjectID<td></center>
                <td><center>EmployeeNumber<td></center>
				<td><center>HoursWorked<td></center>
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
            $results = $conn->query("SELECT * FROM assignment where not employeenumber='10' order by projectid");
            while($row = $results->fetch_assoc()) {
            ?>
                <tr>
                    <td><center><?php echo $row['ProjectID']?><td></center>
                    <td><center><?php echo $row['EmployeeNumber']?><td></center>
					<td><center><?php echo $row['HoursWorked']?><td></center>
                </tr>

            <?php
            }
            ?>
            </tbody>
            </table>
</div>
</section>
<section id="footer">
<footer>
<center>© 2019 - Wedgewood Pacific</center
</footer>
</section>

</body>


</html>