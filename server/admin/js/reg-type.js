
$(function(){
	$("#yg-reg").click(function(){regtypeajax(2);});
	$("#qy-reg").click(function(){regtypeajax(1);});
});


function regtypeajax(e){

$.ajax({
		   type:"GET",
		   url:"/reg.php",
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
					{alert ("注册成功!")}		 
					else
					{ alert ("注册失败！请检查网络");
					  
					}  
		   },
		   error:function(){}
			 
		});	
};