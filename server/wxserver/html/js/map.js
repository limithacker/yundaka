$(function(){

 var wh=document.documentElement.clientHeight; 
 var divh=wh-128;
 $("#mapdiv").css({"height":divh+"px"});

 var map = new BMap.Map("mapdiv");  
 var point = new BMap.Point(116.404, 39.915);
	map.centerAndZoom(point,15);
	map.addControl(new BMap.ZoomControl());
	
});