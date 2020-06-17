<?php
include("../template/login_header.php");
?>
<body>
  
  <div class="ribbon ior"></div>
  <div class="login io">
<div class="press"> <span></span></div>

    

  <h1>mozarbazaar</h1>
  
  <span align="center"><font color="#FF0000"><?=$message?></font></span>
	<form  action="" method="post">
		<h3>Resend verification code?</h3>
		<p>
			 Enter your e-mail address below to resend your code.
		</p>
		<div class="input">
         <div class="blockinput">
          <i class="icon-envelope-alt"></i>
			<input type="email" placeholder="Email" name="email" id="email" value="" class="textbox" />
		  </div>      
        </div>
		<div class="form-actions">
            <input type="hidden" name="cmd" value="resend_code"/>  
			<button>Submit</button>
		</div>
	</form>
    <a href="../login/index.php">Back</a>
</div>

</body>
<?php
include("../template/footer.php");
?>