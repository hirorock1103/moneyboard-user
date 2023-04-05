FROM centos:centos7

# update yum
RUN yum -y update
RUN yum -y install yum-utils
RUN yum clean all

# nodejs npm
RUN yum install -y epel-release
RUN yum install -y nodejs npm

# httpd, vim, firewalld
RUN yum -y install httpd 
# RUN yum -y install vim 
RUN yum -y install firewalld 
RUN yum -y install epel-release

# RUN yum -y groupinstall "Development Tools"
RUN yum -y install wget git vim curl
RUN yum -y install crontabs zip unzip

# install remi repo
RUN wget http://rpms.famillecollet.com/enterprise/remi-release-7.rpm
RUN rpm -Uvh remi-release-7*.rpm
RUN yum-config-manager --enable remi-php74

# install php7
RUN \
    yum -y install \
    php php-common \
    php-mbstring \
    php-mcrypt \
    php-devel \
    php-xml \
    php-gd \
    php-soap \
    php-mysqlnd \
    php-pdo \
    php-opcache --nogpgcheck \
    php-bcmath
WORKDIR /var/www/html

# install composer
RUN curl -sS https://getcomposer.org/installer | php && \
mv composer.phar /usr/local/bin/composer

# timezone setting
RUN cp /etc/localtime /etc/localtime.org
RUN ln -sf /usr/share/zoneinfo/Asia/Tokyo /etc/localtime

CMD ["/usr/sbin/httpd", "-D", "FOREGROUND"]