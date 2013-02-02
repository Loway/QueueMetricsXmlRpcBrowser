QueueMetricsXmlRpcBrowser
=========================

An XML-RPC services browser for QueueMetrics written in PHP.

Meant to be easy to set-up - just clone it in a directory to be put on a server supporting PHP.
You need to have QueueMetrics reachable over its HTTP port from the server, of course.

Very initial release - at the moment only QM.stats(), QM.realtime() and QM.findAudio() are implemented.

Installation
------------

Just download the project over GIT (or as a Zip file) and uncompress it in a folder 
under a webserver running PHP.

No database connection used.


Changelog
=========

* Feb 2, 2013: Added QM.findAudio() and added sample xmlrpc_audio_server.php under '/servers'
* Jan 21, 2013: Initial release


