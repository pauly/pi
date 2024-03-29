<?php
  ini_set( 'display_errors', 'On' );
  error_reporting( E_ALL );
  $output = array( );
  $match = array( );
  $ustream = json_decode( file_get_contents( 'http://api.ustream.tv/json/channel/paulypopex/getValueOf/status?key=4C8C8AA9814C796A8C908D1E6315FAE7' ));
?><!doctype html>
<html>
<head>
  <title>Paul's pi homepage</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <link rel="stylesheet" href="/css/grid.css">
  <link rel="stylesheet" href="/css/layout.css">
  <link rel="stylesheet" href="/css/screen.css">
  <link rel="stylesheet" href="/css/home_automation_stats.css">
</head>
<body>
<div class="container">
  <div class="row col">
    <h1>raspberry pi</h1>
  </div>
  <div class="row">
    <div class="col content gbbs">
      <dl>
        <dt>This is my <a href="http://amzn.to/Xm9XJ7">raspberry pi</a> homepage.</dt>
        <dd>This site is hosted on my <a href="http://amzn.to/Xm9XJ7">raspberry pi</a>, from my house. So it may be slow, or unavailable at any time.</dd>
        <dt><a>Home Automation</a></dt>
        <dd>
          <p>Securing this one soon, just here for fun! See my <a href="https://github.com/pauly/lightwaverf">lightwaverf gem</a> (just <a href="https://rubygems.org/gems/lightwaverf">gem install lightwaverf</a>), get a <a href="http://amzn.to/V7yPPK">wifi link</a> and <a href="http://amzn.to/RkukDo">remote socket</a> and you're good to go...</p>
          <div id="energy_chart"></div>
          <p>Rooms and devices:</p>
          <dl>
            <?php
              $json = exec( '/usr/local/bin/lightwaverf-config-json' );
              $config = json_decode( $json, true );
              foreach ( $config['room'] as $name => $devices ) {
                echo '<dt><a>' . $name . '</a></dt>';
                echo '<dd style="display: none"><dl>';
                foreach ( $devices as $device ) {
                  echo '<dt><a>' . $device . '</a></dt>';
                  echo '<dd style="display: none">In theory you could be turning ' . $name . ' ' . $device . ' ';
                  echo '<a class="ajax" href="/automation/' . $name . '/' . $device . '/on">on</a>';
                  echo ' or ';
                  echo '<a class="ajax" href="/automation/' . $name . '/' . $device . '/off">off</a>';
                  echo ' here!</dd>';
                }
                echo '</dl></dd>';
              }
            ?>
          </dl>
        </dd>
        <dt><a>Paul TV (<?php echo $ustream->results; ?>)</a></dt>
        <dd<?php echo $ustream->results == 'offline' ? ' style="display: none"' : '' ?>><iframe width="720" height="437" src="http://www.ustream.tv/embed/12921939?v=3&amp;wmode=direct" scrolling="no" frameborder="0" style="border: 0px none transparent;"></iframe>
        <br /><a href="http://www.ustream.tv/">Live broadcast by Ustream</a>, enabled occasionally so I can demo my <a href="http://www.clarkeology.com/wiki/home+automation">home automation</a> things.</dd>
        <dt><a>Disk space</a></dt>
        <dd style="display: none"><pre><?php
          unset( $output );
          exec( 'df', $output );
          $data = implode( "\n", $output );
          preg_match( '/(\d+)\%/', $data, $match );
          echo $data;
        ?></dd>
        <dt><a>Connected</a></dt>
        <dd style="display: none"><pre><?php unset( $output ); exec( 'lsusb', $output ); echo implode( "\n", $output ); ?></pre></dd>
        <dt><a>Network</a></dt>
        <dd style="display: none"><pre><?php unset( $output ); exec( 'arp | cut -c1-30', $output ); echo implode( "\n", $output ); ?></pre></dd>
        <dt>Uptime</dt>
        <dd><?php echo exec('uptime'); ?></dd>
      </dl>
    </div>

    <div class="col sidebar">

      <div class="row">
        <div class="col photo">
          <p><a href="https://picasaweb.google.com/lh/photo/LXFN5QD1l4oklJvujfjbldMTjNZETYmyPJy0liipFm0?feat=embedwebsite"><img src="https://lh5.googleusercontent.com/-neuAWRhQvRc/UKIjlLSmf_I/AAAAAAABV34/bSvwtEsDwZo/s288/IMG_0661.JPG" height="216" width="288" /></a></p>
          <p>From <a href="https://picasaweb.google.com/112554041628292689150/November2012?authuser=0&feat=embedwebsite">November 2012</a></p>
        </div>

        <div class="col">
          <iframe src="http://rcm-uk.amazon.co.uk/e/cm?lt1=_blank&bc1=000000&IS2=1&bg1=FFFFFF&fc1=000000&lc1=0000FF&t=clarkeology-21&o=2&p=8&l=as4&m=amazon&f=ifr&ref=ss_til&asins=B009SMWSQA" style="width:120px;height:240px;" scrolling="no" marginwidth="0" marginheight="0" frameborder="0"></iframe>

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
      <div div class="col" id="gauge_div"></div>

    </div>

  </div>
