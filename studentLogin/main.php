<?php
$error = false;
$name = "";
$Email = "";
$DOB = "";
$course = "";
require_once 'pdo.php';
	if(!isset($_GET['name'])){
		header('Location: index.php');
	}
	else{
		$sql = "SELECT * FROM student WHERE name = :name";
		$stmt = $pdo->prepare($sql);
		$stmt->execute(array(
			':name' => $_GET['name']
		));
		$rows = $stmt->fetch(PDO::FETCH_ASSOC);
		if($rows==false){
			$error = "USER NOT FOUND";
		}
		else{
			$name = $rows['name'];
			$Email = $rows['email'];
			$DOB = $rows['Dob'];
			$course = $rows['course'];
		}
	}
?>
<html>
<head>
	<title>Login Page</title>
	<style>
		*{
			box-sizing:border-box;
		}
		body{
			font-family:arial;
			font-size:24px;
		}
		label{
			display:inline-block;
			width:10%;
		}
		span{
			color:green;
		}
	</style>
</head>
<body>
<h1>Welcome To The Main Portal</h1>
<?php
	if($error!==false){
		echo "<span>".$error."</span>";
		echo "<br/>";
		echo "<a href='index.php'>Click Here To Go To Main Pages</a>";
	}
?>
	<?php
		if(($name != "") || ($Email != "") || ($DOB != "") || ($course != "")){
			echo "<p>Welcome To The Course ".$name."</p>";
			echo "<p>Your Email ".$Email."</p>";
			echo "<p>Your DOB ".$DOB."</p>";
			echo "<p>Your Course ".$course."</p>";
			echo "<p>So Let's Get Started</p>";
			echo strpos($course,'tml');
			if(strpos($course,'tml')==1){
				echo "<a target='_blank' href='https://www.w3schools.com/html/default.asp'>CLick Here To GO To The First Tutorial</a>";
			}
			else if(strpos($course,'ss')==1){
				echo "<a target='_blank' href='https://www.w3schools.com/css/default.asp'>CLick Here To GO To The First Tutorial</a>";
			}
			else if(strpos($course,'hp')==1){
				echo "<a target='_blank' href='https://www.w3schools.com/php/default.asp'>CLick Here To GO To The First Tutorial</a>";
			}
			else if(strpos($course,'ql')==1){
				echo "<a target='_blank' href='https://www.w3schools.com/sql/default.asp'>CLick Here To GO To The First Tutorial</a>";
			}
			echo "<br/>";echo "<br/>";
			echo "<a href='index.php'>Click Here To Exit</a>";
		}
	?>
</body>
</html>