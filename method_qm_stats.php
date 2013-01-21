<?php
	include "./page/common_code.php.inc";
	include "./page/00header.php.inc";	

?>

      <h1>Method: QM.stats</h1>
      <p>Extracts general reports from QueueMetrics</p>

<?php

if ( $_POST["op"] == "run" ) {

  $dtFrom = $_POST["dtFrom"];
  $dtTo   = $_POST["dtTo"];  
  $queues = $_POST["queues"];
  $agent  = $_POST["agent"];

  $req_blocks = generateRequestFromBlockList( $_POST["blocks"] );

  $params = array(
                 new xmlrpcval($queues),
                 new xmlrpcval($qm_login),
                 new xmlrpcval($qm_pass),
                 new xmlrpcval(""),
                 new xmlrpcval(""),
                 new xmlrpcval($dtFrom),
                 new xmlrpcval($dtTo),
                 new xmlrpcval($agent),
                 $req_blocks
  );

  $out =  queryServer( $qm_srv, $qm_port, $qm_webapp, "QM.stats", $params );

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
    <label>Date from</label>
    <input <?= nameVal("dtFrom") ?> type="text" 
           placeholder="Format yyyy-mm-dd.hh:mm:ss" 
           class="input-xlarge">
    <label>Date to</label>
    <input <?= nameVal("dtTo") ?> type="text" 
          placeholder="Format yyyy-mm-dd.hh:mm:ss"
          class="input-xlarge">
    <label>Agent filter</label>
    <input <?= nameVal("agent") ?> type="text" 
          placeholder="Agent code, or leave blank" 
          class="input-xlarge">
    <br>
    <!-- <span class="help-block">Example block-level help text here.</span> -->
    <button type="submit" class="btn btn-primary btn-large">Run query</button>
</div>
<div class="span6">
    <label>Blocks</label>
    <textarea name="blocks" id="blocks" 
           placeholder="Format: DO.method"
           rows="6"
           class="input-xlarge"><?= $_POST["blocks"] ?></textarea>

<div class="input-append">
  <input id="inputHelper" type="text" class="span3" style="margin: 0 auto;" 
  data-provide="typeahead" data-items="4" 
  data-source='[<?= dsOptions($qmstats_blocks) ?>]'>
   
  <button class="btn" type="button" onclick="addValue();">Add</button>
</div>

     <label>Queues (separate with a pipe)</label>
     <input <?= nameVal("queues") ?> type="text" 
        placeholder="e.g A|B|C"
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

