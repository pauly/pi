<?php
	$match = array( );
?><!doctype html>
<html>
<head>
	<title>Paul's pi homepage</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" href="/css/grid.css">
	<link rel="stylesheet" href="/css/layout.css">
	<link rel="stylesheet" href="/css/screen.css">
</head>
<body>
<div class="container">
	<div class="row col">
		<h1>raspberry pi</h1>
	</div>
	<div class="row">
		<div class="col content gbbs">
			<div id="gauge_div"></div>
			<h2><a href="#" class="source">Disk space</a></h2>
			<pre class="source" style="display: none"><?php
				unset( $output );
				exec( 'df', $output );
				$data = implode( "\n", $output );
				preg_match( '/(\d+)\%/', $data, $match );
				echo $data;
			?></pre>
			<h2><a href="#" class="source">Connected</a></h2>
			<pre class="source" style="display: none"><?php unset( $output ); exec( 'lsusb', $output ); echo implode( "\n", $output ); ?></pre>
			<h2><a href="#" class="source">Network</a></h2>
			<pre class="source" style="display: none"><?php unset( $output ); exec( 'arp | cut -c1-30', $output ); echo implode( "\n", $output ); ?></pre>
			<h2>Uptime</h2>
			<pre><?php echo exec('uptime'); ?></pre>

			<!-- <div class="row">
				<div class="col">
					<h4>Feature Block One</h4>
					<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et m. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>
				</div>

				<div class="col">
					<h4>Feature Block Two</h4>
					<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et m. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>
				</div>
			</div> -->

			<!-- <h3>And One Last Thing</h3>
			<p>Cum sociis natoque penatibus et m. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et m. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p> -->
		</div>

		<div class="col sidebar">

			<div class="row">
				<div class="col photo">
					<p><a href="https://picasaweb.google.com/lh/photo/LXFN5QD1l4oklJvujfjbldMTjNZETYmyPJy0liipFm0?feat=embedwebsite"><img src="https://lh5.googleusercontent.com/-neuAWRhQvRc/UKIjlLSmf_I/AAAAAAABV34/bSvwtEsDwZo/s288/IMG_0661.JPG" height="216" width="288" /></a></p>
					<p>From <a href="https://picasaweb.google.com/112554041628292689150/November2012?authuser=0&feat=embedwebsite">November 2012</a></p>
				</div>

				<div class="col">
					<h4>Links</h4>
					<ul class="vcard">
						<li><a rel="me" class="url fn n uid" href="http://www.clarkeology.com/blog/" title="All about Pauly">Paul Clarke</a><img class="photo" src="https://lh6.googleusercontent.com/-9R7Y6Un9q4M/ULyp458SI_I/AAAAAAABWcg/Uxou54FYA4c/s288/Screen%2520shot%25202012-12-03%2520at%252013.30.38.png" style="display: none" width="218" height="291" /></li>
						<li><a rel="me" href="http://picasaweb.google.com/paulypopex">Pictures</a></li>
						<li><a rel="me" href="http://www.youtube.com/user/folkestonegerald">Videos</a></li>
						<li><a rel="me" href="https://www.github.com/pauly">Github</a></li>
						<li><a href="http://www.clarkeology.com/misc/gigography/" title="List of old gigs">Gigography</a></li>
						<li><a class="google plus" rel="author" href="https://plus.google.com/112554041628292689150/about" title="Me on the google plus">Paul+</a></li>
						<li><a class="google plus" rel="author" href="https://twitter.com/pauly" title="Me on the Twitter">@Pauly</a></li>
					</ul>
				</div>
			</div>

		</div>
	</div>
</div>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
var gauge, gauge_data, gauge_options;
google.load( 'visualization', '1.0', { packages: [ 'corechart', 'gauge' ] } );
google.setOnLoadCallback( function () {
	gauge = new google.visualization.Gauge( document.getElementById( 'gauge_div' ));
	gauge_data = google.visualization.arrayToDataTable( [ ["Label", "Value"], ["Free space", <?php echo $match[1]; ?>] ] );
	gauge_options = {
		width: '200',
		height: '200',
		redFrom: 90,
		redTo: 100,
		yellowFrom: 75,
		yellowTo: 90,
		minorTicks: 5
	};
	gauge.draw( gauge_data, gauge_options );
} );
$( function () {
	$('a.source').click( function () {
		// $(this).parent('p').hide();
		$('pre.source').slideDown();
	} );
} );
</script>
</body>
</html>
