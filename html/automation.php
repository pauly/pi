<?php

/**
 * Turn the lights on like this
 * http://192.168.0.11/automation.php?room=2&device=1&state=on
 * 
 * learned from http://blog.networkedsolutions.co.uk/?p=149
 * 
 * @author PC <paulypopex+pi@gmail.com>
 * @date Wed Dec 26 07:41:15 GMT 2012
 */

$obj = new stdClass;
switch ( $_GET['room'] ) {
  default:
    $_GET['room'] = 'R2';
}
switch ( $_GET['state'] ) {
  case 'on':
    $_GET['state'] = 'F1';
    break;
  case 'off':
    $_GET['state'] = 'F0';
    break;
  case '1':
    $_GET['state'] = 'FdP1';
    break;
  default:
    $_GET['state'] = 'FdP' . round( $_GET['state'] * 0.32 );
}

switch ( $_GET['device'] ) {
  default:
    $_GET['device'] = 'D1';
}

// $obj->{'_GET'} = $_GET;
$obj->{'host'} = '192.168.0.14';
$obj->{'port'} = 9760;
$sock = socket_create( AF_INET, SOCK_DGRAM, SOL_UDP );
$obj->{'socket'} = print_r( $sock, true );
$code = 533;
$obj->{'broadcast_string'} = sprintf( '%03d', $code ) . ',!' . $_GET['room'] . $_GET['device'] . $_GET['state'] . '|';
socket_set_option($sock, SOL_SOCKET, SO_BROADCAST, 1);
socket_sendto( $sock, $obj->{'broadcast_string'}, strlen( $obj->{'broadcast_string'} ), 0, $obj->{'host'}, $obj->{'port'} );
socket_close( $sock );

echo json_encode( $obj );

?>
