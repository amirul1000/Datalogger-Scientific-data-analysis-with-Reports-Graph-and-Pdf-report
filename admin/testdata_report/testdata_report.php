<?php
       session_start();
       include("../../common/lib.php");
	   include("../../lib/class.db.php");
	   include("../../common/config.php");
	   
	    if(empty($_SESSION['users_id'])) 
	   {
	     Header("Location: ../login/login.php");
	   }
	  
	   $cmd = $_REQUEST['cmd'];
	   switch($cmd)
	   {
	     case "print":
		 
		        require('../../fpdf17/fpdf.php');
				require('class.fpdf.php');
				
				
				
				   unset($info);
			    $info["table"] = "projectinfo";
				$info["fields"] = array("projectinfo.*"); 
				$info["where"]   = "1 AND TestID='".$_SESSION['TestID']."'";
				$arrprojectinfo =  $db->select($info);
				
				
				  unset($info);
				$info["table"]   = "testdata";
				$info["fields"]  = array("testdata.*"); 
				$info["where"]   = "1 AND TestID='".$_SESSION['TestID']."' AND Priority='1'  ORDER BY id DESC";
				$arrtestdata =  $db->select($info);
				
				
				
				$pdf = new PDF();
				// Column headings
				$header = array('Div', 'P1', 'P2', 'P3','DP','D%','1/min (v)','1/min (s)','ss');
				// Data loading
				//$data = $pdf->LoadData('countries.txt');
				$pdf->SetFont('Arial','',8);
				$pdf->AddPage();
				$pdf->BasicTable1($header,$arrprojectinfo);
				$pdf->BasicTable2($header,$arrtestdata);
				$pdf->BasicTable3($header,$arrprojectinfo);
				/*$pdf->AddPage();
				$pdf->ImprovedTable($header,$data);*/
				/*$pdf->AddPage();
				$pdf->FancyTable($header,$arrtestdata);*/
				$pdf->Output();
		         /*// get the HTML
					 ob_start();
				    include('testdata_html.php');
				    $html = ob_get_clean();
				
			   
			     if($_REQUEST['type']=='html')
				 {
				   echo $html;
				   exit;
				 }
				 
					 
					
					$content =  $html;
					$content = '<page style="font-family: freeserif"><br />'.nl2br($content).'</page>';
					// convert in PDF
					require_once(dirname(__FILE__).'/../../html2pdf_v4.03/html2pdf.class.php');
					try
					{
							$html2pdf = new HTML2PDF('P', 'A1', 'fr');
							$html2pdf->pdf->SetDisplayMode('real');
							$html2pdf->writeHTML($content, isset($_GET['vuehtml']));
							//      $html2pdf->setModeDebug();
							//$html2pdf->setDefaultFont('Arial');
							$html2pdf->Output('collection.pdf');
					}
					catch(HTML2PDF_exception $e) {
					echo $e;
					exit;
					}			 */
				
		       break;
	     default :    
		          $_SESSION['TestID'] = $_REQUEST['TestID'];
		       include("../testdata_report/testdata_report_view.php");		         
	   }

?>
