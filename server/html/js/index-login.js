$(function(){
	$("#loginbtn").click(function(){
		
		$.ajax({
		   type:"GET",
		   url:"/login.php",
		   dataType:"json",
		   data:{usn:$("#usn").val(),psw:$("#psw").val()},
		   success:function(data,textStatus){
			   
					if (data.return==0)
					{alert ("密码错误或用户未经审核!")}		 
					else
					{ $api.setStorage('auth',data.auth);
					  $api.setStorage('type',data.return);
					  if (data.return==1)
					  {window.location.href="admin-index.html";}
					  else if (data.return==2) 
					  {window.location.href="user-index.html";}
					  else
					  {alert ("返回值错误!请检查网络连接");}
					  
					}  
		   },
		   error:function(){}
			 
		});
		
		
	});
	

});


