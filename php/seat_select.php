<?php
	session_start();  ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">  <!-- 以上代码告诉IE浏览器，IE8/9及以后的版本都会以最高版本IE来渲染页面。 -->  
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>座位预约管理系统——选择座位</title>
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
			<a href="login.php" id="logout">退出
			<img src="../images/out.png" alt="注销登录"></a>
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


			<form class="seat-info" action="" method="post" id="seat-info1">
				<div id="info1" style="position:relative;">
				<span style="margin-left: 100px">选择教室：</span>
				<label >
					<span style="margin-left:100px;width:100px;overflow:hidden" >						
						<select style="width:118px;margin-left:-100;height:25px" 
								onchange="RidChange()"  name="r_id" id="rid">
							<option value="0">--- </option>   
							<option value="1">自习室 1</option>   
							<option value="2">自习室 2</option>
							<option value="3">自习室 3</option>
							<option value="4">自习室 4</option>
						</select>			 
					</span>
				</label>									
				</div>
			
			<script type="text/javascript">
				function RidChange() {
					document.getElementById("seat-info1").submit();
				}
			</script>
			
			<?php
				error_reporting(E_ERROR);
				$con = mysql_connect("localhost","root","");
				//con定义mysql的服务器信息，并打开数据库，服务器是本地（localhost）,用户名：peter,密码：abc123
				if (!$con){ 
					die('Could not connect: ' . mysql_error());
				}
				mysql_select_db("seat", $con);//设置当前活动的 MySQL 数据库。
				$Roomid = $_POST['r_id'];
				
				$result = mysql_query("SELECT * FROM facility where f_roomno='$Roomid'") or die(mysql_error());//执行查询操作，将会返回的包含所有筛选结果的结果集存入变量result中
				
				?>

				<table id="table" border="1" align="center" cellpadding="12px">
					<tr>
						<td align="center">座位编号 </td>
						<td align="center">当前状态</td>
					</tr>
					<?php
						while ($row = mysql_fetch_array($result))
						{
					?>
						<tr>
							<?php
								echo 
									"<td><a href='seat_details.php?id=".$row["f_id"]."'>
										编号：".$row["f_id"]."
									</a></td>"; 
								echo 
									"<td>
										状态：
										
											".$row["f_using"]."
										
									</td>";
							?>
						</tr>
					<?php
						} 		
						mysql_close($con);
					?>
				<!-- //执行查询操作，将会返回的包含所有筛选结果的结果集存入变量result中 -->
				

			</table>
			</form>
		</div> 
	</div>

	<script type="text/javascript" src="../script/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="../script/common.js"></script>
	<script type="text/javascript" src="../script/seat_select.js"></script>
</body>
</html>