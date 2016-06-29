$(function(){
	
	auth = $api.getStorage("auth");
	
	$.ajax({
		   type:"GET",
		   url:"http://s1.xuyanzhe.cn/yundaka/list.php",
		   timeout : 5000,
		   dataType:"json",
		   data:{auth:auth},
		   success:function(data,textStatus){
			  var tstr=""
			  for (i=0;i<data.length;i++)
			  {
				  tstr+="<div class='man_card'><div class='crl'>"+data[i].name+"</div><div class='crr'><p>打卡时间："+data[i].time+"</p><p class='pt'>"+data[i].position+"</p><p>"+data[i].loc+","+data[i].lat+"</p></div><div class='cb'></div></div>";
				  $(".contactb").html(tstr);
			  }
		   },
		   error:function(){}
			 
		});
	


});