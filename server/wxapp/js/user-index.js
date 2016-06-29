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
		 //$api.clearStorage();
		window.location.href="index.html";		
		
	};

function flushpos(){
wx.getLocation({
		 type: 'gcj02',
		  success: function (res) {
			//alert(JSON.stringify(res));
			var latitude = res.latitude; // 纬度，浮点数，范围为90 ~ -90
			var longitude = res.longitude; // 经度，浮点数，范围为180 ~ -180。
			var speed = res.speed; // 速度，以米/每秒计
			var accuracy = res.accuracy; // 位置精度
			//alert(latitude+','+longitude);
			//转换位置
			var urla='http://api.map.baidu.com/geoconv/v1/?from=3\&to=5\&ak=BubV96ANNHQqYZ1HU7eSA0jf\&coords='+longitude+','+latitude;
			//alert(urla);
			$.ajax({
			   type:"GET",
			   url:urla,
			   async: false,
			   timeout : 5000,
			   dataType:"jsonp",
			   data:{ },
			   success:function(data){
				  // alert(data);
					var log2=data.result[0].x;
					var lat2=data.result[0].y;
					var urlb='http://api.map.baidu.com/geocoder/v2/?output=json\&ak=BubV96ANNHQqYZ1HU7eSA0jf\&location='+lat2+','+log2;
					//alert(urlb);
					setTimeout(function(){
						$.ajax({
						   type:"GET",
						   url:urlb,
						   async: false,
						   timeout : 5000,
						   dataType:"jsonp",
						   data:{ },
						   success:function(data2){
							   //alert(lat2log2);
							   //alert(data2);
							   var myDate = new Date();
								var dt=myDate.toLocaleString();
								$("#time").val(dt);
								$("#jd").val(log2);
								$("#wd").val(lat2);
								$("#addr").val(data2.result.formatted_address);
								$("#street").val(data2.result.addressComponent.street);
							   
							   
						   },
						   error:function(){//alert("errrr");
						   }
							 
						});//ajax
					}, 200)//settimeout
								   },
			   error:function(){//alert("errrr");
			   }
			});//ajax
			
			
			
		  },
		  cancel: function (res) {
			alert('用户拒绝授权获取地理位置');
		  }
		});

	
};

