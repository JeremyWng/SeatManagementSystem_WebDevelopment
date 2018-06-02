<?php session_start();  ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">  <!-- 以上代码告诉IE浏览器，IE8/9及以后的版本都会以最高版本IE来渲染页面。 -->  
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>座位预约管理系统</title>
	<!-- 读取css样式 -->
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../css/common.css">
	<link rel="stylesheet" href="../css/seat_select.css">
</head>

<body>	
	<header>
		<div class="logo">
			<img src="../images/logo1.jpg" alt="BNUlogo" class="logo-img vertical-center">
			<h1 class="vertical-center">座位预约管理系统</h1>
		</div>
		<div class="logoff">
			<a href="index.php">
			<span>
			<em class="username">
				<?php
				if(isset($_SESSION["u_name"]) && !empty($_SESSION["u_name"])){
					echo $_SESSION["u_name"];
				}
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
			<a href="login.php" id="logout">
				退出
			<img src="../images/out.png" alt="注销登录">
			</a>
		</div>
	</header><!-- header结束 -->

	<div class="container">
		<nav class="nav-list">
			<a href="./index.php" class="nav-item" id="nav-item1">
				<span class="iconfont">&#xe63e;</span>
				<span class="item-info">主页</span>
			</a>
			<a href="seat_select.php" class="nav-item" id="nav-item2">
				<span class="iconfont">&#xe604;</span>
				<span class="item-info">预约座位</span>
			</a>
			<a href="seat_register.php" class="nav-item" id="nav-item3">
				<span class="iconfont">&#xe601;</span>
				<span class="item-info">签到</span>
			</a>
			<a href="cancel_reserve.php" class="nav-item" id="nav-item4">
				<span class="iconfont">&#xe64a;</span>
				<span class="item-info">取消预约</span>
			</a>
			<a href="seat_release.php" class="nav-item" id="nav-item5">
				<span class="iconfont">&#xe751;</span>
				<span class="item-info">释放座位</span>
			</a>
			<a href="reserve_record.php" class="nav-item" id="nav-item6">
				<span class="iconfont">&#xe610;</span>
				<span class="item-info">预约记录</span>
			</a>
			<a href="default_record.php" class="nav-item" id="nav-item7">
				<span class="iconfont">&#xe65f;</span>
				<span class="item-info">违纪记录</span>
			</a>
			<a href="notice.php" class="nav-item" id="nav-item8">
				<span class="iconfont">&#xe600;</span>
				<span class="item-info">公告栏</span>
			</a>
			<span class="triangle"></span>
		</nav>

		<div class="seat-content">
			<form class="seat-info" action="" method="post" id="seat-info2" align="center">
				<div id="info2">					
					<em >
						确定选择座位：<?php echo $_GET['id'];?> ？
					</em>
				</div>
				<button type="submit" value="submit" id="seat_sure" class="seat-sure" 
						onclick="
			                if(confirm('确定要选择座位 <?php echo $_GET['id'];?> 吗？')){
			                    alert('选择成功！'); cmdclick();
			                    return true;
			                }
                			return false;">
					确定
				</button>
			</form>
		
			<?php
				$fid=$_GET['id'];
				$con = mysql_connect("localhost","root","");
				if (!$con) { 
					die('Could not connect: '.mysql_error());
				}
				mysql_select_db("seat", $con);//设置当前活动的 MySQL 数据库。			
				
				mysql_query("UPDATE facility SET f_using=1 where f_id='$fid'");
				mysql_query("UPDATE user set u_seat = '$fid' where u_id = '".$_SESSION['u_id']."'");
				mysql_query("UPDATE user set u_using = 1");
				mysql_close($con);
			?>
		
		<div class="seat-map" id="seat-map"></div>
		</div> 
	</div>
	<script type="text/javascript" src="../script/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="../script/common.js"></script>
	<script type="text/javascript" src="../script/seat_select.js"></script>
</body>
</html>
		
		
		

				