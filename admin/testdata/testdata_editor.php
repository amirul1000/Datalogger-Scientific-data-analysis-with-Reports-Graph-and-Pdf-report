<?php
 include("../template/header.php");
?>
<script language="javascript" src="testdata.js"></script>
<script type="text/javascript" src="../../js/jquery.js"></script>
<script	src="../../js/main.js" type="text/javascript"></script>
<link rel="stylesheet" href="../../css/datepicker.css">
<b><?=ucwords(str_replace("_"," ","testdata"))?></b><br />
<table cellspacing="3" cellpadding="3" border="0" align="center" width="98%" class="bdr">
 <tr>
  <td>  
     <a href="testdata.php?cmd=list" class="nav3">List</a>
	 <form name="frm_testdata" method="post"  enctype="multipart/form-data" onSubmit="return checkRequired();">			
		<table cellspacing="3" cellpadding="3" border="0" align="center" class="bodytext" width="100%">  
		            <tr>
						 <td>TestID</td>
						 <td>
						    <input type="text" name="TestID" id="TestID"  value="<?=$TestID?>" class="textbox">
						 </td>
				     </tr>
                     <tr>
						 <td>test_info</td>
						 <td>
						    <input type="text" name="test_info" id="test_info"  value="<?=$test_info?>" class="textbox">
						 </td>
				     </tr>
                     <tr>
						 <td>TestType</td>
						 <td>
						    <input type="text" name="TestType" id="TestType"  value="<?=$TestType?>" class="textbox">
						 </td>
				     </tr>
                     <tr>
						 <td>Instr No</td>
						 <td>
						    <input type="text" name="Instr_no" id="Instr_no"  value="<?=$Instr_no?>" class="textbox">
						 </td>
				     </tr>
                     <tr>
						 <td>P1</td>
						 <td>
						    <input type="text" name="P1" id="P1"  value="<?=$P1?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>P2</td>
						 <td>
						    <input type="text" name="P2" id="P2"  value="<?=$P2?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>DPressure</td>
						 <td>
						    <input type="text" name="DPressure" id="DPressure"  value="<?=$DPressure?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>DP</td>
						 <td>
						    <input type="text" name="DP" id="DP"  value="<?=$DP?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>Lmin</td>
						 <td>
						    <input type="text" name="Lmin" id="Lmin"  value="<?=$Lmin?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>SLmin</td>
						 <td>
						    <input type="text" name="SLmin" id="SLmin"  value="<?=$SLmin?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>SP</td>
						 <td>
						    <input type="text" name="SP" id="SP"  value="<?=$SP?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>Priority</td>
						 <td>
						    <input type="text" name="Priority" id="Priority"  value="<?=$Priority?>" class="textbox">
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

