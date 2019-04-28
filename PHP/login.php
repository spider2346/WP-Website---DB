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
<h3> Menu </h3>
	<ul>
		<li><a href="login.html">Back</a></li>
	</ul>
</section>
<body>
<?php



$servername = "localhost";
$dbname = "wp";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

	if (isset($_POST['login'])) {
        # Publish-button was clicked

	$username = $_POST['username'];
	$password = $_POST['password'];
	
	$count = "SELECT count(Username), count(Password) from employee where Username = ? and Password = ?";
	
	$stmt = $pdo->prepare($count);
	
	$stmt->execute([$username, $password]);
	
	$result = $stmt->fetchColumn();

	if ($result == 1)
	{
		$count = "SELECT FirstName, LastName, Department, Position, Supervisor, OfficePhone, EmailAddress, Username, Password from employee where username = ?";
	
		$stmt = $pdo->prepare($count);
	
		$stmt->execute([$username]);		
	}
		else
	{
		header('location: wrong_login.html');
		die;
	}   
		
	}
    elseif (isset($_POST['admin'])) {
		
	$username = $_POST['username'];
	$password = $_POST['password'];
	$sauser = "admin";
	
	
	$count = "SELECT count(Username), count(Password) from employee where Username = ? and Password = ?";
	
	$stmt = $pdo->prepare($count);
	
	$stmt->execute([$username, $password]);
	
	$result = $stmt->fetchColumn();

		
	if ($result == 1 AND $username == $sauser)
	{
		header('location: admin.html');
		die;
	}
		else
	{
		header('location: wrong_login.html');
		die;
	}
    }
?>
<br>
<br>
<h3>Employee Information</h3>
<div style="height:350px;width:1200px;font:14px/24px Georgia, Garamond, Serif;overflow:auto;">
        <table border="1">
        <thead>
            <tr>
                <th><center>First Name</center></th>
                <th><center>Last Name</center></th>
				<th><center>Department</center></th>
				<th><center>Position</center></th>
                <th><center>Supervisor</center></th>
				<th><center>Office Phone</center></th>
				<th><center>Email</center></th>
				<th><center>Username</center></th>
				<th><center>Password</center></th>
            </tr>
        </thead>
		<tbody>
        
				<?php foreach($stmt as $row) : ?>
		        <tr>
                    <td><center><?php echo $row['FirstName']; ?></center></td>
                    <td><center><?php echo $row['LastName']; ?></center></td>
                    <td><center><?php echo $row['Department']; ?></center></td>
					<td><center><?php echo $row['Position']; ?></center></td>
                    <td><center><?php echo $row['Supervisor']; ?></center></td>
                    <td><center><?php echo $row['OfficePhone']; ?></center></td>
                    <td><center><?php echo $row['EmailAddress']; ?></center></td>
					<td><center><?php echo $row['Username']; ?></center></td>
					<td><center><?php echo $row['Password']; ?></center></td>
                </tr>
				<?php endforeach;?>

		</table>
				
           </tbody> 
	</body>
	</div>
	<section id="main">
</section>
<section id="footer">
<footer>
<center>© 2019 - Wedgewood Pacific</center
</footer>
</section>
</body>
</html>