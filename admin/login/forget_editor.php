<?php
include("../template/login_header.php");
?>
<body>
  
  <div class="ribbon ior"></div>
  <div class="io">
<div class="press"> <span></span></div>

  <span align="center"><font color="#FF0000"><?=$message?></font></span>
  
  <form method="POST" action="">
   <h3>Forgate Password</h3>      
    <div class="input">
      <div class="blockinput">
        <i class="icon-envelope-alt"></i><input type="email" placeholder="Email" name="email" id="email" value="" class="textbox" />
      </div>      
    </div>
    <input type="hidden" name="cmd" value="forget_pass"/> 
     <button class="submit_btn">Submit</button>
     <a class="back_btn" href="../login/index.php">Back</a>
  </form>
  <a class="varifications_text" href="../login/index.php?cmd=verification_editor">Resend verification code?</a>
 
</body>
<?php
include("../template/footer.php");
?>