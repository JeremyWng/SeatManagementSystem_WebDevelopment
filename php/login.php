<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">  
	<!-- 以上代码告诉IE浏览器，IE8/9及以后的版本都会以最高版本IE来渲染页面。 -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>登录</title>
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../css/common.css">
	<link rel="stylesheet" href="../css/main.css">
</head>
<body>
	<header>
		<div class="logo">
			<img src="../images/logo1.jpg" alt="BNUlogo" class="logo-img vertical-center">
			<h1 class="vertical-center">座位预约管理系统</h1>
		</div>
	</header><!-- header结束 -->
	<div class="login-container">
		<section class="img-display vertical-center">
			<img src="../images/library.png" alt="">
			<img src="../images/books1.png" alt="">
			<img src="../images/seat.png" alt="">
			<img src="../images/computer.png" alt="">
		</section>
		<section class="login vertical-center">
			<form action="" name="mylogin" method="post" id="mylogin">
				<div>
					<span>学号：</span>
						<input type="text" id="id" name="id" maxlength="11">
				</div>
				<div>
					<span>密码：</span>
						<input type="password" id="pwd" name="pwd">
				</div>
				<button type="submit" value="Submit">
					登录
				</button>
			</form>
		</section>
	</div>
	
	<?php
		if (isset($_POST['id']) && isset($_POST['pwd'])){
			// error_reporting(~E_ALL);
		$db_host = 'localhost';
		$db_user = 'root';
		$db_pwd = '';
		$db_name = 'seat';
		$id = $_POST['id'];
    	$pwd = $_POST['pwd'];

    	$sql = "SELECT * FROM user WHERE u_id = '$id' AND u_password = '$pwd'";

		$mysqli = new mysqli($db_host, $db_user, $db_pwd, $db_name);
		if(mysqli_connect_error()){
		    echo mysqli_connect_error();
		}
		$mysqli->set_charset("utf8");
		
		$result = $mysqli->query($sql);
		if($result === false){//执行失败
		    echo $mysqli->error;
		    echo "认证失败";
		}
		
		$field_info_arr = $result->fetch_fields();
		$row = mysqli_fetch_assoc($result);
		
		if ($row){
			
		    $_SESSION["u_name"]		=	$row['u_name'];
			$_SESSION["u_id"]		=	$row['u_id'];
			$_SESSION["u_authority"]=	$row['u_authority'];
			$_SESSION["u_status"]	=	$row['u_status'];
			$_SESSION["u_using"]	=	$row['u_using']; 
			$_SESSION["u_seat"]	=	$row['u_seat']; 
			echo "认证成功";
			header('Location: index.php');
		}
		else
			echo "<script> 
		    	if(confirm( '账号或密码输入错误，请重新输入'))  
		    		location.href='login.php';
		    	</script> ";
		}
		
	?>



	<script type="text/javascript" src="../script/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="../script/login.js"></script>
</body>
</html>