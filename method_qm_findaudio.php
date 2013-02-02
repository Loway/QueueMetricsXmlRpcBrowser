<?php
	include "./page/common_code.php.inc";
	include "./page/00header.php.inc";	

?>

      <h1>Method: QM.findaudio</h1>
      <p>Finds audio recordings related to a call (given the call's unique-id)</p>

<?php

if ( $_POST["op"] == "run" ) {

  $srv     = $_POST["srv"];
  $unique  = $_POST["unique"];  
  $start   = $_POST["start"];
  $age     = $_POST["age"];
  $que     = $_POST["que"];

  $params = array(
                 new xmlrpcval($qm_login),
                 new xmlrpcval($qm_pass),
                 new xmlrpcval($srv),
                 new xmlrpcval($unique),
                 new xmlrpcval($start),
                 new xmlrpcval($age),
                 new xmlrpcval($que)
  );

  $out =  queryServer( $qm_srv, $qm_port, $qm_webapp, "QM.findAudio", $params );

}

?>

<script>
function addValue() {
  var val = $("#inputHelper").val();
  var oltText = $("#blocks").val();
  $( "#blocks" ).val( oltText + "\n" + val );  
}
</script>    

<form method="POST">
<div class="row">

<div class="span6">
    <label>Asterisk Unique-Id</label>
    <input <?= nameVal("unique") ?> type="text" 
           placeholder="Format srv-1234567.1234" 
           class="input-xlarge">
    <label>Server</label>
    <input <?= nameVal("srv") ?> type="text" 
          placeholder="Server name, or leave blank"
          class="input-xlarge">

    <span class="help-block">Having a start-of-call timestamp is mandatory for <i>LocalFilesByDay</i> 
      and similar PMs. Specific PMs may or may not need the <i>Queue</i> and <i>Agent</i> parameters.</span>

    
    <button type="submit" class="btn btn-primary btn-large">Run query</button>
</div>
<div class="span6">
    <label>Start of call</label>
    <input <?= nameVal("start") ?> type="text" 
          placeholder="Timestamp (or leave blank)" 
          class="input-xlarge">
    <br>


    <label>Queue</label>
    <input <?= nameVal("que") ?> type="text" 
           placeholder="Optional" 
           class="input-xlarge">

    <label>Agent</label>
    <input <?= nameVal("age") ?> type="text" 
           placeholder="Optional" 
           class="input-xlarge">


</div>

</div>        

<input type="hidden" name="op" value="run">
</form>

<?php
  include "./page/block_results.php.inc";
?>


<?php
	include "./page/00footer.php.inc";
?>

