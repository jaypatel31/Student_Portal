<?php
$error = false;
$msg = false;
require_once('pdo.php');
	if( isset($_POST['Email']) || isset($_POST['DoB'])){
		if(strlen($_POST['Email'])>1 || strlen($_POST['DoB'])>1){
			if(strpos($_POST['Email'],'@')>1){
				$sql = "SELECT name FROM student 
						WHERE email = :Email AND Dob = :DOB";
				$stmt = $pdo->prepare($sql);
				$stmt->execute(array(
					':Email' => $_POST['Email'],
					':DOB' => $_POST['DoB']
				));
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				if($row==false){
					$error = "USer Not Found!!";
					$msg = "<a href='signup.php'>Click Here To Sign Up</a>";
				}
				else{
					$error="SucessFully Loged In";
					Header('Location: main.php?name='.urlencode($row['name']));
					
				}
			}
			else{
				$error = "Invalid Email";
			}
		}
		else{
			$error = "All Feilds Are Required";
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
			color:red;
		}
	</style>
</head>
<body>
<h1>Welcome To The Login Portal</h1>
<?php
	if($error!==false){
		echo "<span>".$error."</span>";
	}
?>
	<form method="post">	
		<label for="email">Email : </label>
		<input type="email" name="Email" id="email"><br/><br/>
		<label for="dob">DOB : </label>
		<input type="date" name="DoB" id="dob"><br/><br/>
		<input type="submit"  id="submit">
	</form>
	<?php
		if($msg!==false){
			echo $msg;
		}
	?>
</body>
</html>