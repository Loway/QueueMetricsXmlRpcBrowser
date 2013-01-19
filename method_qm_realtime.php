<?php
	include "./page/common_code.php.inc";
	include "./page/00header.php.inc";	

?>

      <h1>Method: QM.realtime</h1>
      <p>Display real-time system status</p>

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
                 new xmlrpcval($agent),
                 $req_blocks
  );

  $out =  queryServer( $qm_srv, $qm_port, $qm_webapp, "QM.realtime", $params );

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

     <label>Queues (separate with a pipe)</label>
     <input <?= nameVal("queues") ?> type="text" placeholder="e.g. 100|101">

    <label>Agent filter</label>
    <input <?= nameVal("agent") ?> type="text" placeholder="e.g. Agent/103 or SIP/201">

    <p>
    <button type="submit" class="btn">Submit</button>
</div>
<div class="span6">
    <label>Blocks</label>
    <textarea name="blocks" id="blocks" placeholder="Type something…" rows="6"><?= $_POST["blocks"] ?></textarea>

<div class="input-append">
  <input id="inputHelper" 
        type="text" class="span3" style="margin: 0 auto;" 
        data-provide="typeahead" data-items="10" 
        data-source='[<?= dsOptions($qmrealtime_blocks) ?>]'>
   
  <button class="btn" type="button" onclick="addValue();">Add</button>
</div>

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

