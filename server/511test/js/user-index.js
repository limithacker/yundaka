var jd="";
var wd="";

$(function(){
	flushp();
	
	/*
	$("#loginbtn").click(function(){
		
		$.ajax({
		   type:"GET",
		   url:"/login.php",
		   dataType:"json",
		   data:{usn:$("#usn").val(),lcid:$("#psw").val()},
		   success:function(data,textStatus){
			   
					if (data.return==0)
					{alert ("密码错误或用户未经审核!")}		 
					else
					{ appcan.locStorage.setVal('auth',data.auth);
					  appcan.locStorage.setVal('type',data.return);
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
	
	*/
});


function flushp()
{
   	uexLocation.openLocation();
	$("#jd").val(jd);
	$("#wd").val(wd);
}

appcan.ready(function(){
   uexLocation.openLocation();	
});

 function onChange(lat, log){
       jd=log;
	   wd=lat; 
        
}

uexLocation.cbOpenLocation(opId, dataType, data)
{ if (data==1){alert ("无法获取位置信息");}}