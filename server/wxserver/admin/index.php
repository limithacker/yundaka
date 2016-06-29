<?
session_start();
if($_SESSION['cmpid']==""){
	header("Location:".$url."/admin/login.php"); 
}
include "../common.inc.php";
$con = mysql_connect($server,$username,$password);
if (!$con)
  {
  die('Lets Fvck this database!' . mysql_error());
  }
//else {echo "login database ok<\br>";}
$db_selected = mysql_select_db($database,$con);

$cmpid=$_SESSION['cmpid'];
?>



<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <title>云考勤管理中心</title>
    <link href="http://cdn.bootcss.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://cdn.bootcss.com/jquery/1.11.2/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
  <h1>云考勤管理中心<small>
  <? 
		
		$cidsql=mysql_query("select * from ydk_company where `cid`='$cmpid';");
		$cidfetch = mysql_fetch_array($cidsql);
		$cname=$cidfetch['cmpname'];
		echo $cname;
															
	?>
  </small></h1>
</div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tabbable" id="tabs-447998">
                    <ul class="nav nav-tabs" id="mytab">
                        <li class="active">
                            <a data-toggle="tab" href="#panel-252166">规则列表</a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#panel-414600">签到情况</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="panel-252166">
                            <p>
                                <div class="col-md-2">
                                    <ul class="nav nav-list">
                                    	<li>
                                            <a href="cmpcheck.php"  target="view_window"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>添加考勤规则</a>
                                        </li>
                                        <li>
                                        <?
											//$sel50sql=mysql_query("select * from ydk_rule where `cmpid`='$cmpid' order by `rid` DESC limit 10;");
										?>
                                            <a href="index.php?do=sel50">近50条规则</a>
                                        </li>
                                        <li>
                                        <?
											$seldsql=mysql_query("select * from ydk_checkdate where `cmpid`='$cmpid';");
											while($seld = mysql_fetch_array($seldsql)){
												?>
                                                <a href="index.php?do=seld&d=<? echo $seld['date']; ?>"><? echo $seld['date']; ?></a>
                                                <?
											}
										?>
                                            
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-10">
                                <?
								if(($_GET['do']=="sel50")||($_GET['do']=="")){
									?>
                                    <div class="alert alert-success" role="alert">最近50条考勤规则</div>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>编号</th><th>规则名</th><th>员工名</th><th>时间范围</th><th>删除</th></tr>
                                        </thead>
                                        <tbody>
                                        <? 
											$sel50sql=mysql_query("select * from ydk_rule where `cmpid`='$cmpid' order by `rid` DESC limit 50;");
											while($sel50 = mysql_fetch_array($sel50sql)){
										?>
                                            <tr>
                                                <td>
                                                    <? echo $sel50['rid']; ?>
                                                </td>
                                                <td>
                                                    <? echo $sel50['rulename']; ?>
                                                </td>
                                                <td>
                                                    <? 
													$userid=$sel50['userid'];
													$useridsql=mysql_query("select * from ydk_user where `uid`='$userid';");
													$useridfetch = mysql_fetch_array($useridsql);
													$usn=$useridfetch['name'];
													echo $usn;
													
													?>
                                                </td>
                                                <td>
                                                    <? echo $sel50['sh'].':'.$sel50['sm'].'~'.$sel50['eh'].':'.$sel50['em']; ?>
                                                </td>
                                                <td>
                                                    <a href="delrul.php?rid=<? echo $sel50['rid']; ?>"><button type="button" class="btn btn-danger">删除</button></a>
                                                </td>
                                            </tr>
                                         <?
											}
										 
										 ?>
                                        </tbody>
                                    </table>
                                    
                                    
                                    <?
								}
								else if($_GET['do']=="seld"){
									?>
                                    <div class="alert alert-success" role="alert"><? echo $_GET['d']; ?>内应用的所有考勤规则</div>
 <table class="table">
                                        <thead>
                                            <tr>
                                                <th>编号</th><th>规则名</th><th>员工名</th><th>时间范围</th><th>删除</th></tr>
                                        </thead>
                                        <tbody>
                                        <? 
											$d=$_GET['d'];
											$seldsql=mysql_query("select * from ydk_rule where `cmpid`='$cmpid' and `date`='$d';");
											while($seld = mysql_fetch_array($seldsql)){
										?>
                                            <tr>
                                                <td>
                                                    <? echo $seld['rid']; ?>
                                                </td>
                                                <td>
                                                    <? echo $seld['rulename']; ?>
                                                </td>
                                                <td>
                                                    <? 
													$userid=$seld['userid'];
													$useridsql=mysql_query("select * from ydk_user where `uid`='$userid';");
													$useridfetch = mysql_fetch_array($useridsql);
													$usn=$useridfetch['name'];
													echo $usn;
													
													?>
                                                </td>
                                                <td>
                                                    <? echo $seld['sh'].':'.$seld['sm'].'~'.$seld['eh'].':'.$seld['em']; ?>
                                                </td>
                                                <td>
                                                    <a href="delrul.php?rid=<? echo $seld['rid']; ?>"><button type="button" class="btn btn-danger">删除</button></a>
                                                </td>
                                            </tr>
                                         <?
											}
										 
										 ?>
                                        </tbody>
                                    </table>
                                    <?
								}
									
								
								
								?>
                            </p>
                        </div></div>
                        <div class="tab-pane" id="panel-414600">
                            <p>
                                 <div class="col-md-2">
                                 		<div class="alert alert-success" role="alert">
                                        					<a href="excel.php">
                                                           	<button type="button" class="btn btn-primary">导出Excel</button>
                                                           </a>
                                         </div>
                                    <ul class="nav nav-list">
                                        <!-- <li>
                                            <a href="index.php?do=qd50">近50次签到情况</a>
                                        </li>  -->
                                        <li>
                                        <?
											$qddsql=mysql_query("select * from ydk_checkdate where `cmpid`='$cmpid';");
											while($seld = mysql_fetch_array($qddsql)){
												?>
                                                <a href="index.php?do=qdd&d=<? echo $seld['date']; ?>"><? echo $seld['date']; ?></a>
                                                <?
											}
										?>
                                            
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-10">
                                <? /*
									if($_GET['do']=="qd50"){
										?>
                                        <!-- 有考勤规则计算数据 -->
                                        <div class="alert alert-success" role="alert">近50条考勤规则签到情况</div>
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>规则名</th><th>员工名</th><th>考勤情况</th></tr>
                                                </thead>
                                                <tbody>
                                                <? 
													$qd50sql=mysql_query("select * from ydk_check where `cmpid`='$cmpid' order by `rid` DESC limit 50;");
													while($qd50 = mysql_fetch_array($qd50sql)){
														if($qd50['checkid']==""){//无数据
														?>
                                                        	<!-- 无考勤规则计算数据 -->
                                                           <div class="alert alert-danger" role="alert">最近50日未进行计算，请分别对每日进行考勤计算。</div>
                                                           <!-- 无考勤规则计算数据 -->
                                                        <?
														break;
														}
													if($qd50['status']==1){
														echo "<tr>";
													}
													else if($qd50['status']==2){
														?> <tr class="warning"> <?
													}
													else if($qd50['status']==3){
														?> <tr class="warning"> <?
													}
													else if($qd50['status']==4){
														?> <tr class="danger"> <?
													}	
												?>
													
														<td>
															<? 
																$ruleid=$qd50['ruleid'];
																$ruleidsql=mysql_query("select * from ydk_rule where `rid`='$ruleid';");
																$ruleidfetch = mysql_fetch_array($ruleidsql);
																$rulename=$ruleidfetch['rulename'];
																echo $rulename;
															
															?>
														</td>
														<td>
															<? 
																$userid=$qd50['userid'];
																$useridsql=mysql_query("select * from ydk_user where `uid`='$userid';");
																$useridfetch = mysql_fetch_array($useridsql);
																$usn=$useridfetch['username'];
																echo $usn;
															 ?>
														</td>
														<td>
															<?
																if($qd50['status']==1){
																	echo "打卡成功";
																}
																else if($qd50['status']==2){
																	echo "时间正确，位置错误";
																}
																else if($qd50['status']==3){
																	echo "时间错误，位置正确";
																}
																else if($qd50['status']==4){
																	echo "打卡失败";
																}
															
															
															?>
														</td>
													</tr>
												 <?
													}
												 
												 ?>
                                                </tbody>
                                            </table>
                                           <!-- 有考勤规则计算数据 -->
                                        
                                        <?
										
									}  */
									if($_GET['do']=="qdd"){
										$d=$_GET['d'];
										$qddsql0=mysql_query("select * from ydk_check where `cmpid`='$cmpid' and `date`='$d' ;");
										$qdd0 = mysql_fetch_array($qddsql0);
										
										if($qdd0['checkid']==""){//无数据
														?>
                                                        	<!-- 无考勤规则计算数据 -->
                                                           <div class="alert alert-danger" role="alert">该日期未进行计算，或无任何人员签到记录。</div>
                                                           <a href="sol.php?c=<? echo $cmpid; ?>&d=<? echo $d; ?>">
                                                           	<button type="button" class="btn btn-primary btn-lg btn-block">计算数据</button>
                                                           </a>
                                                           <!-- 无考勤规则计算数据 -->
                                                        <?
														
										}
										else {
										?>
                                        <!-- 有考勤规则计算数据 -->
                                        
                                        <div class="alert alert-success" role="alert"><? echo $d; ?>考勤规则签到情况
                                        					<a href="sol.php?c=<? echo $cmpid; ?>&d=<? echo $d; ?>">
                                                           	<button type="button" class="btn btn-primary">重新计算</button>
                                                           </a>
                                         </div>
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>规则名</th><th>员工名</th><th>考勤情况</th></tr>
                                                </thead>
                                                <tbody>
                                                <? 
													$qddsql=mysql_query("select * from ydk_check where `cmpid`='$cmpid' and `date`='$d' ;");
													while($qdd = mysql_fetch_array($qddsql)){
														if($qdd['checkid']==""){//无数据
														?>
                                                        	<!-- 无考勤规则计算数据 -->
                                                           <div class="alert alert-danger" role="alert">该日期未进行计算，请分别对每日进行考勤计算。</div>
                                                           <a href="sol.php?c=<? echo $cmpid; ?>&d=<? echo $d; ?>">
                                                           	<button type="button" class="btn btn-primary btn-lg btn-block">计算数据</button>
                                                           </a>
                                                           <!-- 无考勤规则计算数据 -->
                                                        <?
														break;
														}
													if($qdd['status']==1){
														echo "<tr>";
													}
													else if($qdd['status']==2){
														?> <tr class="warning"> <?
													}
													else if($qdd['status']==3){
														?> <tr class="warning"> <?
													}
													else if($qdd['status']==4){
														?> <tr class="danger"> <?
													}	
												?>
													
														<td>
															<? 
																$ruleid=$qdd['ruleid'];
																$ruleidsql=mysql_query("select * from ydk_rule where `rid`='$ruleid';");
																$ruleidfetch = mysql_fetch_array($ruleidsql);
																$rulename=$ruleidfetch['rulename'];
																echo $rulename;
															
															?>
														</td>
														<td>
															<? 
																$userid=$qdd['userid'];
																$useridsql=mysql_query("select * from ydk_user where `uid`='$userid';");
																$useridfetch = mysql_fetch_array($useridsql);
																$usn=$useridfetch['name'];
																echo $usn;
															 ?>
														</td>
														<td>
															<?
																if($qdd['status']==1){
																	echo "打卡成功";
																}
																else if($qdd['status']==2){
																	echo "时间正确，位置错误";
																}
																else if($qdd['status']==3){
																	echo "时间错误，位置正确";
																}
																else if($qdd['status']==4){
																	echo "打卡失败";
																}
															
															
															?>
														</td>
													</tr>
												 <?
													}
												 
												 ?>
                                                </tbody>
                                            </table>
                                           <!-- 有考勤规则计算数据 -->
                                        
                                        <?
										}//判断是否为""
										
									}
								 
								 ?>
                                </div>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    
                </div>
            </div>
        </div>
    </div>
</body>
<?
if(($_GET['do']=="qdd")||($_GET['do']=="qd50"))
{
	?>
	<script>
	$('#mytab a:last').tab('show'); 
	<!-- 切换到选项卡2-->
	</script>
	<?
}
?>

<?
mysql_close($con);
?>