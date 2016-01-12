Cobalt Application
==================

Work in progress. Cobalt is an ICT asset management system.

Installation
------------

Note this application requires that you have the ldap php extension installed.

mkdir cobalt
cd cobalt
git clone https://github.com/srayner/platinum.git .
php composer.phar install

Post install tasks
------------------

1. Create a database called cobalt, and execute the SQL script located in the \data\db_schema
folder to create the database table structure.

2. Rename the \config\autoload\local.php.dist to remove the .dist extension. Then
modify the configuration at the top of this file to suit your local installation.

