

$(function(){
	
	$.ajax({
		   type:"GET",
		   url:"http://s1.xuyanzhe.cn/yundaka/wxserver/loc.php",
		   timeout : 5000,
		   dataType:"json",
		   data:{auth:auth
				 },
		   success:function(data,textStatus){
			   
			   var map = new BMap.Map("mapdiv");  
      var point = new BMap.Point(data[0].loc,data[0].lat);
	map.centerAndZoom(point,13);
	map.addControl(new BMap.ZoomControl());
			   
			   
			   
			   var marker=new Array();
			   for (i=0;i<data.length;i++)
			   {
				  marker[i] = new BMap.Marker(new BMap.Point(data[i].loc,data[i].lat));  //创建标注
	map.addOverlay(marker[i]);
			   
			   }
			  
		   },
		   error:function(){}
			 
		});	
	
	


});