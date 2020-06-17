<?php
 include("../template/header.php");
?>
<h3>Graph</h3>


<?php
	$info["table"] = "testdata";
	$info["fields"] = array("testdata.*"); 
	$info["where"]   = "1  AND TestID='".$_SESSION['TestID']."'  AND Priority='1'";
	$arr =  $db->select($info);
?>
<link href="../../flot/examples.css" rel="stylesheet" type="text/css">
	<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="../../excanvas.min.js"></script><![endif]-->
	<script language="javascript" type="text/javascript" src="../../flot/jquery.js"></script>
	<script language="javascript" type="text/javascript" src="../../flot/jquery.flot.js"></script>
	<script type="text/javascript">

	$(function() {

		var DeltaPressure  = [];
		var DP             = [];
		var SP             = [];
		
		<?php
		 for($i=0;$i<count($arr);$i++)
	      {
		?>
			DeltaPressure.push([<?=$i?>,<?=$arr[$i]['DPressure']?>]);
			DP.push([<?=$i?>,<?=$arr[$i]['DP']?>]);
			SP.push([<?=$i?>,<?=$arr[$i]['SP']?>]);
		<?php	
	 	  }
		?>  

		var plot = $.plot("#placeholder", [
			{ data: DeltaPressure, label: "DeltaPressure"},
			{ data: DP, label: "DP"},
			{ data: SP, label: "SP"},
		], {
			series: {
				lines: {
					show: true
				},
				points: {
					show: true
				}
			},
			grid: {
				hoverable: true,
				clickable: true
			}/*,
			yaxis: {
				min: -1.2,
				max: 1.2
			}*/
		});

		$("<div id='tooltip'></div>").css({
			position: "absolute",
			display: "none",
			border: "1px solid #fdd",
			padding: "2px",
			"background-color": "#fee",
			opacity: 0.80
		}).appendTo("body");

		$("#placeholder").bind("plothover", function (event, pos, item) {

			if ($("#enablePosition:checked").length > 0) {
				var str = "(" + pos.x.toFixed(2) + ", " + pos.y.toFixed(2) + ")";
				$("#hoverdata").text(str);
			}

			if ($("#enableTooltip:checked").length > 0) {
				if (item) {
					var x = item.datapoint[0].toFixed(2),
						y = item.datapoint[1].toFixed(2);

					$("#tooltip").html(item.series.label + " of " + x + " = " + y)
						.css({top: item.pageY+5, left: item.pageX+5})
						.fadeIn(200);
				} else {
					$("#tooltip").hide();
				}
			}
		});

		$("#placeholder").bind("plotclick", function (event, pos, item) {
			if (item) {
				$("#clickdata").text(" - click point " + item.dataIndex + " in " + item.series.label);
				plot.highlight(item.series, item.datapoint);
			}
		});

		// Add the Flot version string to the footer

		$("#footer").prepend("Flot " + $.plot.version + " &ndash; ");
	});

	</script>
</head>
<body>

	<div id="content">

		<table>
        
           <tr>
               <td>
                      <?php
						  unset($info);
						$info["table"] = "projectinfo";
						$info["fields"] = array("projectinfo.*"); 
						$info["where"]   = "1  AND TestID='".$_SESSION['TestID']."'";
						$arrprojectinfo =  $db->select($info);
					?>
					<style type="text/css">
					  table{
						border-collapse: collapse;
						border: 1px solid black;
					  }
					  table td{
						border: 1px solid black;
					  }
					</style>
					<table style="width:100%;">
					
						 <tr>
							 <td colspan="4" align="center">
								project_info : <?=$arrprojectinfo[0]['Test_name']?>
							 </td>
						 </tr>
						 <tr>
							 <td align="center">
								project_info/customer : <?=$arrprojectinfo[0]['Customer']?>
							 </td>
							 <td align="center">
								project_info : <?=$arrprojectinfo[0]['Project_No']?>
							 </td>
							 <td align="center">
								project_info : <?=$arrprojectinfo[0]['Serial_no']?>
							 </td>
						 </tr>
						 <tr>
							 <td align="center">
								project_info/customer : <?=$arrprojectinfo[0]['Drawing_no']?>
							 </td>
							 <td align="center">
								project_info : <?=$arrprojectinfo[0]['s_water']?>
							 </td>
							 <td align="center">
								<table style="width:100%">
									  <tr>
										  <td align="center"><?=$arrprojectinfo[0]['Pressure']?></td>
										  <td align="center"><?=$arrprojectinfo[0]['mix_percent']?></td>
										  <td align="center"><?=$arrprojectinfo[0]['tolerance_percent']?></td>
									  </tr>
								</table>
							 </td>
						 </tr>
					</table>
               </td>
              </tr>
               <tr>
                <td>
                    <div class="demo-container">
                        <div id="placeholder" class="demo-placeholder"></div>
                    </div>
                </td> 
               </tr>
               <tr>
                 <td>
                        <table   style="width: 100%; border: solid 1px #000000;">				
                            <tr>
                                <td  align="center"  style="width: 50%; border: solid 1px #000000;">
                                    date_time:<?=$arrprojectinfo[0]['date_time']?>
                                </td>
                                <td  align="center"  style="width: 50%; border: solid 1px #000000;">
                                    Userid:<?=$arrprojectinfo[0]['Userid']?>
                                </td>
                                </tr>
                                <tr>
                                <td  align="center"  style="width: 50%; border: solid 1px #000000;">
                                   date_time_approve:<?=$arrprojectinfo[0]['date_time_approve']?>
                                </td>
                                <td align="center"  style="width: 50%; border: solid 1px #000000;">
                                  Approvedby:<?=$arrprojectinfo[0]['Approvedby']?>
                                </td>
                            </tr>
                        </table>
                 </td>
               </tr>
         </table>       
        
        
        
        
       <div style="display:none;">
            <p>
                <label><input id="enablePosition" type="checkbox" checked="checked"></input>Show mouse position</label>
                <span id="hoverdata"></span>
                <span id="clickdata"></span>
            </p>
            <p><label><input id="enableTooltip" type="checkbox" checked="checked"></input>Enable tooltip</label></p>
       </div> 

	</div>


<?php
 include("../template/footer.php");
?>
