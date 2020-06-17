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
				$info['table']    = "projectinfo";
				$data['TestID']   = $_REQUEST['TestID'];
                $data['Test_name']   = $_REQUEST['Test_name'];
                $data['Customer']   = $_REQUEST['Customer'];
                $data['Project_No']   = $_REQUEST['Project_No'];
                $data['Serial_no']   = $_REQUEST['Serial_no'];
                $data['Drawing_no']   = $_REQUEST['Drawing_no'];
                $data['s_water']   = $_REQUEST['s_water'];
                $data['Pressure']   = $_REQUEST['Pressure'];
                $data['mix_percent']   = $_REQUEST['mix_percent'];
                $data['tolerance_percent']   = $_REQUEST['tolerance_percent'];
                $data['Userid']   = $_REQUEST['Userid'];
                $data['date_time']   = $_REQUEST['date_time'];
                $data['date_time_approve']   = $_REQUEST['date_time_approve'];
                $data['Approvedby']   = $_REQUEST['Approvedby'];
				
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
				
				include("../projectinfo/projectinfo_list.php");						   
				break;    
		case "edit":      
				$Id               = $_REQUEST['id'];
				if( !empty($Id ))
				{
					$info['table']    = "projectinfo";
					$info['fields']   = array("*");   	   
					$info['where']    =  "id=".$Id;
				   
					$res  =  $db->select($info);
				   
					$Id        = $res[0]['id'];  
					$TestID    = $res[0]['TestID'];
					$Test_name    = $res[0]['Test_name'];
					$Customer    = $res[0]['Customer'];
					$Project_No    = $res[0]['Project_No'];
					$Serial_no    = $res[0]['Serial_no'];
					$Drawing_no    = $res[0]['Drawing_no'];
					$s_water    = $res[0]['s_water'];
					$Pressure    = $res[0]['Pressure'];
					$mix_percent    = $res[0]['mix_percent'];
					$tolerance_percent    = $res[0]['tolerance_percent'];
					$Userid    = $res[0]['Userid'];
					$date_time    = $res[0]['date_time'];
					$date_time_approve    = $res[0]['date_time_approve'];
					$Approvedby    = $res[0]['Approvedby'];
					
				 }
						   
				include("../projectinfo/projectinfo_editor.php");						  
				break;
						   
         case 'delete': 
				$Id               = $_REQUEST['id'];
				
				$info['table']    = "projectinfo";
				$info['where']    = "id='$Id'";
				
				if($Id)
				{
					$db->delete($info);
				}
				include("../projectinfo/projectinfo_list.php");						   
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
				include("../projectinfo/projectinfo_list.php");
				break; 
        case "search_projectinfo":
				$_REQUEST['page'] = 1;  
				$_SESSION["search"]="yes";
				$_SESSION['field_name'] = $_REQUEST['field_name'];
				$_SESSION["field_value"] = $_REQUEST['field_value'];
				include("../projectinfo/projectinfo_list.php");
				break;  								   
						
	     default :    
		       include("../projectinfo/projectinfo_editor.php");		         
	   }

//Protect same image name
 function getMaxId($db)
 {
	   $info['table']    = "projectinfo";
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
