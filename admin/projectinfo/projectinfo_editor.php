<?php
 include("../template/header.php");
?>
<script language="javascript" src="projectinfo.js"></script>
<!--<script type="text/javascript" src="../../js/jquery.js"></script>
<script	src="../../js/main.js" type="text/javascript"></script>
<link rel="stylesheet" href="../../css/datepicker.css">-->


<link rel="stylesheet" href="../../datepicker/jquery-ui.css">
<script src="../../datepicker/jquery-1.10.2.js"></script>
<script src="../../datepicker/jquery-ui.js"></script>

<script src="../../datepicker/addons/jquery-ui-sliderAccess.js"></script>
<link rel="stylesheet" href="../../datepicker/addons/jquery-ui-timepicker-addon.css">
<script src="../../datepicker/addons/jquery-ui-timepicker-addon.js"></script>

<b><?=ucwords(str_replace("_"," ","projectinfo"))?></b><br />
<table cellspacing="3" cellpadding="3" border="0" align="center" width="98%" class="bdr">
 <tr>
  <td>  
     <a href="projectinfo.php?cmd=list" class="nav3">List</a>
	 <form name="frm_projectinfo" method="post"  enctype="multipart/form-data" onSubmit="return checkRequired();">			
		<table cellspacing="3" cellpadding="3" border="0" align="center" class="bodytext" width="100%">  
		            <tr>
						 <td>TestID</td>
						 <td>
						    <input type="text" name="TestID" id="TestID"  value="<?=$TestID?>" class="textbox">
						 </td>
				     </tr>
                     <tr>
						 <td>Test Name</td>
						 <td>
						    <input type="text" name="Test_name" id="Test_name"  value="<?=$Test_name?>" class="textbox">
						 </td>
				     </tr>
                     <tr>
						 <td>Customer</td>
						 <td>
						    <input type="text" name="Customer" id="Customer"  value="<?=$Customer?>" class="textbox">
						 </td>
				     </tr>
                     <tr>
						 <td>Project No</td>
						 <td>
						    <input type="text" name="Project_No" id="Project_No"  value="<?=$Project_No?>" class="textbox">
						 </td>
				     </tr>
                     <tr>
						 <td>Serial No</td>
						 <td>
						    <input type="text" name="Serial_no" id="Serial_no"  value="<?=$Serial_no?>" class="textbox">
						 </td>
				     </tr>
                     <tr>
						 <td>Drawing No</td>
						 <td>
						    <input type="text" name="Drawing_no" id="Drawing_no"  value="<?=$Drawing_no?>" class="textbox">
						 </td>
				     </tr>
                     <tr>
						 <td>S Water</td>
						 <td>
						    <input type="text" name="s_water" id="s_water"  value="<?=$s_water?>" class="textbox">
						 </td>
				     </tr>
                     <tr>
						 <td>Pressure</td>
						 <td>
						    <input type="text" name="Pressure" id="Pressure"  value="<?=$Pressure?>" class="textbox">
						 </td>
				     </tr>
                     <tr>
						 <td>Mix Percent</td>
						 <td>
						    <input type="text" name="mix_percent" id="mix_percent"  value="<?=$mix_percent?>" class="textbox">
						 </td>
				     </tr>
                     <tr>
						 <td>Tolerance Percent</td>
						 <td>
						    <input type="text" name="tolerance_percent" id="tolerance_percent"  value="<?=$tolerance_percent?>" class="textbox">
						 </td>
				     </tr>
                     <tr>
						 <td>Userid</td>
						 <td>
						    <input type="text" name="Userid" id="Userid"  value="<?=$Userid?>" class="textbox">
						 </td>
				     </tr>
                     <tr>
						 <td>Date Time</td>
						 <td>
						    <input type="text" name="date_time" id="date_time"  value="<?=$date_time?>" class="textbox datetimepicker">
						 </td>
				     </tr>
                     <tr>
						 <td>Date Time Approve</td>
						 <td>
						    <input type="text" name="date_time_approve" id="date_time_approve"  value="<?=$date_time_approve?>" class="textbox datetimepicker">
							<script>
							      $( ".datetimepicker" ).datetimepicker({
									dateFormat: 'yy-mm-dd',
									timeFormat: 'HH:mm:ss',
									changeYear: true,
									changeMonth: true,
									showOn: 'button',
									buttonText: 'Show Date',
									buttonImageOnly: true,
									buttonImage: '../../images/calendar.gif',
								});
                                  
                            </script>
						 </td>
				     </tr>
                     <tr>
						 <td>Approvedby</td>
						 <td>
						    <input type="text" name="Approvedby" id="Approvedby"  value="<?=$Approvedby?>" class="textbox">
						 </td>
				     </tr>
                     <tr> 
                         <td align="right"></td>
                         <td>
                            <input type="hidden" name="cmd" value="add">
                            <input type="hidden" name="id" value="<?=$Id?>">			
                            <input type="submit" name="btn_submit" id="btn_submit" value="submit" class="button_blue">
                         </td>     
                     </tr>
		</table>
	</form>
  </td>
 </tr>
</table>
<?php
 include("../template/footer.php");
?>

