<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>A QueueMetrics XML-RPC browser</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="./bootstrap/css/bootstrap.css" rel="stylesheet">
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
    <link href="./bootstrap/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="./bootstrap/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="./bootstrap/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="./bootstrap/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="./bootstrap/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="./bootstrap/ico/favicon.png">
  </head>

  <body data-spy="scroll" data-target=".bs-docs-sidebar">

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#">QueueMetrics XML-RPC Browser</a>
          <div class="nav-collapse collapse">
            <ul class="nav">

              <li><a href="index.php">Home page</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  Main reports
                  <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="method_qm_stats.php">QM.stats</a></li>
                  <li><a href="method_qm_realtime.php">QM.realtime</a></li>    
                  <li><a href="method_qm_findaudio.php">QM.findAudio</a></li>              
                </ul>                
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  Users
                  <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="#">QM.auth</a></li>
                  <li><a href="#">QM.authenticate</a></li>                  
                </ul>                
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  QA
                  <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="#">QM.getQueuesForAgent</a></li>
                  <li><a href="#">QM.getPauseCodesForAgent</a></li>                  
                </ul>                
              </li>



            </ul>
            <ul class="nav pull-right">
<?php 
  if ( strlen($qm_srv) == 0 ) {
?>
              <li><button class="btn btn-danger" onclick="javascript:location.href='setup.php'">Click here to configure the server</button></li>
<?php
  } else {
?>
                <li><a href="setup.php">User: <?= $qm_login ?> @ 
                    http://<?= $qm_srv ?>:<?= $qm_port ?>/<?= $qm_webapp ?></a></li>
<?php
  }
?>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">
