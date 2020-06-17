<?php
 include("../template/header.php");
?>

  <h3>Report</h3> &nbsp;&nbsp;&nbsp; <a href="testdata_report.php?cmd=print">PDF</a>
  <table cellspacing="1" cellpadding="3" border="0" width="100%" class="bodytext" align="center">
		<tr bgcolor="#FFFFFF">
          <th> 
              Div
          </th>
          <th> 
              P1
          </th>
          <th>
               P2
          </th>
          <th>
              P3
          </th>
          <th>
               &Delta;P
          </th>
          <th>
               &Delta;%
          </th>
          <th>
                1/min (v)
          </th>
          <th>
                1/min (s)
          </th>
          <th>
               <img src="../../images/percent.png">
                
          </th>
       </tr>
       <?php
	              unset($info);
                $info["table"]   = "testdata";
				$info["fields"]  = array("testdata.*"); 
				$info["where"]   = "1 AND TestID='".$_SESSION['TestID']."'  AND Priority='1' ORDER BY id DESC";
									
				
				$arr =  $db->select($info);
				
				for($i=0;$i<count($arr);$i++)
				{
	  ?>
       <tr>
			  <td align="center"><?=$arr[$i]['Instr_no']?></td>
			  <td align="center"><?=$arr[$i]['P1']?></td>
			  <td align="center"><?=$arr[$i]['P2']?></td>
			  <td align="center"><?=$arr[$i]['DPressure']?></td>
			  <td align="center"><?=$arr[$i]['DP']?></td>
			  <td align="center"><?=$arr[$i]['Lmin']?></td>
			  <td align="center"><?=$arr[$i]['SLmin']?></td>
			  <td align="center"><?=$arr[$i]['SP']?></td>
			  <td align="center"><?=$arr[$i]['Priority']?></td>			
			</tr>
      
      <?php
	          }
	  ?>		  			
  </table>




<?php
 include("../template/footer.php");
?>
