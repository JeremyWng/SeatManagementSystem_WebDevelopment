<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">  <!-- 以上代码告诉IE浏览器，IE8/9及以后的版本都会以最高版本IE来渲染页面。 -->  
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>座位预约管理系统——释放座位</title>
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../css/common.css">
	<!---<link rel="stylesheet" href="../css/qzww.css">   -->   
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
		<div class="logoff">
			<a href="index.php">
			<span>
			<em class="username">
				<?php
					if(isset($_SESSION['u_name']) && !empty($_SESSION['u_name']))
						echo $_SESSION['u_name'];
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
			<a href="login.php" id="logout"><img src="../images/out.png" alt="注销登录"></a>
		</div>
	</header><!-- header结束 -->

	<div class="container" style="margin:20px auto;">
		<?php include 'header.php'; ?>
		<div class = "login-container">
			<?php
				
			    	set_time_limit(3000);
			    	$db_host = "localhost";
			     	$db_user = "root";
			     	$db_pwd = ""; 
			     	$db_name = "seat";
			     	$useat = "";
			     	
			     	$sql0 = "select u_seat from user where u_id = '".$_SESSION['u_id']."'";
			     	$sql1 = "update facility set f_using=0 where f_id = '".$useat."'";
			     	$sql2 = "update user set u_seat=null where u_id='".$_SESSION['u_id']."' ";
			     	$sql3 = "update user set u_using = 0 where u_id = '".$_SESSION['u_id']."'";

			     	$mysqli = new mysqli($db_host, $db_user, $db_pwd, $db_name);
					if(mysqli_connect_error()){		echo mysqli_connect_error();	}
					$mysqli->set_charset("utf8");
					
					$res0 = $mysqli->query($sql0);
						if($res0 === false){//执行失败
						    echo $mysqli->error;
						    echo "认证失败";
						}
					$row = mysqli_fetch_assoc($res0);
						if ($row){
							$useat	=	$row['u_seat']; 
							echo "获取当前座位成功";
						}
						else{
							echo "获取当前座位失败";
						}
				
					$res1 = $mysqli->query($sql1);
					$res2 = $mysqli->query($sql2);
					$res3 = $mysqli->query($sql3);
					// echo "<script> 
					//     	if(confirm( '释放座位成功！'))  
					//     		location.href='index.php';
					//     	</script>";			    
			?>

	<div class="container" style="margin:20px auto;">
		<div>
		    <h1>确定要释放您的座位吗？</h1>	
		   	<script type="text/javascript">  
		      	function check(){	
		      	// var url = 'http://localhost/b.php';
		      	alert("您的座位已成功释放，谢谢配合！");
		      	}
		   	</script>   
		    <!-- <a id="seat-sub" class="seat-sub" href="seat_release.php?release=true">确定</a> -->
		    <button id="handle"
            		onclick="
		                if(confirm('确定要释放座位吗？')){
		                    alert('释放座位成功！');
		                    cmdclick();
		                    return true;
		                }
		                return false;"
        	>
	        	   释放座位
	        </button>
		</div>
	</div>

	<script type="text/jsavascript" src="../script/jquery-3.1.1.min.js"> </script>
	<script type="text/javascript" src="../script/common.js"> </script>
	<script type="text/javascript">
	    function cmdclick(){
	        document.location.href="?do=yes";}
	</script>
</body>
</html>