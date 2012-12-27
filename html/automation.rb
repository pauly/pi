#!/usr/bin/ruby

require 'socket'
require 'yaml'
require 'pp'

host = '192.168.0.14' # wifi link ip, still to be moved to config
sender = 533 # not sure how or why
port = 9760 # wifi link port

config = { 'room' => { }}
r = 1
YAML.load_file( 'config.yml' ).each do | room, devices |
  # p r.to_s + ': ' + room + ' has ' + devices.length.to_s + ' devices'
  config['room'][room] = {
    'id' => 'R' + r.to_s,
    'device' => { }
  }
  d = 1
  devices.each do | device |
    config['room'][room]['device'][device] = 'D' + d.to_s
    d = d + 1
  end
  r = r + 1
end
case ARGV.length
  when 3
    room = ARGV[0]
    device = ARGV[1]
    state = ARGV[2]
  when 2
    room = ARGV[0]
    device = ARGV[1]
    state = 'on'
  else
    p "usage: #{__FILE__} lounge light on"
    exit
end
case device
  when 'lights'
    device = 'D2'
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
# p 'room is ' + room
# p 'config[room] is ' + config['room'].to_s
# p 'so config[room][' + room + '] is ' + config['room'][room].to_s
# p 'so config[room][' + room + '][id] is ' + config['room'][room]['id']
socket.send sender.to_s + ",!" + config['room'][room]['id'] + device + "F" + state.to_s + "|", 0, host, port
p "sent " + state.to_s + " to " + room + device + "@" + host.to_s + ":" + port.to_s
