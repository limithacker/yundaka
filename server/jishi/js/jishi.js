
function cjs(e)
{
   	
	switch (e)
	{
	 case 1:
	 getid("jsdiv").innerHTML+=gt();
	 getid("jsdiv").innerHTML+="中<br/>";
	 break;
	 case 2:
	 getid("jsdiv").innerHTML+=gt();
	 getid("jsdiv").innerHTML+="开始<br/>";
	 break;
	  case 3:
	 getid("jsdiv").innerHTML+=gt();
	 getid("jsdiv").innerHTML+="提钻<br/>";
	 break;
	  case 4:
	 getid("jsdiv").innerHTML+=gt();
	 getid("jsdiv").innerHTML+="一次提钻结束<br/>";
	 break;
	 case 5:
	 getid("jsdiv").innerHTML+=gt();
	 getid("jsdiv").innerHTML+="完全结束<br/><br/>";
	 break;
	 case 10:
	 if (getid("zdy").value!="")
	 {getid("jsdiv").innerHTML+=gt();
	  getid("jsdiv").innerHTML=getid("jsdiv").innerHTML+getid("zdy").value+"<br/>";}
	 break;
	
		
		
	}
	
	getid("zdy").value="";
	$('html,body').animate({scrollTop: $('.bottom').offset().top}, 0);
}


function getid(e)
{ return document.getElementById(e);}

function gt()
{
   var nowt=new Date();
   var ttxt=(nowt.getMonth()+1)+"."+nowt.getDate()+"&nbsp;"+nowt.getHours()+"\:"+nowt.getMinutes()+"&nbsp;";
   return ttxt;

}


function yun(e)
{
	if (e==1)
	{str=getid("jsdiv").innerHTML;}
	else
	{str=getid("jilustr").value;}
	
	//alert (str);
	
    $.ajax({
		   type:"POST",
		   url:"cl.php",
		   dataType:"json",
		   data:{tp:e,str:str},
		   success:function(data,textStatus){
			   if (data==1)
			   { getid("yun").innerHTML="同";
			     setTimeout("getid('yun').innerHTML='云';",2000);
				  if (e==1)
                  {getid("jsdiv").innerHTML="";}
				 
			   }
			   else
			   {
				   getid("yun").innerHTML="断";
			     setTimeout("getid('yun').innerHTML='云';",2000);
				}
			},
		   error:function(){ getid("yun").innerHTML="断";
			     setTimeout("getid('yun').innerHTML='云';",2000);}
			 
		});
	
  

}