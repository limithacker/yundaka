<?
session_start();
include "../common.inc.php";
$rid=$_GET['rid'];
$con = mysql_connect($server,$username,$password);
if (!$con)
  {
  die('Lets Fvck this database!' . mysql_error());
  }
//else {echo "login database ok<\br>";}
$db_selected = mysql_select_db($database,$con);
$rulesql=mysql_query("SELECT * FROM ydk_rule WHERE `rid`=$rid;");
$ruleresult=mysql_fetch_array($rulesql);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="css/global.css" />
<link rel="stylesheet" href="css/css.css" />
<link rel="stylesheet" href="css/manhuaDate.css" />
<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="js/manhuaDate.1.0.js"></script>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=BubV96ANNHQqYZ1HU7eSA0jf"></script>
<script type="text/javascript" src="http://api.map.baidu.com/library/DrawingManager/1.4/src/DrawingManager_min.js"></script>
<link rel="stylesheet" href="http://api.map.baidu.com/library/DrawingManager/1.4/src/DrawingManager_min.css" />
<script type="text/javascript" src="http://api.map.baidu.com/library/SearchInfoWindow/1.4/src/SearchInfoWindow_min.js"></script>
<link rel="stylesheet" href="http://api.map.baidu.com/library/SearchInfoWindow/1.4/src/SearchInfoWindow_min.css" />
<title>复制规则--云考勤管理中心</title>
</head>

<body>
<div class="cmpbdiv">
<div class="cmpdiv">

<div class="cldiv">
<div class="cls">
<img src="" alt="" class="logo"/>
<div class="cmptitle">复制规则<small>--除日期外均不可更改。如做改动请重新添加规则</small></div>
<div class="cb"></div>
</div>

<div class="clx">
日期：<input type="text" class="cl" id="date" value="<? echo $ruleresult['date'];  ?>" readonly/>
时间：<input type="text" class="cd" id="sh" value="<? echo $ruleresult['sh'];  ?>" disabled/>时<input type="text" class="cd" id="sm" value="<? echo $ruleresult['sm'];  ?>" disabled/>分~<input type="text" class="cd" id="eh" value="<? echo $ruleresult['eh'];  ?>" disabled/>时<input type="text" class="cd" id="em" value="<? echo $ruleresult['em'];  ?>" disabled/>分&nbsp;&nbsp;规则名称：<input type="text" class="cd2" id="rulename" value="<? echo $ruleresult['rulename'];  ?>" disabled/>
员工ID：

<input type="text" class="usid" id="usid" value="<? echo $ruleresult['userid'];  ?>" disabled/>


<input type="hidden" id="plog" value=""/>
<input type="hidden" id="plat" value=""/>
<input type="hidden" id="r" value=""/>
</div>

</div><!--cldiv end-->

<div class="crdiv">
<a href="javascript:;" class="lan" id="addrule">复制规则</a>
</div>
</div>
</div>


<div class="mapdiv" id="map"></div>

</body>

<script>
	var yuans=[];



$(function(){

    var map = new BMap.Map('map');
    var poi = new BMap.Point(<? echo $ruleresult['loc'];  ?>,<? echo $ruleresult['lat'];  ?>);
    map.centerAndZoom(poi, 16);
    map.enableScrollWheelZoom();  
	


    
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
				 plog:"<? echo $ruleresult['loc'];  ?>",
				 plat:"<? echo $ruleresult['lat'];  ?>",
				 r:"<? echo $ruleresult['r'];  ?>"
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
</script>
</html>
