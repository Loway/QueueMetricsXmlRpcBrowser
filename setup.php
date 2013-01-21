<?php
	include "./page/common_code.php.inc";
	include "./page/00header.php.inc";	

?>

      <h1>Server configuration</h1>
      
<form method="POST" action="setup.php">
  <fieldset>
    <legend>Your QueueMetrics instance</legend>
    <label>QueueMetrics server IP address</label>
    <input name="qmserver" type="text" 
           placeholder="yourserver"
           class="input-xxlarge" 
           value="<?= $qm_srv ?>">
    <span class="help-block">Example block-level help text here.</span>

    <label>QueueMetrics server port</label>
    <input name="qmport" type="text" 
           placeholder="e.g. 8080"
           class="input-xxlarge"  
           value="<?= $qm_port ?>">
    
    <label>QueueMetrics server webapp</label>
    <input name="qmwebapp" type="text" 
           placeholder="e.g. queuemetrics" 
           class="input-xxlarge" 
           value="<?= $qm_webapp ?>">
    
    <legend>Access credentials</legend>
    <label>Login (user must be active and hold the ROBOT security key)</label>
    <input name="qmlogin" type="text" placeholder=""
          class="input-xxlarge" 
           value="<?= $qm_login ?>">

    <label>Password</label>
    <input name="qmpass" type="password" placeholder=""
        class="input-xxlarge" 
    		value="<?= $qm_pass ?>">   
    <br>

    <input type="hidden" name="op" value="setcookie">
    <button type="submit" class="btn btn-primary btn-large">Change / Set</button>
  </fieldset>
</form>



<?php
	include "./page/00footer.php.inc";
?>

