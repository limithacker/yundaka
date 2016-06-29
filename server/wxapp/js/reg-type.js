
$(function(){
	$("#yg-reg").click(function(){regtypeajax(2);});
	$("#qy-reg").click(function(){regtypeajax(1);});
});


function regtypeajax(e){

$.ajax({
		   type:"GET",
		   url:"http://s1.xuyanzhe.cn/yundaka/reg.php",
		   timeout : 5000,
		   dataType:"text",
		   data:{type:e,
			     usn:$("#usn").val(),
		         psw:$("#psw").val(),
				 tel:$("#tel").val(),
				 name:$("#name").val(),
				 cmpid:$("#cmpid").val()
				 },
		   success:function(data,textStatus){
			   
					if (data==1)
					{alert ("注册成功!");
					window.location.href="http://s1.xuyanzhe.cn/yundaka/wxapp/index.php";	
					}		 
					else if(data==3)
					{
						alert ("注册失败！用户名已存在");
					}
					else if(data==4)
					{ alert ("注册失败！公司ID不存在");
					}
					else
					{ alert ("注册失败！请检查网络");
					  
					}  
		   },
		   error:function(){}
			 
		});	
};