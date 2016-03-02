Cobalt Application
==================

Work in progress. Cobalt is an ICT asset management and project management system.
It can connect to Active Directory via an LDAP connector to extract user and computer information.

Currently it can manage; users, computers and projects and domains.

Users
-----
You can add, edit, search for, view and delete users. You can also update user information
from Microsoft Active Directory.

Computers
---------
You can add, edit, search view and delete computers. Various properties including
operating system and logical disk information can be extracted from computers using WMI.
You can get remote access to computers via remote desktop or VNC. There is also easy
access to C$ share for browsing the hard drive of the remote computer.

Projects
--------
Projects can have associated milestones and milestones can have associated tasks.
[See the Cobalt website](http://srayner.github.io/cobalt)

Domains
-------
Domain names can be added, and then information can be extracted from the WhoIs database
for DNS records.

It is planned to add capabilities to manage all sorts of ICT assets, such as; servers, workstations,
tablets, mobile phones, printers and photo-copiers.

It is also planned that users will have associated departments, offices and companies. Including
management hierarchy structure.

Further possibilities include;
* Helpdesk module
* Change management module
* Problems, solutions & FAQ
*  Hardware and service monitoring 


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

