-- Template table
create table notification_template(
  id            Integer      NOT NULL AUTO_INCREMENT,
  active        boolean      NOT NULL,
  name          Varchar(64)  NOT NULL,
  description   VarChar(256) NOT NULL,
  mime_type     VarChar(32)  NOT NULL,
  subject       Varchar(256) NOT NULL,
  content       text             NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDb DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

create table notification_field(
  id Integer NOT NULL AUTO_INCREMENT,
  notification_template_id Integer NOT NULL,
  field_name               varchar(32) NOT NULL,
  field_display            varchar(32) NOT NULL,
  INDEX idx_notification_field_tmplt_id (notification_template_id),
  FOREIGN KEY (notification_template_id)  REFERENCES notification_template(id) ON DELETE CASCADE,
  PRIMARY KEY (id)
) ENGINE=InnoDb DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
  
insert into notification_template(id, active, name, description, mime_type, subject, content)
values(1, false, 'requestor_new_ticket', 'Notify requestor that a new support ticket has been raised.', 'text/html',
'Support ticket raised.',
'Dear {{ RequesterDisplayName }},

This is an acknowledgement that your support ticket has been logged with the following details;

Support Ticket Number: {{ TicketId }}.

Title: {{ TicketSubject }}
Status: {{ TicketStatus }}
Assigned Technician: {{ TechnicianDisplayName }} 
Expected Resolution Date: {{ TicketResolutionDue }} 


{{ TicketProblem }}

Please reply to this email if you have any further clarifications.


Regards,

The I.C.T. Department.');

insert into notification_template(id, active, name, description, mime_type, subject, content)
values(2, false, 'technician_new_ticket', 'Notify technician that a new support ticket has been raised.', 'text/html',
'Support ticket assigned to you.',
'Dear {{ TechnicianDisplayName }},

This is an acknowledgement that a support ticket has been assigned to you with the following details;

Support Ticket Number: {{ TicketId }}.

Title: {{ TicketSubject }}
Status: {{ TicketStatus }}
Assigned Technician: {{ TechnicianDisplayName }} 
Expected Resolution Date: {{ TicketResolutionDue }} 


{{ TicketProblem }}

Regards,

The I.C.T. Department.');

insert into notification_template(id, active, name, description, mime_type, subject, content)
values(3, false, 'requestor_new_ticket', 'Notify requestor that a new support ticket has been raised.', 'text/html',
'Support ticket raised.',
'Dear {{ RequesterDisplayName }},

This is an acknowledgement that your support ticket has been logged with the following details;

Support Ticket Number: {{ TicketId }}.

Title: {{ TicketSubject }}
Status: {{ TicketStatus }}
Assigned Technician: {{ TechnicianDisplayName }} 
Expected Resolution Date: {{ TicketResolutionDue }} 


{{ TicketProblem }}

Please reply to this email if you have any further clarifications.


Regards,

The I.C.T. Department.');

insert into notification_template(id, active, name, description, mime_type, subject, content)
values(4, false, 'hardware_status_change', 'Notify admin that monitored hardware status has changed.', 'text/html',
'Monitored hardware status changed',
'Dear {{ AdminDisplayName }},

This is a notification that monitored hardware status has changed;

Hardware Name: {{ HardwareName }}
Adapter Name: {{ AdapterName }}
IPv4 Address: {{ Ipv4Address }}
Status: {{ Status }}
Date & Time: {{ DateTime }}

Raised by Cobalt application.');

insert into notification_field(id, notification_template_id, field_name, field_display) values
(1, 1, '{{ RequesterDisplayName }}',  'Requester Name'),
(2, 1, '{{ TechnicianDisplayName }}', 'Technician Name'),
(3, 1, '{{ TicketId }}',              'Ticket Id'),
(4, 1, '{{ TicketSubject }}',         'Subject'),
(5, 1, '{{ TicketStatus }}',          'Status'),
(6, 1, '{{ TicketPriority }}',        'Priority'),
(7, 1, '{{ TicketProblem }}',         'Problem'),
(8, 1, '{{ TicketResolutionDue }}',   'Resolution Due');

insert into notification_field(id, notification_template_id, field_name, field_display) values
(9, 2, '{{ RequesterDisplayName }}',  'Requester Name'),
(10, 2, '{{ TechnicianDisplayName }}', 'Technician Name'),
(11, 2, '{{ TicketId }}',              'Ticket Id'),
(12, 2, '{{ TicketSubject }}',         'Subject'),
(13, 2, '{{ TicketStatus }}',          'Status'),
(14, 2, '{{ TicketPriority }}',        'Priority'),
(15, 2, '{{ TicketProblem }}',         'Problem'),
(16, 2, '{{ TicketResolutionDue }}',   'Resolution Due');

insert into notification_field(id, notification_template_id, field_name, field_display) values
(17, 3, '{{ HardwareName }}',  'Hardware Name'),
(18, 3, '{{ AdapterName }}', 'Adapter Name'),
(19, 3, '{{ Ipv4Address }}',              'IPv4 Address'),
(20, 3, '{{ Status }}',         'Status'),
(21, 3, '{{ DateTime }}',          'Date & Time');