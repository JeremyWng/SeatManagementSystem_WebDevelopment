/**
 * Created by Jeremy on 07/06/2017.
 */
/*
 var now=new Date();
 var hour=new gethour();
 var minute=new getminute();
 alert("xianzai"+hour+":"+minute+);


 if(confirm("")alert("yes");else alert("no")
 统计时间函数
 var online
 */
window.onload=check;
//当单击确定按钮时，执行下列函数完成退座


function check(user){
    var conn=new ActiveXObject("ADODB.Connection");
    conn.open();
    var rs = new ActiveXObject("ADODB.Recordset");
    var sql="update user set u_using="+'0';
    var sql="update facility set f_using= "+'0';
    conn.execute(sql);
    conn.close();


    $(button.seat-sub).hide();
    alert("    slkdjfa");
    // doucument.write("退座成功，谢谢您的配合！");
}