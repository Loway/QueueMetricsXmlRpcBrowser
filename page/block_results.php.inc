
<!-- block results -->

<?php
    $err = $out["error"];
    if ( strlen( $err) ) {
        echo "<h1>Connection error:</h1> $err <hr>";
    }

?>


<div class="tabbable tabs-left" >
  <ul class="nav nav-tabs" id="myTab">
    <li class="active"><a href="#result_" data-toggle="tab">RESULT</a></li>
    <?= $out["blockList"] ?>
  </ul>
  <div class="tab-content">
    <div class="tab-pane active" id="result_">
      <p><?= $out["resultBlock"] ?></p>
    </div>
    <?= $out["blockHtml"] ?>
  </div>
</div>


