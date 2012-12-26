#!/usr/bin/ruby

host = '192.168.0.14' # wifi link ip
sender = 533 # not sure how or why
port = 9760 # wifi link port
require 'socket'
case ARGV.length
  when 3
    room = ARGV[0]
    device = ARGV[1]
    state = ARGV[2]
  when 2
    room = ARGV[0]
    device = ARGV[1]
    state = 0
  else
    p "usage: #{__FILE__} lounge light on"
    exit
end
case room
  when 'lounge'
    room = 'R1'
  else
    room = 'R1'
end
case device
  when 'light'
    device = 'D1'
  else
    device = 'D1'
end
case state
  when 'off'
    state = 0
  when 'on'
    state = 1
end
socket = UDPSocket.new
socket.connect host, port
socket.send sender.to_s + ",!" + room + device + "F" + state.to_s + "|", 0, "192.168.0.14", 9760
p "sent " + state.to_s + " to " + room + device + "@" + host.to_s + ":" + port.to_s
