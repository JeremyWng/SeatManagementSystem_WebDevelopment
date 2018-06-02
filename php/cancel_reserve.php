<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">  <!-- 以上代码告诉IE浏览器，IE8/9及以后的版本都会以最高版本IE来渲染页面。 -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>图书馆座位管理系统——取消预约</title>
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/common.css">
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
    <?php include 'header.php';?>
</div>



    <table class="layoutSeat" align="center" id="info">
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
            
               // echo "success";
                if ($result->num_rows > 0) {// 输出数据
                    while($row = $result->fetch_assoc()) {
                        $u_seat=$row["u_seat"];
                    }
                    $result->close();

 
                    if($result=$mysqli->query("SELECT * FROM facility WHERE f_id = '$u_seat'")) {
        
                        //echo "success";
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
            <td><?php echo $_SESSION['u_name']; ?></td>
            <td>同学，你的预约信息如下：</td>
        </tr>
        <td>地点：</td>
        <td><?php echo $f_room; ?></td>
        </tr>
        <tr>
            <td>座位：</td>
            <td><?php echo $u_seat; ?></td>
        </tr>

    </table>

    <br><br>
    <div>
        <?php
            // function query($u_seat) {
                // $servername = "localhost";
                // $username   = "root";
                // $password   = "";
                // $connent    = new mysqli($servername,$username,$password,"seat");
                // if($connent->connect_error){
                //     die("Could not connect:".$connent->connect_error);
                // }
                // else{
                //     echo "success";
                // }
               
                // mysqli_query($connent,"UPDATE user set u_using='0' WHERE u_id='".$_SESSION['u_id']."'");
                // mysqli_query($connent,"UPDATE user set u_seat=NULL where u_id='".$_SESSION['u_id']."'");
                // mysqli_query($connent,"UPDATE facility set f_using='0' where f_id='" . $u_seat . "'");
                // $connent->close();
            
            if(isset($_GET['do']) && $_GET["do"]=="yes"){
                $servername = "localhost";
                $username   = "root";
                $password   = "";
                $connent    = new mysqli($servername,$username,$password,"seat");
                if($connent->connect_error){
                    die("Could not connect:".$connent->connect_error);
                }
                //else{
                    //echo "success";
                //}
               
                mysqli_query($connent,"UPDATE user set u_using='0' WHERE u_id='".$_SESSION['u_id']."'");
                mysqli_query($connent,"UPDATE user set u_seat=NULL where u_id='".$_SESSION['u_id']."'");
                mysqli_query($connent,"UPDATE facility set f_using='0' where f_id='" . $u_seat . "'");
                $connent->close();
            } 
            // query($u_seat);
        ?>
        <button id="handle"
            onclick="
                if(confirm('确定要取消本次预约吗？')){
                    alert('取消成功！');
                    cmdclick();
                    return true;
                }
                return false;"
        >
        取消本次预约
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