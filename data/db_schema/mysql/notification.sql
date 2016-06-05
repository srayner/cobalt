-- Template table
create table notification_template(
  id            Integer      NOT NULL AUTO_INCREMENT,
  name          Varchar(64)  NOT NULL,
  description   VarChar(256) NOT NULL,
  mime_type     VarChar(32)  NOT NULL,
  content       text             NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDb DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

insert into notification_template(id, name, description, mime_type, content)
values(1, 'requestor_new_ticket', 'Notify requestor that a new support ticket has been raised.', 'text/html',
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

insert into notification_template(id, name, description, mime_type, content)
values(2, 'technician_new_ticket', 'Notify technician that a new support ticket has been raised.', 'text/html',
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