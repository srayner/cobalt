-- Ticket status table
CREATE TABLE ticket_status (
  id          integer     not null AUTO_INCREMENT,
  name        varchar(64) not null,
  description text            null,
  color       varchar(16) not null,
  primary key(id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

-- Ticket type table
CREATE TABLE ticket_type (
  id          integer     not null AUTO_INCREMENT,
  name        varchar(64) not null,
  description text            null,
  primary key(id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
insert into ticket_type (name, description) values ('Data request', 'A request from a user for data.');
insert into ticket_type (name, description) values ('Incident', 'Something that needs to be resolved immediately.');
insert into ticket_type (name, description) values ('Problem', 'A problem that if left unresolved may result in a incident.');

-- Ticket category table
CREATE TABLE ticket_category (
  id          integer     not null AUTO_INCREMENT,
  name        varchar(64) not null,
  description text            null,
  primary key(id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

-- Ticket priority table
CREATE TABLE ticket_priority (
  id          integer     not null AUTO_INCREMENT,
  name        varchar(64) not null,
  description text            null,
  color       varchar(16) not null,
  primary key(id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

-- Ticket impact table
CREATE TABLE ticket_impact (
  id          integer     not null AUTO_INCREMENT,
  name        varchar(64) not null,
  description text            null,
  color       varchar(16) not null,
  primary key(id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

-- Ticket table
CREATE TABLE ticket (
  id             integer      not null AUTO_INCREMENT,
  raised         datetime     not null,
  raised_by_id   integer      not null,
  subject        varchar(256) not null,
  status_id      integer      not null,
  type_id        integer      not null,
  category_id    integer      not null,
  priority_id    integer      not null,
  impact_id      integer      not null,
  requestor_id   integer      not null,
  technician_id  integer      not null,
  problem        text             null,
  solution       text             null,
  hardware_id    integer          null,
  software_id    integer          null,
  response_due   datetime     not null,
  resolution_due datetime     not null,
  external_ref   varchar(64)      null,
  INDEX idx_ticket_raised_by_id (raised_by_id),
  INDEX idx_ticket_status_id (status_id),
  INDEX idx_ticket_type_id (type_id),
  INDEX idx_ticket_category_id (category_id),
  INDEX idx_ticket_priority_id (priority_id),
  INDEX idx_ticket_impact_id (impact_id),
  INDEX idx_ticket_requestor_id (requestor_id),
  INDEX idx_ticket_technician_id (technician_id),
  FOREIGN KEY (raised_by_id)  REFERENCES user(id)       ON DELETE RESTRICT,
  FOREIGN KEY (status_id)     REFERENCES ticket_status(id)   ON DELETE RESTRICT,
  FOREIGN KEY (type_id)       REFERENCES ticket_type(id)     ON DELETE RESTRICT,
  FOREIGN KEY (category_id)   REFERENCES ticket_category(id) ON DELETE RESTRICT,
  FOREIGN KEY (priority_id)   REFERENCES ticket_priority(id) ON DELETE RESTRICT,
  FOREIGN KEY (impact_id)     REFERENCES ticket_impact(id)   ON DELETE RESTRICT,
  FOREIGN KEY (requestor_id)  REFERENCES user(id)            ON DELETE RESTRICT,
  FOREIGN KEY (technician_id) REFERENCES user(id)            ON DELETE RESTRICT,
  primary key(id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

delimiter //

create trigger ticket_insert after insert on ticket
for each row
begin
  insert into history (table_id, row_id, date_time, what)
  values (600, new.id, now(), 'Support ticket created.');
end//

create trigger ticket_update after update on ticket
for each row
begin
  insert into history (table_id, row_id, date_time, what)
  values (600, new.id, now(), 'Support ticket modified.');
end//

delimiter ;