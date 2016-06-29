$(function(){
	
	auth = $api.getStorage("auth");

	
	$.ajax({
		   type:"GET",
		   url:"/info.php",
		   dataType:"json",
		   data:{auth:auth},
		   success:function(data,textStatus){
			  var tstr="";
			  tstr+="<div class='company_name mt30'>"+data.cname+"</div><div class='company_info mt25'><p>公司ID："+data.cid+"</p><p>外勤人员数："+data.num+"人</p><p>帐号有效期："+data.Avail+"</p></div>";
			  $("#info").html(tstr);
			  
		   },
		   error:function(){}
			 
		});
	


});