<?php
 include("../template/header.php");
?>
<b><?=ucwords(str_replace("_"," ","testdata"))?></b>
  <table cellspacing="3" cellpadding="3" border="0"  width="100%" class="bdr">
   <tr>
			<td align="center" valign="top">
			  <form name="search_frm" id="search_frm" method="post">
				<table width="60%" border="0"  cellpadding="0" cellspacing="0" class="bodytext">
				  <TR>
					<TD  nowrap="nowrap">
					  <?php
						  $hash    =  getTableFieldsName("testdata");
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
					  <input type="hidden" name="cmd" id="cmd" value="search_testdata" >
					  <input type="submit" name="btn_submit" id="btn_submit"  value="Search" class="button" />
					</td>
				  </TR>
				</table>
			  </form>
			</td>
   </tr>
   <tr>
   <td> 
		<a href="testdata.php?cmd=edit" class="nav3">Add a testdata</a>
		<table cellspacing="1" cellpadding="3" border="0" width="100%" class="bodytext">
                <tr bgcolor="#ABCAE0">
                <td>TestID</td>
                <td>test_info</td>
                <td>TestType</td>
                <td>Instr No</td>
                <td>P1</td>
                <td>P2</td>
                <td>DPressure</td>
                <td>DP</td>
                <td>Lmin</td>
                <td>SLmin</td>
                <td>SP</td>
                <td>Priority</td>			  
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
		 
		 
							  
				$info["table"] = "testdata";
				$info["fields"] = array("testdata.*"); 
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
                <td>
				    <?=$arr[$i]['TestID']?>
                    <br />
                    <a href="../testdata_report/testdata_report.php?TestID=<?=$arr[$i]['TestID']?>" class="nav">testdata Report</a> |
                    <a href="../testdata_graph/testdata_graph.php?TestID=<?=$arr[$i]['TestID']?>" class="nav">testdata Graph</a>
                </td>
                <td><?=$arr[$i]['test_info']?></td>
                <td><?=$arr[$i]['TestType']?></td>
                <td><?=$arr[$i]['Instr_no']?></td>
                <td><?=$arr[$i]['P1']?></td>
                <td><?=$arr[$i]['P2']?></td>
                <td><?=$arr[$i]['DPressure']?></td>
                <td><?=$arr[$i]['DP']?></td>
                <td><?=$arr[$i]['Lmin']?></td>
                <td><?=$arr[$i]['SLmin']?></td>
                <td><?=$arr[$i]['SP']?></td>
                <td><?=$arr[$i]['Priority']?></td>
			  
			  <td nowrap >
				  <a href="testdata.php?cmd=edit&id=<?=$arr[$i]['id']?>" class="nav">Edit</a> |
				  <a href="testdata.php?cmd=delete&id=<?=$arr[$i]['id']?>" class="nav" onClick=" return confirm('Are you sure to delete this item ?');">Delete</a> 
			 </td>
		
			</tr>
		<?php
				  }
		?>
		
		<tr>
		   <td colspan="10" align="center">
			  <?php              
					  unset($info);
	
					  $info["table"] = "testdata";
					  $info["fields"] = array("count(*) as total_rows"); 
					  $info["where"]   = "1  $whrstr ORDER BY id DESC";
					  
					  $res  = $db->select($info);  
	
	
						$numrows = $res[0]['total_rows'];
						$maxPage = ceil($numrows/$rowsPerPage);
						$self = 'testdata.php?cmd=list';
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









