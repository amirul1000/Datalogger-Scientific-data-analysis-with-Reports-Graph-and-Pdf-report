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
	     
		  case 'add': 
				$info['table']    = "testdata";
				$data['TestID']   = $_REQUEST['TestID'];
				$data['test_info']   = $_REQUEST['test_info'];
                $data['TestType']   = $_REQUEST['TestType'];
                $data['Instr_no']   = $_REQUEST['Instr_no'];
                $data['P1']   = $_REQUEST['P1'];
                $data['P2']   = $_REQUEST['P2'];
                $data['DPressure']   = $_REQUEST['DPressure'];
                $data['DP']   = $_REQUEST['DP'];
                $data['Lmin']   = $_REQUEST['Lmin'];
                $data['SLmin']   = $_REQUEST['SLmin'];
                $data['SP']   = $_REQUEST['SP'];
                $data['Priority']   = $_REQUEST['Priority'];
                
				
				$info['data']     =  $data;
				
				if(empty($_REQUEST['id']))
				{
					 $db->insert($info);
				}
				else
				{
					$Id            = $_REQUEST['id'];
					$info['where'] = "id=".$Id;
					
					$db->update($info);
				}
				
				include("../testdata/testdata_list.php");						   
				break;    
		case "edit":      
				$Id               = $_REQUEST['id'];
				if( !empty($Id ))
				{
					$info['table']    = "testdata";
					$info['fields']   = array("*");   	   
					$info['where']    =  "id=".$Id;
				   
					$res  =  $db->select($info);
				   
					$Id        = $res[0]['id'];  
					$TestID    = $res[0]['TestID'];
					$test_info   = $res[0]['test_info'];
                    $TestType   = $res[0]['TestType'];
					$Instr_no    = $res[0]['Instr_no'];
					$P1    = $res[0]['P1'];
					$P2    = $res[0]['P2'];
					$DPressure    = $res[0]['DPressure'];
					$DP    = $res[0]['DP'];
					$Lmin    = $res[0]['Lmin'];
					$SLmin    = $res[0]['SLmin'];
					$SP    = $res[0]['SP'];
					$Priority    = $res[0]['Priority'];
					
				 }
						   
				include("../testdata/testdata_editor.php");						  
				break;
						   
         case 'delete': 
				$Id               = $_REQUEST['id'];
				
				$info['table']    = "testdata";
				$info['where']    = "id='$Id'";
				
				if($Id)
				{
					$db->delete($info);
				}
				include("../testdata/testdata_list.php");						   
				break; 
						   
         case "list" :    	 
			  if(!empty($_REQUEST['page'])&&$_SESSION["search"]=="yes")
				{
				  $_SESSION["search"]="yes";
				}
				else
				{
				   $_SESSION["search"]="no";
					unset($_SESSION["search"]);
					unset($_SESSION['field_name']);
					unset($_SESSION["field_value"]); 
				}
				include("../testdata/testdata_list.php");
				break; 
        case "search_testdata":
				$_REQUEST['page'] = 1;  
				$_SESSION["search"]="yes";
				$_SESSION['field_name'] = $_REQUEST['field_name'];
				$_SESSION["field_value"] = $_REQUEST['field_value'];
				include("../testdata/testdata_list.php");
				break;  								   
						
	     default :    
		       include("../testdata/testdata_editor.php");		         
	   }

//Protect same image name
 function getMaxId($db)
 {
	   $info['table']    = "testdata";
	   $info['fields']   = array("max(id) as maxid");   	   
	   $info['where']    =  "1=1";
	  
	   $resmax  =  $db->select($info);
	   if(count($resmax)>0)
	   {
		 $max = $resmax[0]['maxid']+1;
	   }
	   else
	   {
		$max=0;
	   }	  
	   return $max;
 } 	 
?>
