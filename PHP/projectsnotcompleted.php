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
		<li><a href="admin.html">Back</a></li>
		<li><a href="assignedprojects.php">Assigned Projects</a></li>
		<li><a href="projectstartend.php">Project Start & End Dates</a></li>
		<li><a href="numberofprojects.php">Number of Projects</a></li>
		<li><a href="projectsnotcompleted.php">Projects Not Completed</a></li>
		<li><a href="wphome.html">Logout</a></li>
	</ul>
</section>
<section id="main">
<br>
<br>
<h3>In-Progress Projects</h3>
<div style="height:350px;width:800px;font:16px/26px Georgia, Garamond, Serif;overflow:auto;">
        <table border ="1">
        <thead>
            <tr>
                <td><center>ProjectID<td></center>
                <td><center>ProjectNamee<td></center>
				<td><center>Department<td></center>
				<td><center>MaxHours<td></center>
				<td><center>StatDate<td></center>
				<td><center>EndDate<td></center>
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
            $results = $conn->query("SELECT *
									FROM PROJECT
									WHERE EndDate IS NULL;");
            while($row = $results->fetch_assoc()) {
            ?>
                <tr>
                    <td><center><?php echo $row['ProjectID']?><td></center>
                    <td><center><?php echo $row['ProjectName']?><td></center>
					<td><center><?php echo $row['Department']?><td></center>
					<td><center><?php echo $row['MaxHours']?><td></center>
					<td><center><?php echo $row['StartDate']?><td></center>
					<td><center><?php echo $row['EndDate']?><td></center>
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