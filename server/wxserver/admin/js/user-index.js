var jd="";
var wd="";
var addr="";
var street="";

$(function(){
	
	flushpos();
	
	
	
	
	
	
	$("#sub").click(function(){
		
		$.ajax({
		   type:"GET",
		   url:"/check.php",
		   dataType:"json",
		   data:{log:$("#jd").val(),
		         lat:$("#wd").val(),
				 pos:$("#addr").val(),
				 str:$("#street").val(),
				 auth:$api.getStorage("auth")
				 },
		   success:function(data,textStatus){
			   
					if (data.return==1)
					{alert ("打卡成功!");}		 
					else
					{
						alert ("打卡失败 请检查网络");
					}  
		   },
		   error:function(){}
			 
		});
		
		
	});
	
	
});


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
    } else{
        api.alert({msg:err.msg});
    }
});


$.ajax({
		   type:"GET",
		   url:"http://api.map.baidu.com/geocoder",
		   dataType:"json",
		   data:{location:jd+","+wd,
		         coord_type:"gcj02",
				 output:"json"
				 },
		   success:function(data,textStatus){
			   
					if (data.status=="OK")
					{
						addr=data.formatted_address;
					   	street=data.addressComponent.street;
					}		 
					else
					{
						alert ("获取位置信息失败");
					}  
		   },
		   error:function(){}
			 
		});

$("#jd").val(jd);
$("#wd").val(wd);
$("#addr").val(addr);
$("#street").val(street);


	
};

