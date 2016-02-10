Cobalt Application
==================

Work in progress. Cobalt is an ICT asset management and project management system.
It can connect to Active Directory via an LDAP connector to extract user and computer information.

Currently it can manage; users, computers and projects. Projects can have associated milestones and
milestones can have associated tasks.

It is planned to add capabilities to manage all sorts of ICT assets, such as; servers, workstations,
tablets, mobile phones, printers and photo-copiers.

It is also planned that users will have associated departments, offices and companies. Including
management hierarchy structure.

Further possibilities include;
  Helpdesk module
  Change management module
  Problems, solutions & FAQ
  Hardware and service monitoring 


Installation
------------

Note this application requires that you have the ldap php extension installed.

```
mkdir cobalt
cd cobalt
git clone https://github.com/srayner/platinum.git .
php composer.phar install
```

Post install tasks
------------------

1. Create a database called cobalt, and execute the SQL script located in the \data\db_schema
folder to create the database table structure.

2. Rename the \config\autoload\local.php.dist to remove the .dist extension. Then
modify the configuration at the top of this file to suit your local installation.

