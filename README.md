## Hello World

![SmceFramework Hello World](http://i57.tinypic.com/28kt5xw.jpg)

## Composer
https://packagist.org/packages/smce/framework

## Features

- MVC
- PSR
- Autoload
- Session Management
- Assets Manager
- Temp Manager
- Validation
- Masterpage/Layout
- Template Engine
- GRUD
- Smce Command Line
- ORM ActiveRecord(MySQL, SQLite, PostgreSQL, Oracle)
- Using ActiveRecord on Multiple Databases
- Accses Control Lists (ACL)
- Debug
- Logger
- Router
- Use SSH to Connect to a Remote Server (SSH,FTP)
- Using multiple ssh and ftp over SSH
- Exception Class
- Zip Encoding Class
- User Agent Class
- Pagination Class
- Output Class
- MemCache Class
- Redis Class
- Migration Class
- Helper Class - Enriched With Anonymous Closure Functions
- Http Exceptions Capture (404, 403 .. vs Page)
- Widgets

# Installation

####  Ubuntu

$ sudo apt-get install php5-dev  gcc make


####  Suse
sudo yast -i gcc make php5-devel


####  CentOS/RedHat/Fedora
sudo yum install php-devel gcc make


-------------

$ cd build

$ phpize && sudo ./configure --enable-smceframework && make && sudo make install && service apache2 restart


# Examples

### Smce Console help

php smce --help |
--- |


## Smce Console Grud


### New Model

php smce --grud model connectingstring table_name |
--- |




## Gelistirici Hakkinda
Samed Ceylan
