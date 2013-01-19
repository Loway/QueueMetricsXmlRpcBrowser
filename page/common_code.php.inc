<?php

// Common code
include "./lib/xmlrpc.inc";
include "./blocks/qmstats.php.inc";
include "./blocks/qmrealtime.php.inc";

#require_once "XML/RPC.php";

$qm_srv    = $_COOKIE["qmserver"];
$qm_port   = $_COOKIE["qmport"];
$qm_webapp = $_COOKIE["qmwebapp"];
$qm_login  = $_COOKIE["qmlogin"];
$qm_pass   = $_COOKIE["qmpass"];

$op = $_POST["op"];

if ( $op == "setcookie" ) {
	$qm_srv    = $_POST["qmserver"];
	$qm_port   = $_POST["qmport"];
	$qm_webapp = $_POST["qmwebapp"];
	$qm_login  = $_POST["qmlogin"];
	$qm_pass   = $_POST["qmpass"];

	setcookie( "qmserver", $qm_srv );
	setcookie( "qmport",   $qm_port );
	setcookie( "qmwebapp", $qm_webapp );
	setcookie( "qmlogin",  $qm_login );
	setcookie( "qmpass",   $qm_pass );
				
}


//
// Output a response block as a Bootstrap compact table
// 

function printBlock( $blockname, $blocks ) {


		$s = "<div class='tab-pane' id='" . makeId( $blockname) .  "''>";
        $s .= "<h2>Response block: $blockname </h2>";
        
        $block = $blocks[$blockname];
        if ( sizeof($block) == 0 ) {
        	$s .= "--Block not found--";
        } else {

        	$s .= "<table class='table table-condensed table-striped table-bordered'>";

        for ( $r = 0; $r < sizeof( $block ); $r++ ) {
                
                $s .= ($r > 0) ? "<tr>" : "<tr class=\"success\">";
                for ( $c = 0; $c < sizeof( $block[$r] ); $c++ ) {
                        $s .= "<td>" . $block[$r][$c] . "</td>" ;                		
                }
                $s .= "</tr>\n";
        }
        $s .= "</table>";
    	}
        $s .= "</div>";
        return $s;
}

function spySelector( $blockname ) {
	//return "<li><a href=\"#$blockname\"><i class=\"icon-chevron-right\"></i> $blockname </a></li>";
	return "<li ><a href=\"#" . makeId($blockname)  . "\" data-toggle=\"tab\">$blockname</a></li>";
}

function makeId( $blockname ) {
	return str_replace( ".", "_", $blockname );	
}

function dsOptions( $arOptions ) {
	$s = "";
	for ( $i = 0; $i < sizeof($arOptions); $i++ ) {
		if ( $i > 0 ) {
			$s .= ", ";
		}
		$s .= "\"" . $arOptions[$i] . "\"";
	}
	return $s;
}

function nameVal( $name ) {
	$v = $_POST[$name];
	return " name=\"$name\" value=\"$v\" "; 
}


function queryServer( $qm_srv, $qm_port, $qm_webapp, $method, $params ) {

	$out["error"] = "";
	$out["blockList"] = "";
	$out["blockHtml"] = "";
    $out["resultBlock"] = "";

  $c = new xmlrpc_client("$qm_webapp/xmlrpc.do", $qm_srv, (integer) $qm_port );
  $c->return_type = 'phpvals'; // let client give us back php values instead of xmlrpcvals
  //$c->return_type = 'xml'; // let client give us back php values instead of xmlrpcvals
  $r =& $c->send(new xmlrpcmsg( $method, $params));
  if($r->faultCode()) {
    $out["error"] =  htmlspecialchars($r->faultString());
  }
  else
  {

    $blocks = $r->value();

    // result always goes first    
  $out["resultBlock"]  = printBlock( "result", $blocks);

    foreach ($blocks as $key => $value) {      
      if ( $key != "result" ) {
        $side .= spySelector( $key );
        $blk  .= printBlock( $key, $blocks);
      }
    }

    $out["blockList"] = $side;
	$out["blockHtml"] = $blk;

          
  }

  return $out;

}


function generateRequestFromBlockList( $blks ) {
  
  $blocks = preg_split( "/\n/", $blks );
  
  $blkArr = array();
  for ( $i = 0; $i < sizeof( $blocks); $i++  ) {
    $v = $blocks[$i];
    if ( strlen($v) > 3 ) {
      array_push( $blkArr, new xmlrpcval( $v ) );
    }
  }

  $req_blocks = new xmlrpcval($blkArr, "array" );
  return $req_blocks;
}

?>