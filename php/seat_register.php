<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">  <!-- 以上代码告诉IE浏览器，IE8/9及以后的版本都会以最高版本IE来渲染页面。 -->  
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>座位预约管理系统——签到</title>
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../css/common.css">
	<link rel="stylesheet" href="../css/seat-register.css">
</head>
<style>
    body{text-align: center}
    .layoutSeat{
        margin: auto;
        width:420px;
        height:200px;
        border:1px;
        solid-color:#b3d4fc;
        background-color: #b3d4fc;
        font-size: large;
    }
    #info{
        float:inherit;
        margin-top: 30px;

    }
    #seat_cancel{
        background-color: yellow;
    }
    #handle{
        width:150px;
        height:30px;
        background-color: #ffff00;
    }
</style>
<body>
	<header>
		<div class="logo">
			<img src="../images/logo1.jpg" alt="BNUlogo" class="logo-img vertical-center">
			<h1 class="vertical-center">座位预约管理系统</h1>
		</div>

		<!-- <?php // vardump($_SESSION);  ?> -->

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
			<a href="./login.php" id="logout">
				<img src="../images/out.png" alt="注销登录">
			</a>
		</div>
	</header><!-- header结束 -->

	<div class="container" style="margin:20px auto;">
		<nav class="nav-list">
			<a href="index.php" class="nav-item" id="nav-item1">
				<span class="iconfont">&#xe63e;</span>
				<span class="item-info">主页</span>
			</a>
			<a href="seat_select.php" class="nav-item" id="nav-item2">
				<span class="iconfont">&#xe604;</span>
				<span class="item-info">预约座位</span>
			</a>
			<a href="seat_register.php" class="nav-item" id="nav-item3">
				<span class="iconfont">&#xe601;</span>
				<span class="item-info" style="display: none;">签到</span>
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
			<span class="triangle" style="left: 325px;"></span>
		</nav>	
    <!-- <div class="layoutSeat"> -->

	    <table  class=layoutSeat align="center" id="info">
	        <?php
            $mysqli = new mysqli("localhost", "root", "", "seat");
            function finish($ret) {
                echo "{\"error\": \"$ret\"}";
                die;
            }
            if(mysqli_connect_error()) {
                echo mysqli_connect_error();
            }
            $mysqli->set_charset("utf8");
            $tem_uid = $_SESSION['u_id'];
            $sql = "SELECT * FROM user WHERE u_id = '$tem_uid' ";
            $result = $mysqli->query($sql);
            $f_room = '';
            $u_seat = '';

            if ($result) {
                if ($result->num_rows > 0) {// 输出数据
                    while($row = $result->fetch_assoc()) {
                        $u_seat=$row["u_seat"];
                    }
                    $result->close();

                    if($result=$mysqli->query("SELECT * FROM facility WHERE f_id = '$u_seat'")) {
                        if ($result->num_rows > 0) {// 输出数据
                            while($row = $result->fetch_assoc()) {
                                $f_room=$row["f_roomno"];
                            } 
                            $result->close();
                        }
                    }
                }
            }
        ?>
	    
	        <tr>
	            <td><?php echo $_SESSION['u_name']?></td>
	            <td>同学你好，你的预约信息如下：</td>
	        </tr>
	        <td>地点：</td>
	        <td><?php echo $f_room ?></td>
	        </tr>
	        <tr>
	            <td>座位：</td>
	            <td><?php echo $u_seat ?></td>
	        </tr>
	    </table>


    <br><br>
	    <div>
	       	<?php

	       	if(isset($_GET['do']) && $_GET["do"]=="yes"){
                $servername = "localhost";
                $username   = "root";
                $password   = "";
                $connent    = new mysqli($servername,$username,$password,"seat");
                $using = "";
                if($connent->connect_error){
                    die("Could not connect:".$connent->connect_error);
                }
                //else{
                    //echo "success";
                //}
               	$res = mysqli_query($connent, "SELECT * from user where u_id='".$_SESSION['u_id']."'");
               	$field_info_arr = $res->fetch_fields();
               	while($row = $res->fetch_assoc()){
			    	$using = $row['u_using'];
				}
                mysqli_query($connent,"UPDATE user set u_using='2' WHERE u_id='".$_SESSION['u_id']."'");
                mysqli_query($connent,"UPDATE facility set f_using='2' where f_id='" . $u_seat . "'");
                
                $connent->close();
            } 
	    	?>

	        <button id="handle"
            onclick="
                if(confirm('确定要进场吗？')){
                	if ($using=1) {
                		alert('签到成功！');
	                    cmdclick();
	                    return true;
                	}
                	else if ($using = 0) {
                		alert('您没有已预约的座位！');
                		// cmdclick();
                		return false;
                	}
                	else if ($using = 2) {
                		alert('您已入场！');
                		return false;
                	}
                }
                return false;"
        >
        签   到
        </button>

    </div>
</div>
<script type="text/javascript" src="../script/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="../script/common.js"></script>
<script type="text/javascript">
    function cmdclick(){
        document.location.href="?do=yes";}
</script>
</body>
</html>