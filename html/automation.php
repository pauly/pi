<?php

/**
 * My first go at computer home automation, now superceded.
 * 
 * Turn the lights on like this
 * http://192.168.0.11/automation.php?room=2&device=1&state=on
 * 
 * learned from http://blog.networkedsolutions.co.uk/?p=149
 * 
 * @author PC <paulypopex+pi@gmail.com>
 * @date Wed Dec 26 07:41:15 GMT 2012
 */

$obj = new stdClass;
$obj->{'host'} = '192.168.0.14'; // ip address of your wifi link http://amzn.to/V7yPPK

switch ( $_GET['room'] ) { // room aliases
  default:
    $_GET['room'] = 'R2';
}

switch ( $_GET['device'] ) { // device aliases
  default:
    $_GET['device'] = 'D1';
}

switch ( $_GET['state'] ) {
  case 'on':
    $_GET['state'] = 'F1';
    break;
  case 'off':
    $_GET['state'] = 'F0';
    break;
  default:
    $_GET['state'] = 'FdP' . ceil( $_GET['state'] * 0.32 );
}

$sock = socket_create( AF_INET, SOCK_DGRAM, SOL_UDP );
$obj->{'broadcast_string'} = '666,!' . $_GET['room'] . $_GET['device'] . $_GET['state'] . '|';
$obj->usage = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'] . "?room=2&device=1&state=on";
socket_set_option( $sock, SOL_SOCKET, SO_BROADCAST, 1 );
socket_sendto( $sock, $obj->{'broadcast_string'}, strlen( $obj->{'broadcast_string'} ), 0, $obj->{'host'}, 9670 );
socket_close( $sock );

echo json_encode( $obj );

?>
