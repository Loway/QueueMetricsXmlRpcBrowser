<?php
	include "./page/common_code.php.inc";
	include "./page/00header.php.inc";	

?>

      <h1>Server configuration</h1>
      
<form method="POST" action="setup.php">
  <fieldset>
    <legend>Your QueueMetrics instance</legend>
    <label>QueueMetrics server IP</label>
    <input name="qmserver" type="text" 
           placeholder="yourserver" 
           value="<?= $qm_srv ?>">
    <span class="help-block">Example block-level help text here.</span>

    <label>QueueMetrics server port</label>
    <input name="qmport" type="text" 
           placeholder="e.g. 8080" 
           value="<?= $qm_port ?>">
    
    <label>QueueMetrics server webapp</label>
    <input name="qmwebapp" type="text" 
           placeholder="e.g. queuemetrics" 
           value="<?= $qm_webapp ?>">
    


    <label>Login</label>
    <input name="qmlogin" type="text" placeholder=""
           value="<?= $qm_login ?>">

    <label>Password</label>
    <input name="qmpass" type="password" placeholder=""
    		value="<?= $qm_pass ?>">   
    <br>

    <input type="hidden" name="op" value="setcookie">
    <button type="submit" class="btn">Change / Set</button>
  </fieldset>
</form>



<?php
	include "./page/00footer.php.inc";
?>

