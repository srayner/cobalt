-- Role table.
create table access_role (
    role_id   integer(11)  not null auto_increment,
    role      nvarchar(64) not null collate utf8_general_ci,
    parent    nvarchar(64)     null collate utf8_general_ci,
    role_type nvarchar(32) not null collate utf8_general_ci,
    primary key (
        role_id
    )
) ENGINE=InnoDB;

-- Inbuilt default roles (do not delete).
insert into access_role (role, parent, role_type) values ('guest', null, 'Built in role.');
insert into access_role (role, parent, role_type) values ('user', 'guest', 'Built in role.');
insert into access_role (role, parent, role_type) values ('admin', 'user', 'Built in role.');

-- Resources table.
create table access_resource (
    resource_id    integer(11)   not null auto_increment,
    resource       nvarchar(128) not null collate utf8_general_ci,
    display_name   nvarchar(64)  not null collate utf8_general_ci,
    primary key (
        resource_id
    )
) ENGINE=InnoDB;

-- Resources.
insert into access_resource (resource_id, resource, display_name) values (1, 'CivAccess\\Controller\\Index', 'Access Index');
insert into access_resource (resource_id, resource, display_name) values (2, 'CivAccess\\Controller\\Role', 'Roles');
insert into access_resource (resource_id, resource, display_name) values (3, 'CivAccess\\Controller\\Rule', 'Rules');
insert into access_resource (resource_id, resource, display_name) values (4, 'CivAccess\\Controller\\Resource', 'Resources');
insert into access_resource (resource_id, resource, display_name) values (5, 'CivAccess\\Controller\\Privilege', 'Privileges');

-- Privileges table.
create table access_privilege (
    privilege_id   integer(11)  not null auto_increment,
    resource_id    integer(11) not null,
    privilege      nvarchar(64) not null collate utf8_general_ci,
    display_name   nvarchar(64) not null collate utf8_general_ci,
    primary key (
        privilege_id
    )
) ENGINE=InnoDB;

-- Privileges.
insert into access_privilege (resource_id, privilege, display_name) values (1, 'index', 'Browse');
insert into access_privilege (resource_id, privilege, display_name) values (2, 'index', 'Browse');
insert into access_privilege (resource_id, privilege, display_name) values (2, 'add', 'Add');
insert into access_privilege (resource_id, privilege, display_name) values (2, 'edit', 'Edit');
insert into access_privilege (resource_id, privilege, display_name) values (2, 'delete', 'Delete');
insert into access_privilege (resource_id, privilege, display_name) values (3, 'index', 'Browse');
insert into access_privilege (resource_id, privilege, display_name) values (3, 'add', 'Add');
insert into access_privilege (resource_id, privilege, display_name) values (3, 'edit', 'Edit');
insert into access_privilege (resource_id, privilege, display_name) values (3, 'delete', 'Delete');
insert into access_privilege (resource_id, privilege, display_name) values (4, 'index', 'Browse');
insert into access_privilege (resource_id, privilege, display_name) values (4, 'add', 'Add');
insert into access_privilege (resource_id, privilege, display_name) values (4, 'edit', 'Edit');
insert into access_privilege (resource_id, privilege, display_name) values (4, 'delete', 'Delete');
insert into access_privilege (resource_id, privilege, display_name) values (5, 'index', 'Browse');
insert into access_privilege (resource_id, privilege, display_name) values (5, 'add', 'Add');
insert into access_privilege (resource_id, privilege, display_name) values (5, 'edit', 'Edit');
insert into access_privilege (resource_id, privilege, display_name) values (5, 'delete', 'Delete');

-- Rule table.
create table access_rule (
    rule_id    integer(11) not null auto_increment,
    role       nvarchar(64)  not null collate utf8_general_ci,
    resource   nvarchar(128)     null collate utf8_general_ci,
    privilege nvarchar(64)      null collate utf8_general_ci, 
    primary key (
        rule_id
    )
) ENGINE=InnoDB;

-- Some useful rules.
insert into access_rule (role, resource, privilege) values ('guest', 'Application\\Controller\\Index', 'index');
insert into access_rule (role, resource, privilege) values ('admin', 'CivAccess\\Controller\\Rule', 'index');
insert into access_rule (role, resource, privilege) values ('admin', 'CivAccess\\Controller\\Rule', 'add');
insert into access_rule (role, resource, privilege) values ('admin', 'CivAccess\\Controller\\Rule', 'edit');
insert into access_rule (role, resource, privilege) values ('admin', 'CivAccess\\Controller\\Rule', 'delete');
insert into access_rule (role, resource, privilege) values ('admin', 'CivAccess\\Controller\\Role', 'index');
insert into access_rule (role, resource, privilege) values ('admin', 'CivAccess\\Controller\\Role', 'add');
insert into access_rule (role, resource, privilege) values ('admin', 'CivAccess\\Controller\\Role', 'edit');
insert into access_rule (role, resource, privilege) values ('admin', 'CivAccess\\Controller\\Role', 'delete');
insert into access_rule (role, resource, privilege) values ('admin', 'CivAccess\\Controller\\Resource', 'index');
insert into access_rule (role, resource, privilege) values ('admin', 'CivAccess\\Controller\\Resource', 'add');
insert into access_rule (role, resource, privilege) values ('admin', 'CivAccess\\Controller\\Resource', 'edit');
insert into access_rule (role, resource, privilege) values ('admin', 'CivAccess\\Controller\\Resource', 'delete');
insert into access_rule (role, resource, privilege) values ('admin', 'CivAccess\\Controller\\Privilege', 'index');
insert into access_rule (role, resource, privilege) values ('admin', 'CivAccess\\Controller\\Privilege', 'add');
insert into access_rule (role, resource, privilege) values ('admin', 'CivAccess\\Controller\\Privilege', 'edit');
insert into access_rule (role, resource, privilege) values ('admin', 'CivAccess\\Controller\\Privilege', 'delete');

