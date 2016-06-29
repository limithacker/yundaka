var jd="";
var wd="";
var addr="";
var street="";

$(function(){
	
	flushpos();
	flushpos();
	flushpos();
	
});
function lkbx(){
		 $api.clearStorage();
		window.location.href="index.html";		
		
	};
function subm(){
		 
		$.ajax({
		   type:"GET",
		   url:"http://s1.xuyanzhe.cn/yundaka/check.php",
		   timeout : 5000,
		   dataType:"text",
		   data:{log:$("#jd").val(),
		         lat:$("#wd").val(),
				 pos:$("#addr").val(),
				 str:$("#street").val(),
				 auth:$api.getStorage('auth')
				 },
		   success:function(data,textStatus){
			   
					if (data==1)
					{alert ("打卡成功!");}		 
					else
					{
						alert ("打卡失败 请检查网络或重新登录");
					}  
		   },
		   error:function(){}
			 
		});
		
		
	};
function flushpos(){

	var baiduLocation = api.require('baiduLocation');
     baiduLocation.startLocation({
             accuracy: '100m',
             filter:1,
             autoStop: true
        }, function(ret, err){
    var sta = ret.status;
    var lat = ret.latitude;
    var lon = ret.longitude;
    var t = ret.timestamp;
    if(sta){
        jd=lon;
		wd=lat;
		var map = new BMap.Map("l-map");      
		var myGeo = new BMap.Geocoder();      
		myGeo.getLocation(new BMap.Point(jd,wd), function(result){      
						 if (result){      
							addr=result.address;  
							street=result.addressComponents.street;
							 
						  } 
						else{
							alert ("获取位置信息失败");
						}
						
		});
		
	
    } else{
        api.alert({msg:err.msg});
    }
});


var myDate = new Date();
var dt=myDate.toLocaleString();
$("#time").val(dt);
$("#jd").val(jd);
$("#wd").val(wd);
$("#addr").val(addr);
$("#street").val(street);


	
};

