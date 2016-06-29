	var yuans=[];



$(function(){

    var map = new BMap.Map('map');
    var poi = new BMap.Point(117.204264,39.124326);
    map.centerAndZoom(poi, 16);
    map.enableScrollWheelZoom();  
	

	
	var yuancss = {
        strokeColor:"red",    //边线颜色。
        fillColor:"red",      //填充颜色。当参数为空时，圆形将没有填充效果。
        strokeWeight: 3,       //边线的宽度，以像素为单位。
        strokeOpacity: 0.8,	   //边线透明度，取值范围0 - 1。
        fillOpacity: 0.6,      //填充的透明度，取值范围0 - 1。
        strokeStyle: 'solid' //边线的样式，solid或dashed。
    };

	
	 //实例化鼠标绘制工具
    var drawingManager = new BMapLib.DrawingManager(map, {
        isOpen: false, //是否开启绘制模式
        enableDrawingTool: true, //是否显示工具栏
        drawingToolOptions: {
            anchor: BMAP_ANCHOR_TOP_RIGHT, //位置
            offset: new BMap.Size(5, 5), //偏离值
			drawingModes: [BMAP_DRAWING_CIRCLE] //仅画圆
        },
        circleOptions: yuancss, //圆的样式
        polylineOptions: yuancss, //线的样式
        polygonOptions: yuancss, //多边形的样式
        rectangleOptions: yuancss //矩形的样式
    });  
	
	var drawf=function(e){
	   map.removeOverlay(yuans[0]);
	  yuans.shift();	
	  yuans.push(e.overlay);
	  $("#r").val(yuans[0].getRadius());
	  $("#plog").val(yuans[0].getCenter().lng);
	  $("#plat").val(yuans[0].getCenter().lat);
	 
	}

    drawingManager.addEventListener('overlaycomplete', drawf);
	
	$("#reset").click(function(){
		$("input:text").val("");
		for(var i = 0; i < yuans.length; i++){
            map.removeOverlay(yuans[i]);
        }
         yuans.length=0;
	});
    
	$("#addrule").click(function(){
		if(document.getElementById("date").value==''){
			alert("日期不能为空");
			return 0;
		}
		if(document.getElementById("sh").value==''){
			alert("起始时间不能为空");
			return 0;
		}
		if(document.getElementById("sm").value==''){
			alert("起始时间不能为空");
			return 0;
		}
		if(document.getElementById("eh").value==''){
			alert("结束时间不能为空");
			return 0;
		}
		if(document.getElementById("rulename").value==''){
			alert("规则名称不能为空");
			return 0;
		}
		
		
		
		$.ajax({
		   type:"GET",
		   url:"/admin/addrule.php",
		   dataType:"text",
		   data:{
			     usid:$("#usid").val(),
		         date:$("#date").val(),
				 sh:$("#sh").val(),
				 sm:$("#sm").val(),
				 eh:$("#eh").val(),
				 em:$("#em").val(),
				 rulename:$("#rulename").val(),
				 plog:$("#plog").val(),
				 plat:$("#plat").val(),
				 r:$("#r").val()
				 },
		   success:function(data,textStatus){
			   
					if (data==1)
					{alert ("添加成功!")}		 
					else
					{ alert ("添加失败，请重新填写信息");
					  $("input:text").val("");
						for(var i = 0; i < yuans.length; i++){
							map.removeOverlay(yuans[i]);
						}
						yuans.length=0;
					}  
		   },
		   error:function(){}
			 
		});	
		
	});
	
	
	$("#date").manhuaDate({					       
		Event : "click",//可选				       
		Left : 0,//弹出时间停靠的左边位置
		Top : -24,//弹出时间停靠的顶部边位置
		fuhao : "-",//日期连接符默认为-
		isTime : false,//是否开启时间值默认为false
		beginY : 2010,//年份的开始默认为1949
		endY :2015//年份的结束默认为2049
	});
	
	
	
});