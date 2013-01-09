export EDITOR=vi
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
cd
git clone https://github.com/pauly/lightwaverf.git
sudo gem install lightwaverf
wget http://nodejs.org/dist/v0.8.11/node-v0.8.11.tar.gz
tar -zxf node-v0.8.11.tar.gz
cd node-v0.8.11
./configure
nohup make &
cd /var
sudo git clone https://github.com/pauly/pi.git
sudo mv pi/ www
sudo apt-get install nginx
cd www
sudo groupadd www-data
sudo chown pi:www-data . -R
sudo usermod -a -G pi www-data
sudo cp default /etc/nginx/sites-enabled/default 
crontab cron.tab
sudo service nginx start
sudo apt-get install nginx php5-fpm php5-cgi php5-cli php5-common ruby
