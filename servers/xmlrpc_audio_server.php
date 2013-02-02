<?php
//
// This is an example of a remote audio XML-RPC server for QueueMetrics.
// In QueueMetrics, calls to this client are activated by entering its URL in
// the 'default.audioRpcServer' property.
//
// Change configuration.properties so that:
//
//
// default.audioRpcServer=http://127.0.0.1/QueueMetricsXmlRpcBrowser/servers/xmlrpc_audio_server.php
//
//
// In order to make it very easy to customize, you should change the contents of the
// functions 'find_file()' and 'listen_call()' only. You can populate some or all of the 
// return fields, according to the data you actually have. As the calling user is passed along,
// it's pretty easy to log who listened to which calls if you need to do it.
// 
//

include "../lib/xmlrpc.inc";
include "../lib/xmlrpcs.inc";


// the following variables hold the return status for your file.

// Listening to a stored call
$FILE_FOUND      = false;
$FILE_LISTEN_URL = "";
$FILE_LENGTH     = "";
$FILE_ENCODING   = "";
$FILE_DURATION   = ""; 

// Listening to an ongoing call
$CALL_FOUND        = false;
$CALL_LISTEN_URL   = "";
$CALL_POPUP_WIDTH  = "";
$CALL_POPUP_HEIGHT = "";


//
// This function must be implemented by the user.
//
function find_file( $ServerID, $AsteriskID, $QMUserID, $QMUserName ) {
	global $FILE_FOUND;
	global $FILE_LISTEN_URL;
	global $FILE_LENGTH;
	global $FILE_ENCODING;
	global $FILE_DURATION;

	$FILE_FOUND      = true;

	// if found single file...
	// note that the parameters returned are just strings, so you can put anything in them
	$FILE_LISTEN_URL = "http://listennow.server/$ServerID/$AsteriskID/$QMUserID/$QMUserName";
	$FILE_LENGTH     = "125k";
	$FILE_ENCODING   = "mp3";	
	$FILE_DURATION   = "1:12"; 	

	// if found multiple files
	// add MULTI: to FILE_LISTEN_URL
	// separate entries with a space
	// add the same number of entries for each record
	//$FILE_LISTEN_URL = "MULTI:http://listennow.server/$ServerID/$AsteriskID/$QMUserID/$QMUserName http://file2 http://file3";
	//$FILE_LENGTH     = "125000 100 200";
	//$FILE_ENCODING   = "mp3 - -";	
	//$FILE_DURATION   = "1:12 1:10 -"; 	

}

function listen_call( $ServerID, $AsteriskID, $Agent, $QMUserID, $QMUserName, $Direction ) {
	global $CALL_FOUND;
	global $CALL_LISTEN_URL;
	global $CALL_POPUP_WIDTH;
	global $CALL_POPUP_HEIGHT;

	$CALL_FOUND      = false;
	$CALL_LISTEN_URL = "http://listennow.server/$ServerID/$AsteriskID/$QMUserID/$QMUserName/$Agent/$Direction";
	$CALL_POPUP_WIDTH = "200";
	$CALL_POPUP_HEIGHT = "250";
}


// 
// This function does the XML-RPC call handling
// All the PHP's XML-RPC details are handled here.
//
function xmlrpc_find_file( $params ) {
	global $FILE_FOUND;
	global $FILE_LISTEN_URL;
	global $FILE_LENGTH;
	global $FILE_ENCODING;	
	global $FILE_DURATION;
	
	$p0 = $params->getParam(0)->scalarval(); // server ID
	$p1 = $params->getParam(1)->scalarval(); // Asterisk call ID
	$p2 = $params->getParam(2)->scalarval(); // QM User ID
	$p3 = $params->getParam(3)->scalarval(); // Qm user name
	
	find_file( $p0, $p1, $p2, $p3 ); 		
	
	$response = new xmlrpcval(array(
        new xmlrpcval( $FILE_FOUND, 'boolean' ),
        new xmlrpcval( $FILE_LISTEN_URL ),
        new xmlrpcval( $FILE_LENGTH ),
        new xmlrpcval( $FILE_ENCODING ),
        new xmlrpcval( $FILE_DURATION ),        
    ), "array");
	
	return new xmlrpcresp($response);
}

function xmlrpc_listen_call_inbound( $params ) {
	xmlrpc_listen_call( $params, "INBOUND" );
}

function xmlrpc_listen_call_outbound( $params ) {
	xmlrpc_listen_call( $params, "OUTBOUND" );
}


function xmlrpc_listen_call( $params, $direction ) {
	global $CALL_FOUND;
	global $CALL_LISTEN_URL;
	global $CALL_POPUP_WIDTH;
	global $CALL_POPUP_HEIGHT;

	$p0 = $params->getParam(0)->scalarval(); // server ID
	$p1 = $params->getParam(1)->scalarval(); // asterisk call ID
	$p2 = $params->getParam(2)->scalarval(); // agent code
	$p3 = $params->getParam(3)->scalarval(); // QM user ID
	$p4 = $params->getParam(3)->scalarval(); // QM user name
	
	listen_call( $p0, $p1, $p2, $p3, $p4, $direction ); 		
	
	$response = new xmlrpcval(array(
        new xmlrpcval( $CALL_FOUND, 'boolean' ),
        new xmlrpcval( $CALL_LISTEN_URL ),
        new xmlrpcval( $CALL_POPUP_WIDTH, 'int' ),
        new xmlrpcval( $CALL_POPUP_HEIGHT, 'int' ),             
    ), "array");
	
	return new xmlrpcresp($response);
}



//
// Instantiates a very simple XML-RPC audio server for QueueMetrics
//
$server = new xmlrpc_server(
    array(
        'QMAudio.findStoredFile' => array(
            'function' => 'xmlrpc_find_file'
        ),    
        'QMAudio.listenOngoingCall' => array(
            'function' => 'xmlrpc_listen_call_inbound'
        ),
        'QMAudio.listenOngoingCallOutbound' => array(
            'function' => 'xmlrpc_listen_call_outbound'
        ),
        
    ),
    1  // serviceNow
);


?>
