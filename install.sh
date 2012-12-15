sudo dpkg-reconfigure tzdata
sudo apt-get update
sudo apt-get upgrade
# sudo aptitude install linux-headers-2.6-$(uname -r|sed 's,[^-]*-[^-]*-,,') ndiswrapper-utils-1.9 wireless-tools
sudo apt-get install git-core
sudo passwd pi
sudo apt-get install apache2 php5 libapache2-mod-php5
sudo service apache2 restart
cd /var/www
wget http://www.raspberrypi.org/favicon.ico
