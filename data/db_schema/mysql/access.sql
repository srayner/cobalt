
-- Access rules (CivUser).
insert into access_rule(role, resource, privilege) values ('guest', 'CivUser\\Controller\\User', 'login');
insert into access_rule(role, resource, privilege) values ('user', 'CivUser\\Controller\\User', 'logout');
insert into access_rule(role, resource, privilege) values ('user', 'CivUser\\Controller\\User', 'profile');
insert into access_rule(role, resource, privilege) values ('user', 'CivUser\\Controller\\User', 'changepassword');

-- Access rules (Cobalt).
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Index', 'index');
insert into access_rule(role, resource, privilege) values ('admin', 'Application\\Controller\\Index', 'admin');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Ticket', 'index');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Ticket', 'index');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Ticket', 'add');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Ticket', 'edit');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Ticket', 'delete');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Ticket', 'detail');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Company', 'index');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Company', 'add');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Company', 'edit');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Company', 'delete');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Company', 'detail');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\User', 'index');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\User', 'add');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\User', 'edit');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\User', 'delete');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\User', 'detail');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\User', 'addrole');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Computer', 'index');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Computer', 'add');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Computer', 'edit');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Computer', 'delete');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Computer', 'detail');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Printer', 'index');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Printer', 'add');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Printer', 'edit');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Printer', 'delete');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Printer', 'detail');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Hardware', 'index');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Hardware', 'add');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Hardware', 'edit');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Hardware', 'delete');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Hardware', 'detail');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Software', 'index');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Software', 'add');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Software', 'edit');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Software', 'delete');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Software', 'detail');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Domain', 'index');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Domain', 'add');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Domain', 'edit');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Domain', 'delete');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Domain', 'detail');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Domain', 'refresh');

insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Hardwaretype', 'index');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Hardwaretype', 'add');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Hardwaretype', 'edit');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Hardwaretype', 'delete');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Hardwaretype', 'detail');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Hardwarestatus', 'index');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Hardwarestatus', 'add');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Hardwarestatus', 'edit');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Hardwarestatus', 'delete');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Hardwarestatus', 'detail');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Hardwaremanufacturer', 'index');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Hardwaremanufacturer', 'add');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Hardwaremanufacturer', 'edit');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Hardwaremanufacturer', 'delete');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Hardwaremanufacturer', 'detail');

-- Access rules (Notification)
insert into access_rule(role, resource, privilege) values ('admin', 'Notification\\Controller\\Index', 'index');
insert into access_rule(role, resource, privilege) values ('admin', 'Notification\\Controller\\Index', 'template');
insert into access_rule(role, resource, privilege) values ('admin', 'Notification\\Controller\\Index', 'enable');

-- Access rules (FAQ)
insert into access_rule(role, resource, privilege) values ('user', 'FAQ\\Controller\\Index', 'index');
insert into access_rule(role, resource, privilege) values ('admin', 'FAQ\\Controller\\Index', 'add');
insert into access_rule(role, resource, privilege) values ('admin', 'FAQ\\Controller\\Index', 'edit');
insert into access_rule(role, resource, privilege) values ('admin', 'FAQ\\Controller\\Index', 'delete');