[![Build Status](https://travis-ci.org/srayner/cobalt.svg?branch=master)](https://travis-ci.org/srayner/cobalt)
[![Coverage Status](https://coveralls.io/repos/github/srayner/cobalt/badge.svg?branch=master)](https://coveralls.io/github/srayner/cobalt?branch=master)

Cobalt Application
==================

Cobalt is a complete ICT solution for asset management, project management and support help desk.
It can connect to Active Directory via an LDAP connector to extract user and computer information.

Currently it can manage; users, hardware, software, projects, domains and support tickets.
There is also an FAQ section.

Installation
------------

Note this application requires that you have the ldap php extension installed.

```
mkdir cobalt
cd cobalt
git clone https://github.com/srayner/cobalt.git .
php composer.phar install
```

Post install tasks
------------------

1. Create a database called cobalt, and execute the SQL script located in the \data\db_schema
folder to create the database table structure.

2. Rename the \config\autoload\local.php.dist to remove the .dist extension. Then
modify the configuration at the top of this file to suit your local installation.


Dashboard
---------
The dashboard gives an overview of the system. It shows the total number of important system entities as
well as the current state of monitored network interfaces.

![Image of Dashboard](/docs/Screenshot2.jpg)

Users
-----
You can add, edit, search for, view and delete users. You can also import/update user information
from Microsoft Active Directory.

Hardware
---------
You can add, edit, search, view and delete hardware. There are two specialised types of hardware;
  * Computers
  * Printers

Computers have various additional properties including operating system and logical
disk information can be extracted from computers using WMI. You can get remote access
to computers via remote desktop or VNC. There is also easy access to the computer's
C$ share for browsing the hard drive of the remote computer.

Printers have additional properties such as print speed, print quality, etc. Printers can
also have associated consumables. Consumables have peroperties such as; type, supplier and quantity
in stock.

Software
--------
Software has a manufacturer, a type and a category. Software can have associated licenses,
as well as associated installations.
   
Projects
--------
Projects can have associated milestones and milestones can have associated tasks.
[See the Cobalt website](http://srayner.github.io/cobalt)

![Image of Project](/docs/Screenshot.jpg)

Domains
-------
Domain names can be added, and then information can be extracted from the WhoIs database
for DNS records.

![Image of Project](/docs/Domains_Screenshot.jpg)

FAQs
----
There is a simple FAQ section.

Development Roadmap
-------------------
The help desk module, hardware monitoring and notifications are all currently work in progress.

Further possibilities include;
* Change management module
* Detailed problems & solutions.
* Service monitoring 