#!/usr/bin/ruby
require 'socket'
require 'yaml'
config = YAML.load_file 'config.yml'
rooms = { }
r = 1
config['room'].each do | name, devices |
  rooms[name] = {
    'id' => 'R' + r.to_s,
    'device' => { }
  }
  d = 1
  devices.each do | device |
    rooms[name]['device'][device] = 'D' + d.to_s
    d += 1
  end
  r += 1
end
room = rooms[ARGV[0]]
device = ARGV[1]
state = ARGV[2] || 'on'
room && device && state && room['device'][device] || abort( "usage: #{__FILE__} [" + rooms.keys.join( "|" ) + "] light on" )
case state
  when 'off'
    state = 'F0'
  when 'on'
    state = 'F1'
  when 'setup'
    state = 'F1'
  when 1..99 
    # @todo dimming etc
end
UDPSocket.new.send "666,!" + room['id'] + room['device'][device] + state + "|", 0, config['host'], 9760
