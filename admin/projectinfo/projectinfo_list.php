<?php
 include("../template/header.php");
?>
<b><?=ucwords(str_replace("_"," ","projectinfo"))?></b>
  <table cellspacing="3" cellpadding="3" border="0"  width="100%" class="bdr">
   <tr>
			<td align="center" valign="top">
			  <form name="search_frm" id="search_frm" method="post">
				<table width="60%" border="0"  cellpadding="0" cellspacing="0" class="bodytext">
				  <TR>
					<TD  nowrap="nowrap">
					  <?php
						  $hash    =  getTableFieldsName("projectinfo");
						  $hash    = array_diff($hash,array("id"));
					  ?>
					  Search Key:
					  <select   name="field_name" id="field_name"  class="textbox">
						<option value="">--Select--</option>
						<?php
						foreach($hash as $key=>$value)
						{
					    ?>
						<option value="<?=$key?>" <?php if($_SESSION['field_name']==$key) echo "selected"; ?>><?=str_replace("_"," ",$value)?></option>
						<?php
					    }
					  ?>
					  </select>
					</TD>
					<TD  nowrap="nowrap" align="right"><label for="searchbar"><img src="../images/icon_searchbox.png" alt="Search"></label>
					   <input type="text"    name="field_value" id="field_value" value="<?=$_SESSION["field_value"]?>" class="textbox"></TD>
					<td nowrap="nowrap" align="right">
					  <input type="hidden" name="cmd" id="cmd" value="search_projectinfo" >
					  <input type="submit" name="btn_submit" id="btn_submit"  value="Search" class="button" />
					</td>
				  </TR>
				</table>
			  </form>
			</td>
   </tr>
   <tr>
   <td> 
		<a href="projectinfo.php?cmd=edit" class="nav3">Add a projectinfo</a>
		<table cellspacing="1" cellpadding="3" border="0" width="100%" class="bodytext">
			<tr bgcolor="#ABCAE0">
			  <td>TestID</td>
			  <td>Test Name</td>
			  <td>Customer</td>
			  <td>Project No</td>
			  <td>Serial No</td>
			  <td>Drawing No</td>
			  <td>S Water</td>
			  <td>Pressure</td>
			  <td>Mix Percent</td>
			  <td>Tolerance Percent</td>
			  <td>Userid</td>
			  <td>Date Time</td>
			  <td>Date Time Approve</td>
			  <td>Approvedby</td>
			  <td>Action</td>
			</tr>
		 <?php
				
				if($_SESSION["search"]=="yes")
				  {
					$whrstr = " AND ".$_SESSION['field_name']." LIKE '%".$_SESSION["field_value"]."%'";
				  }
				  else
				  {
					$whrstr = "";
				  }
		 
				$rowsPerPage = 10;
				$pageNum = 1;
				if(isset($_REQUEST['page']))
				{
					$pageNum = $_REQUEST['page'];
				}
				$offset = ($pageNum - 1) * $rowsPerPage;  
		 
		 
							  
				$info["table"] = "projectinfo";
				$info["fields"] = array("projectinfo.*"); 
				$info["where"]   = "1   $whrstr ORDER BY id DESC  LIMIT $offset, $rowsPerPage";
									
				
				$arr =  $db->select($info);
				
				for($i=0;$i<count($arr);$i++)
				{
				
				   $rowColor;
		
					if($i % 2 == 0)
					{
						
						$row="#C8C8C8";
					}
					else
					{
						
						$row="#FFFFFF";
					}
				
		 ?>
			<tr bgcolor="<?=$row?>" onmouseover=" this.style.background='#ECF5B6'; " onmouseout=" this.style.background='<?=$row?>'; ">
			  <td><?=$arr[$i]['TestID']?></td>
			  <td><?=$arr[$i]['Test_name']?></td>
			  <td><?=$arr[$i]['Customer']?></td>
			  <td><?=$arr[$i]['Project_No']?></td>
			  <td><?=$arr[$i]['Serial_no']?></td>
			  <td><?=$arr[$i]['Drawing_no']?></td>
			  <td><?=$arr[$i]['s_water']?></td>
			  <td><?=$arr[$i]['Pressure']?></td>
			  <td><?=$arr[$i]['mix_percent']?></td>
			  <td><?=$arr[$i]['tolerance_percent']?></td>
			  <td><?=$arr[$i]['Userid']?></td>
			  <td><?=$arr[$i]['date_time']?></td>
			  <td><?=$arr[$i]['date_time_approve']?></td>
			  <td><?=$arr[$i]['Approvedby']?></td>
			  <td nowrap >
				  <a href="projectinfo.php?cmd=edit&id=<?=$arr[$i]['id']?>" class="nav">Edit</a> |
				  <a href="projectinfo.php?cmd=delete&id=<?=$arr[$i]['id']?>" class="nav" onClick=" return confirm('Are you sure to delete this item ?');">Delete</a> |
                      <br /><br />
                   <a href="../testdata_report/testdata_report.php?TestID=<?=$arr[$i]['TestID']?>" class="nav">testdata Report</a> |
                   <a href="../testdata_graph/testdata_graph.php?TestID=<?=$arr[$i]['TestID']?>" class="nav">testdata Graph</a>
			 </td>
		
			</tr>
		<?php
				  }
		?>
		
		<tr>
		   <td colspan="10" align="center">
			  <?php              
					  unset($info);
	
					  $info["table"] = "projectinfo";
					  $info["fields"] = array("count(*) as total_rows"); 
					  $info["where"]   = "1  $whrstr ORDER BY id DESC";
					  
					  $res  = $db->select($info);  
	
	
						$numrows = $res[0]['total_rows'];
						$maxPage = ceil($numrows/$rowsPerPage);
						$self = 'projectinfo.php?cmd=list';
						$nav  = '';
						
						$start    = ceil($pageNum/5)*5-5+1;
						$end      = ceil($pageNum/5)*5;
						
						if($maxPage<$end)
						{
						  $end  = $maxPage;
						}
						
						for($page = $start; $page <= $end; $page++)
						//for($page = 1; $page <= $maxPage; $page++)
						{
							if ($page == $pageNum)
							{
								$nav .= " $page "; 
							}
							else
							{
								$nav .= " <a href=\"$self&&page=$page\" class=\"nav\">$page</a> ";
							} 
						}
						if ($pageNum > 1)
						{
							$page  = $pageNum - 1;
							$prev  = " <a href=\"$self&&page=$page\" class=\"nav\">[Prev]</a> ";
					
						   $first = " <a href=\"$self&&page=1\" class=\"nav\">[First Page]</a> ";
						} 
						else
						{
							$prev  = '&nbsp;'; 
							$first = '&nbsp;'; 
						}
					
						if ($pageNum < $maxPage)
						{
							$page = $pageNum + 1;
							$next = " <a href=\"$self&&page=$page\" class=\"nav\">[Next]</a> ";
					
							$last = " <a href=\"$self&&page=$maxPage\" class=\"nav\">[Last Page]</a> ";
						} 
						else
						{
							$next = '&nbsp;'; 
							$last = '&nbsp;'; 
						}
						
						if($numrows>1)
						{
						  echo $first . $prev . $nav . $next . $last;
						}
						
					?>     
		   </td>
		</tr>
		</table>

</td>
</tr>
</table>

<?php
include("../template/footer.php");
?>