</div>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
var gauge, gauge_data, gauge_options;
google.load( 'visualization', '1.0', { packages: [ 'corechart', 'gauge', 'annotatedtimeline' ] } );
google.setOnLoadCallback( function ( ) {
  var energy_data = new google.visualization.DataTable( );
  energy_data.addColumn( 'date', 'Date' );
  energy_data.addColumn( 'number', 'Electricity used' );
  energy_data.addColumn( 'string', 'title1' );
  energy_data.addColumn( 'string', 'text1' );
  if (!Array.prototype.map) {
    Array.prototype.map = function(callback, thisArg) {
      var T, A, k;
      if (this == null) {
        throw new TypeError(" this is null or not defined");
      }
      var O = Object(this);
      var len = O.length >>> 0;
      if (typeof callback !== "function") {
        throw new TypeError(callback + " is not a function");
      }
      if (thisArg) {
        T = thisArg;
      }
      A = new Array(len);
      k = 0;
      while(k < len) {
        var kValue, mappedValue;
        if (k in O) {
          kValue = O[ k ];
          mappedValue = callback.call(T, kValue, k, O);
          A[ k ] = mappedValue;
        }
        k++;
      }
      return A;
    };      
  }
  var raw_data = <?php
    echo file_get_contents( '/home/pi/lightwaverf-summary.json' );
  ?>;
  energy_data.addRows( raw_data.map( function ( e ) {
    var d = '' + e[0];
    e[0] = new Date( '20' + d[0] + d[1] + '-' + d[2] + d[3] + '-' + d[4] + d[5] + ' ' + d[6] + d[7] + ':' + d[8] + d[9] );
    e[1] = e[1] * 10;
    e[2] = e[2] || '';
    e[3] = e[3] || '';
    return e;
  } ));
  var chart = new google.visualization.AnnotatedTimeLine( document.getElementById( 'energy_chart' ));
  chart.draw( energy_data, { displayAnnotations: true, title: '24 hours electricity usage' } );

  gauge = new google.visualization.Gauge( document.getElementById( 'gauge_div' ));
  gauge_data = google.visualization.arrayToDataTable( [ ["Label", "Value"], ["Electric", raw_data.pop[1] ], ["Pi Disk %", <?php echo $match[1]; ?>] ] );
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
$( function ( ) {
  $('dt a').click( function ( ) {
    $(this).parent( ).next('dd').slideDown( );
  } );
  $('a.ajax').click( function ( ) {
    $a = $(this);
    $.get( $a.attr('href'), function ( js ) {
      alert( $a.text( ));
    } );
    return false;
  } );
} );
</script>
</body>
</html>
