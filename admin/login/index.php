<?php
       session_start();
	   include("../../common/lib.php");
	   include("../../lib/class.db.php");
	   include("../../common/config.php");
	   	   
	   $cmd = $_REQUEST['cmd'];
	 
		switch($cmd)
		{
		
		  case "login":
				$info["table"]     = "users";
				$info["fields"]   = array("*");
				$info["where"]    = " 1=1 AND email='".clean($_REQUEST["email"])."' AND password='".clean($_REQUEST["password"])."'";
				$res  = $db->select($info);
				if(count($res)>0)
				{
					$_SESSION["users_id"]   = $res[0]["id"];
					$_SESSION["email"]      = $res[0]["email"];
					$_SESSION["first_name"] = $res[0]["first_name"];
					$_SESSION["last_name"]  = $res[0]["last_name"];
					$_SESSION['verified']   =  $res[0]["verified"];
					$_SESSION["type"]       = $res[0]["type"];
					
					/*if($_SESSION['verified']=="no")
					{
						$message="Login fail,Please verify your account";
						include("verification_editor.php");
						break;
					}*/
					Header("Location: ../login/login_enter.php");
				
				}							 
				else
				{
					$message="Login fail,Please check your userid or password";
					include("login_editor.php");
				}	
				break;	
		case "logout":
				session_destroy();
				unset($_SESSION["users_id"]);
				unset($_SESSION["email"]);
				unset($_SESSION["first_name"]);
				unset($_SESSION["last_name"]);
				unset($_SESSION["type"]);
				
				include("login_editor.php");
				break;	
				case "forget_editor":
				include("forget_editor.php");
				break;	
		case "forget_editor":
				include("forget_editor.php");
				break;	   	 			   	 	
	    case "forget_pass":
			 	$info["table"]     = "users";
				$info["fields"]   = array("*");
				$info["where"]    = " 1=1 AND email  LIKE BINARY '".$_REQUEST["email"]."'";
				$res  = $db->select($info);
				if(count($res)>0)
				{
					$email      = $res[0]["email"];	   	 
					$password      = $res[0]["password"];
					$cell_no      = $res[0]["cell_no"];
					 //send email
					$headers  = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					
					// Additional headers
					//$headers .= 'To: '.$data['email'].'' . "\r\n";
					$headers .= 'From: DoE <sadiqulislam@doe-bd.org>' . "\r\n";
					//$headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
					//$headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";
					
					// Mail it
					$subject = "Forget Password from PS ID"; 
					$message_body  = "Your userid $email   and password $password ";
					
					$message = "An email has been sent with your login information";
					mail($email, $subject, $message_body, $headers);
					 //send message
					
					include("login_editor.php");
					break;	
				}
				else
				{
					$message ="No Email is exists with this email";	
					include("forget_editor.php");
					break;	 
				}
				break;
		case "verification_editor":
				include("verification_editor.php");
				break;	   	 	
	    case "resend_code":
			 	$info["table"]     = "users";
				$info["fields"]   = array("*");
				$info["where"]    = " 1=1 AND email  LIKE BINARY '".$_REQUEST["email"]."'";
				$res  = $db->select($info);
				if(count($res)>0)
				{
				    $id                = $res[0]["id"];
					$email             = $res[0]["email"];	   	 
					$password          = $res[0]["password"];
					$verification_code =  sha1(time());
					
					
					   unset($info);
					   unset($data);
					 $info["table"]                =  "users"; 
					 $data['verification_code']    = $verification_code;
					 $info['data']                 =  $data;
					 $info['where']                =  "id='".$id."'";
					   $db->update($info);
				
					 //send email
					$headers  = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					
					// Additional headers
					//$headers .= 'To: '.$data['email'].'' . "\r\n";
					$headers .= 'From: mozarbazaar.com<info@mozarbazaar.com>' . "\r\n";
					//$headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
					//$headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";
					
					// Mail it
					$subject = "You requested activation code from mozarbazaar"; 
					$message_body  = get_code_message($email ,$password,$verification_code);
					
					$message = "An email  been sent with your activation code";
					mail($email, $subject, $message_body, $headers);
					
					include("verification_editor.php");
					break;	
				}
				else
				{
					$message ="No Email is exists with this email";	
					include("verification_editor.php");
					break;	 
				}
				break;		
		case "verify":
		        $info["table"]     = "users";
				$info["fields"]   = array("*");
				$info["where"]    = " 1=1 AND verification_code='".$_REQUEST["code"]."'";
				$res  = $db->select($info);
				if(count($res)>0)
				{
				     unset($info);
					 unset($data);
					$info['table']    = "users";
					$data['verified']   = 'yes';
					$info['data']     =  $data;
					$info['where'] = "verification_code='".$_REQUEST["code"]."'";
					$db->update($info);
				
				     $message ="You are now verified.Please login now.";
				}    
				else
				{
				     $message ="Verified code mismatch";
				}
				include("login_verified.php");
		       break;		   	 
		default :					 
				session_destroy();
				unset($_SESSION["users_id"]);
				unset($_SESSION["email"]);
				unset($_SESSION["first_name"]);
				unset($_SESSION["last_name"]);
				unset($_SESSION["type"]);
							
				include("login_editor.php");
		}	
 function get_code_message($userid,$password,$verification_code)
 {
       $str = "Dear Client,<br>
	        You requested activation code.<br>  
			Please click the link below to make your account activate.<br>
			<a href=\"http://mozarbazaar.com/member/login/index.php?cmd=verify&code=$verification_code\">$verification_code</a><br>
	        You login info is:<br> 
	        Your userid :$userid  <br>
			Password    :$password <br>
			Thanks,<br>
			PS ID Team<br>";    
	    
		return $str;
 }		
 function clean($str) {
	$str = @trim($str);
	if(get_magic_quotes_gpc()) {
		$str = stripslashes($str);
	}
	$str = stripslashes($str);
	$str = str_replace("'","",$str);
	$str = str_replace('"',"",$str);
	$str = str_replace("-","",$str);
	$str = str_replace(";","",$str);
	$str = str_replace("or 1","",$str);
	$str = str_replace("drop","",$str);
	
	return mysql_real_escape_string($str);
}					
?>