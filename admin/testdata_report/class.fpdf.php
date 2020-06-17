<?php
	class PDF extends FPDF
	{
		// Load data
		function LoadData($file)
		{
			// Read file lines
			$lines = file($file);
			$data = array();
			foreach($lines as $line)
				$data[] = explode(';',trim($line));
			return $data;
		}
		// Simple table
		function BasicTable1($header, $data)
		{
			
								  
				$this->Cell(90,20,'CHECKLIST',1);
				$image = '../../images/logo.png';				  
				$this->Cell(90,20,$this->Image($image, $this->GetX(), $this->GetY(), 20),1);			
			    $this->Ln();
				$this->Cell(60,6,'Customer: '.$data[0]['Customer'],1);
				$this->Cell(60,6,'Project No: '.$data[0]['Project_No'],1);
				$this->Cell(60,6,'Serial no: '.$data[0]['Serial_no'],1);
				$this->Ln();
				$this->Cell(60,6,'Drawing no: '.$data[0]['Drawing_no'],1);
				$this->Cell(60,6,'s water: '.$data[0]['s_water'],1);
				$this->Cell(20,6,'Pressure: '.$data[0]['Pressure'],1);
				$this->Cell(20,6,'M percent: '.$data[0]['mix_percent'],1);
				$this->Cell(20,6,'T percent: '.$data[0]['tolerance_percent'],1);
				$this->Ln();
				
		}
		// Simple table
		function BasicTable2($header, $data)
		{
			// Header
			$k=0;
			foreach($header as $col)
			{
			    $k++;
				if($k==9)
				{
				  $image = '../../images/percent.png';				  
				  $this->Cell(20,25,$this->Image($image, $this->GetX(), $this->GetY(), 17),1);
				}
				else
				{
				  $this->Cell(20,25,$col,1);
				}
		    }		
			$this->Ln();
			// Data
			/*foreach($data as $row)
			{
				foreach($row as $col)
					$this->Cell(40,6,$col,1);
				$this->Ln();
			}*/
			for($i=0;$i<count($data);$i++)
			 {       
								  
				$this->Cell(20,6,$data[$i]['Instr_no'],1);
				$this->Cell(20,6,$data[$i]['P1'],1);
				$this->Cell(20,6,$data[$i]['P2'],1);
				$this->Cell(20,6,$data[$i]['DPressure'],1);
				$this->Cell(20,6,$data[$i]['DP'],1);
				$this->Cell(20,6,$data[$i]['Lmin'],1);
				$this->Cell(20,6,$data[$i]['SLmin'],1);
				$this->Cell(20,6,$data[$i]['SP'],1);
				$this->Cell(20,6,$data[$i]['Priority'],1);
				
				$this->Ln();
			 }
		}
		
		// Simple table
		function BasicTable3($header, $data)
		{
			
								  
				$this->Cell(90,6,'Date time: '.$data[0]['date_time'],1);
				$this->Cell(90,6,'Userid: '.$data[0]['Userid'],1);
				$this->Ln();
				$this->Cell(90,6,'Date time approve: '.$data[0]['date_time_approve'],1);
				$this->Cell(90,6,'Approved by: '.$data[0]['Approvedby'],1);
				$this->Ln();
			 
		}
		// Better table
		function ImprovedTable($header, $data)
		{
			// Column widths
			$w = array(40, 35, 40, 45);
			// Header
			for($i=0;$i<count($header);$i++)
				$this->Cell($w[$i],7,$header[$i],1,0,'C');
			$this->Ln();
			// Data
			foreach($data as $row)
			{
				$this->Cell($w[0],6,$row[0],'LR');
				$this->Cell($w[1],6,$row[1],'LR');
				$this->Cell($w[2],6,number_format($row[2]),'LR',0,'R');
				$this->Cell($w[3],6,number_format($row[3]),'LR',0,'R');
				$this->Ln();
			}
			// Closing line
			$this->Cell(array_sum($w),0,'','T');
		}
		
		// Colored table
		function FancyTable($header, $data)
		{
			// Colors, line width and bold font
			$this->SetFillColor(255,0,0);
			$this->SetTextColor(255);
			$this->SetDrawColor(128,0,0);
			$this->SetLineWidth(.3);
			$this->SetFont('','B');
			// Header
			$w = array(40, 35, 40, 45);
			for($i=0;$i<count($header);$i++)
				$this->Cell($w[$i],7,$header[$i],1,0,'C',true);
			$this->Ln();
			// Color and font restoration
			$this->SetFillColor(224,235,255);
			$this->SetTextColor(0);
			$this->SetFont('');
			// Data
			$fill = false;
			foreach($data as $row)
			{
				$this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
				$this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
				$this->Cell($w[2],6,number_format($row[2]),'LR',0,'R',$fill);
				$this->Cell($w[3],6,number_format($row[3]),'LR',0,'R',$fill);
				$this->Ln();
				$fill = !$fill;
			}
			// Closing line
			$this->Cell(array_sum($w),0,'','T');
		}
	}
?>