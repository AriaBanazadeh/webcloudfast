sudo su
sudo dnf update -y
sudo dnf install -y httpd wget php-fpm php-mysqli php-json php php-devel
sudo dnf install mariadb105-server
sudo systemctl start httpd
sudo systemctl enable httpd
sudo usermod -a -G apache ec2-user


git clone https://github.com/AriaBanazadeh/webcloudfast.git 
cp ./webcloudfast/* /var/www/html/

cd /var/www/html
curl -sS https://getcomposer.org/installer | php
php composer.phar require aws/aws-sdk-php

sudo systemctl restart httpd
