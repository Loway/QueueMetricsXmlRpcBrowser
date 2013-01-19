<?php
	include "./page/common_code.php.inc";
	include "./page/00header.php.inc";	

?>

	<h1>A QueueMetrics XML-RPC browser</h1>

	<p>
		This application lets you query the QueueMetrics XML-RPC interface interactively.
		<br>

	</p>

	<p>
		To get started, <a href="setup.php">click here to set up your QueueMetrics server</a>
		and when done select one of the reports. Please check the XML-RPC manual to 
		see what format is required for each parameter.
	</p>

	<div class="well">
	<p>
		<i>Please note that at the moment only a few XML-RPC method calls are implemented.
			We plan to implement them all in future releases. Feel free to contribute.</i>
	</p>
	</div>


		<h2>Useful links</h2>
	<p>
		<ul>
		<li><a href="https://github.com/Loway/QueueMetricsXmlRpcBrowser"  target="_new">Project site</a> on GitHub - feel free to fork and modify.</li>
		<li><a href="http://queuemetrics.com/manuals/QM_XML-RPC_manual-chunked/" target="_new">XML-RPC Documentation reference</a></li>
		<li><a href="http://forum.queuemetrics.com/index.php?board=11.0" target="_new">QueueMetrics XML-RPC forums</a></li>		
		<li><a href="http://queuemetrics.com" target="_new">QueueMetrics web site</a></li>		
	</ul>
</p>

	<h2>Misc</h2>
	<p>
		<li>This project includes the <a href="http://phpxmlrpc.sourceforge.net/" target="_new">PHP XML-RPC</a> libray, version 2.2.2, released under the BSD license.</li>	
		<li>Theme and layout: <a href="http://twitter.github.com/bootstrap/" target="_new">Twitter Bootstrap</a></li>	
		
	</p>


      





<?php
	include "./page/00footer.php.inc";
?>

