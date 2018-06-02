<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">  <!-- 以上代码告诉IE浏览器，IE8/9及以后的版本都会以最高版本IE来渲染页面。 -->  
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>导航页</title>
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../css/common.css">
	<link rel="stylesheet" href="../css/main.css">
</head>
<body>
	<!--[if lte IE8]>
	<p class="browserupdate">您的浏览器版本太老，请到<a href="http://browsehappy.com">这里</a>更新，以获取最佳的浏览体验。</p>
	<![endif]-->
	<header>
		<div class="logo">
			<img src="../images/logo1.jpg" alt="BNUlogo" class="logo-img vertical-center">
			<h1 class="vertical-center">座位预约管理系统</h1>
		</div>

		<!-- <?php echo $_SESSION['u_name'];?> -->

		<div class="logoff">
			<a href="index.php">
			<span>
			<em class="username">
				<?php
				if(isset($_SESSION["u_name"]) && !empty($_SESSION["u_name"]) )
					echo $_SESSION["u_name"];
				else
					echo "error";
				?>
			</em>（ 
			<em class="usernum">
				<?php
				if (isset($_SESSION['u_id']) && !empty($_SESSION['u_id']))
					echo $_SESSION['u_id'];
				?>
			</em> ）
			</span>
			</a>
			<a href="./login.php" id="logout">退出
				<img src="../images/out.png" alt="注销登录">
			</a>
		</div>
	</header><!-- header结束 -->
	<div class="container">
		<section class="person-info box">
			<img src="../images/my.png" alt="用户图片" class="horizontal-center">
			<div class="horizontal-center">
				<span>姓名：<em class="username">
					<?php
					if(isset($_SESSION['u_name']) && !empty($_SESSION['u_name'])){
						echo $_SESSION['u_name'];
					}
					else 
						echo "error";
				?>
				</em></span>
				<span>学号：<em class="usernum">
					<?php
					if (isset($_SESSION['u_id']) && !empty($_SESSION['u_id'])){
						echo $_SESSION['u_id'];
					}
					else
						echo "error";
				?>
				</em></span>
				<span><em class="username">
					<?php
						$db_host = 'localhost';
						$db_user = 'root';
						$db_pwd = '';
						$db_name = 'seat';
						$mysqli = new mysqli($db_host, $db_user, $db_pwd, $db_name);
						if(mysqli_connect_error()){
						    echo mysqli_connect_error();
						}
						$sql = "select * from user where u_id = '".$_SESSION['u_id']."' and (u_using = '1' or u_using='2')"  ;
						$result = $mysqli->query($sql);
						if($result === false){//执行失败
						    echo $mysqli->error;
						    echo "认证失败";
						}
						$row = mysqli_fetch_assoc($result);
						if ($row){
							$useat	=	$row['u_seat']; 
							echo "当前座位号：".$row['u_seat']."";
						}
						else
							echo "现在没有预约或使用座位。";
				?>
				</em></span>
			</div>
		</section>
		<section class="seat-select box">
			<img src="../images/seat1.png" alt="座位预约" class="horizontal-center">
			<span class="horizontal-center">座位预约</span>
			<a href="seat_select.php"></a>
		</section>
		<section class="seat-operate">
			<div class="register box">
				<img src="../images/write.png" alt="签到" class="vertical-center">
				<span class="vertical-center">签到</span>
				<a href="seat_register.php"></a>
			</div>
			<div class="cancel-reserve box">
				<img src="../images/delete.png" alt="取消预约" class="vertical-center">
				<span class="vertical-center">取消预约</span>
				<a href="cancel_reserve.php"></a>
			</div>
		</section>
		<section class="seat-release box">
			<img src="../images/recyle.png" alt="释放座位" class="horizontal-center">
			<span class="horizontal-center">释放座位</span>
			<a href="seat_release.php"></a>
		</section>
		<section class="reserve-record box">
			<img src="../images/record.png" alt="预约记录" class="vertical-center">
			<span class="vertical-center">预约记录</span>
			<a href="reserve_record.php"></a>
		</section>
		<section class="notice-board box">
			<img src="../images/warning.png" alt="公告栏" class="vertical-center">
			<div class="notice-info vertical-center">
				<h3>公告</h3>
				<p>图书馆2017.6.4闭馆通知</p>
			</div>
			<a href="notice.php"></a>
		</section>
		<section class="default-record box">
			<img src="../images/wrong.png" alt="违约记录" class="vertical-center">
			<span class="vertical-center">违约记录</span>
			<a href="default_record.php"></a>
		</section>
	</div><!-- container结束 -->
	<script type="text/javascript" src="../script/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="../script/main.js"></script>
</body>
</html>