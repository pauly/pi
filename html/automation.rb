require 'socket'
u1 = UDPSocket.new
u1.bind("192.168.0.14", 9760)
u1.send "533,!R2D1F0|", 0, "192.168.0.14", 9760