-- Create initial admin user
insert into user(id, username, domain , password) values(1, 'admin', 'local', '$2y$10$dyXDkRD7JbsgYi14s8JuouZ56U6XLS8IAFaozi8ACL9vdWSM2xgrC');  
insert into access_role(role, parent, role_type) values(1, 'admin', 'User role.');

-- Access rules (CivUser).
insert into access_rule(role, resource, privilege) values ('guest', 'CivUser\\Controller\\User', 'login');
insert into access_rule(role, resource, privilege) values ('user', 'CivUser\\Controller\\User', 'logout');
insert into access_rule(role, resource, privilege) values ('user', 'CivUser\\Controller\\User', 'profile');
insert into access_rule(role, resource, privilege) values ('user', 'CivUser\\Controller\\User', 'changepassword');

-- Access rules (Cobalt).
insert into access_rule(role, resource, privilege) values ('admin', 'Application\\Controller\\Index', 'admin');
insert into access_rule(role, resource, privilege) values ('admin', 'Application\\Controller\\Index', 'dbconfig');
insert into access_rule(role, resource, privilege) values ('admin', 'Application\\Controller\\Index', 'adconfig');
insert into access_rule(role, resource, privilege) values ('admin', 'Application\\Controller\\Index', 'mailinconfig');
insert into access_rule(role, resource, privilege) values ('admin', 'Application\\Controller\\Index', 'mailoutconfig');
insert into access_rule(role, resource, privilege) values ('admin', 'Application\\Controller\\Index', 'help');

insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Index', 'index');
insert into access_rule(role, resource, privilege) values ('guest', 'Cobalt\\Controller\\Index', 'monitor');


insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Ticket', 'index');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Ticket', 'add');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Ticket', 'edit');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Ticket', 'delete');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Ticket', 'detail');

insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\TicketStatus', 'index');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\TicketStatus', 'add');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\TicketStatus', 'edit');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\TicketStatus', 'delete');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\TicketStatus', 'detail');

insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\TicketType', 'index');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\TicketType', 'add');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\TicketType', 'edit');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\TicketType', 'delete');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\TicketType', 'detail');

insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\TicketCategory', 'index');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\TicketCategory', 'add');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\TicketCategory', 'edit');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\TicketCategory', 'delete');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\TicketCategory', 'detail');

insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\TicketPriority', 'index');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\TicketPriority', 'add');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\TicketPriority', 'edit');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\TicketPriority', 'delete');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\TicketPriority', 'detail');

insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\TicketImpact', 'index');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\TicketImpact', 'add');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\TicketImpact', 'edit');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\TicketImpact', 'delete');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\TicketImpact', 'detail');

insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Company', 'index');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Company', 'add');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Company', 'edit');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Company', 'delete');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Company', 'detail');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Company', 'offices');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Company', 'departments');

insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Office', 'index');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Office', 'add');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Office', 'edit');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Office', 'delete');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Office', 'detail');

insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Department', 'index');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Department', 'add');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Department', 'edit');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Department', 'delete');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Department', 'detail');

insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\User', 'index');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\User', 'add');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\User', 'edit');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\User', 'delete');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\User', 'detail');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\User', 'addrole');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\User', 'adupdate');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\User', 'find');

insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\User', 'addhardware');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\User', 'removehardware');

insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\User', 'removerole');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\User', 'technicians');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\User', 'relationships');

insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Computer', 'index');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Computer', 'add');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Computer', 'edit');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Computer', 'delete');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Computer', 'detail');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Computer', 'ping');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Computer', 'adupdate');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Computer', 'scan');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Computer', 'scandisks');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Computer', 'readevents');

insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Printer', 'index');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Printer', 'add');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Printer', 'edit');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Printer', 'delete');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Printer', 'detail');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Printer', 'addconsumable');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Printer', 'removeconsumable');

insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Consumable', 'index');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Consumable', 'add');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Consumable', 'edit');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Consumable', 'delete');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Consumable', 'detail');

insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Hardware', 'index');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Hardware', 'add');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Hardware', 'edit');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Hardware', 'delete');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Hardware', 'detail');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Hardware', 'summary');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Hardware', 'uploadimage');

insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\NetworkAdapter', 'add');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\NetworkAdapter', 'edit');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\NetworkAdapter', 'delete');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\NetworkAdapter', 'monitor');

insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Software', 'index');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Software', 'add');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Software', 'edit');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Software', 'delete');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Software', 'detail');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Software', 'summary');

insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\SoftwareLicense', 'add');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\SoftwareLicense', 'edit');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\SoftwareLicense', 'delete');

insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Domain', 'index');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Domain', 'add');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Domain', 'edit');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Domain', 'delete');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Domain', 'detail');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\Domain', 'refresh');

insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\HardwareType', 'index');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\HardwareType', 'add');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\HardwareType', 'edit');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\HardwareType', 'delete');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\HardwareType', 'detail');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\HardwareStatus', 'index');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\HardwareStatus', 'add');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\HardwareStatus', 'edit');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\HardwareStatus', 'delete');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\HardwareStatus', 'detail');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\HardwareManufacturer', 'index');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\HardwareManufacturer', 'add');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\HardwareManufacturer', 'edit');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\HardwareManufacturer', 'delete');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\HardwareManufacturer', 'detail');

insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\SoftwareType', 'index');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\SoftwareType', 'add');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\SoftwareType', 'edit');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\SoftwareType', 'delete');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\SoftwareType', 'detail');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\SoftwareCategory', 'index');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\SoftwareCategory', 'add');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\SoftwareCategory', 'edit');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\SoftwareCategory', 'delete');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\SoftwareCategory', 'detail');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\SoftwareManufacturer', 'index');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\SoftwareManufacturer', 'add');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\SoftwareManufacturer', 'edit');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\SoftwareManufacturer', 'delete');
insert into access_rule(role, resource, privilege) values ('admin', 'Cobalt\\Controller\\SoftwareManufacturer', 'detail');

-- Access rules (Project)
insert into access_rule(role, resource, privilege) values ('admin', 'Project\\Controller\\Project', 'index');
insert into access_rule(role, resource, privilege) values ('admin', 'Project\\Controller\\Project', 'add');
insert into access_rule(role, resource, privilege) values ('admin', 'Project\\Controller\\Project', 'edit');
insert into access_rule(role, resource, privilege) values ('admin', 'Project\\Controller\\Project', 'delete');
insert into access_rule(role, resource, privilege) values ('admin', 'Project\\Controller\\Project', 'detail');
insert into access_rule(role, resource, privilege) values ('admin', 'Project\\Controller\\Project', 'comment');
insert into access_rule(role, resource, privilege) values ('admin', 'Project\\Controller\\Project', 'task');
insert into access_rule(role, resource, privilege) values ('admin', 'Project\\Controller\\Milestone', 'index');
insert into access_rule(role, resource, privilege) values ('admin', 'Project\\Controller\\Milestone', 'add');
insert into access_rule(role, resource, privilege) values ('admin', 'Project\\Controller\\Milestone', 'edit');
insert into access_rule(role, resource, privilege) values ('admin', 'Project\\Controller\\Milestone', 'delete');
insert into access_rule(role, resource, privilege) values ('admin', 'Project\\Controller\\Milestone', 'detail');
insert into access_rule(role, resource, privilege) values ('admin', 'Project\\Controller\\Milestone', 'comment');
insert into access_rule(role, resource, privilege) values ('admin', 'Project\\Controller\\Task', 'index');
insert into access_rule(role, resource, privilege) values ('admin', 'Project\\Controller\\Task', 'add');
insert into access_rule(role, resource, privilege) values ('admin', 'Project\\Controller\\Task', 'edit');
insert into access_rule(role, resource, privilege) values ('admin', 'Project\\Controller\\Task', 'delete');
insert into access_rule(role, resource, privilege) values ('admin', 'Project\\Controller\\Task', 'detail');
insert into access_rule(role, resource, privilege) values ('admin', 'Project\\Controller\\Task', 'comment');
insert into access_rule(role, resource, privilege) values ('admin', 'Project\\Controller\\Comment', 'edit');
insert into access_rule(role, resource, privilege) values ('admin', 'Project\\Controller\\Comment', 'delete');

-- Access rules (Notification)
insert into access_rule(role, resource, privilege) values ('admin', 'Notification\\Controller\\Index', 'index');
insert into access_rule(role, resource, privilege) values ('admin', 'Notification\\Controller\\Index', 'template');
insert into access_rule(role, resource, privilege) values ('admin', 'Notification\\Controller\\Index', 'enable');

-- Access rules (FAQ)
insert into access_rule(role, resource, privilege) values ('user', 'FAQ\\Controller\\Index', 'index');
insert into access_rule(role, resource, privilege) values ('admin', 'FAQ\\Controller\\Index', 'add');
insert into access_rule(role, resource, privilege) values ('admin', 'FAQ\\Controller\\Index', 'edit');
insert into access_rule(role, resource, privilege) values ('admin', 'FAQ\\Controller\\Index', 'delete');