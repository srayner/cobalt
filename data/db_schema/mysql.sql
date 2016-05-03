-- Comment Table
CREATE TABLE comment (
  id Integer NOT NULL AUTO_INCREMENT,
  comment Text,
  createdTime DateTime,
  PRIMARY KEY (
    id
  )
) ENGINE=InnoDB;

-- Activity Table
CREATE TABLE activity (
  activity_id   Integer(11)  NOT NULL AUTO_INCREMENT,
  activity_type NVarChar(32), 
  hostname      NVarChar(64) NOT NULL,
  username      NVarChar(64) NOT NULL,
  activity_time Timestamp    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (
      activity_id
  )
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

-- Company table
create table company(
  id       Integer     NOT NULL AUTO_INCREMENT,
  name     Varchar(64) NOT NULL,
  address  Text            NULL,
  phone    Varchar(24)     NULL,
  fax      Varchar(24)     NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDb DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

-- Office table
CREATE TABLE office (
  id         Integer     NOT NULL AUTO_INCREMENT,
  name       Varchar(64) NOT NULL,
  address    Text            NULL,
  phone      Varchar(24)     NULL,
  fax        Varchar(24)     NULL,
  company_id Integer     NOT NULL,
  INDEX idx_office_comapny_id (company_id),
  FOREIGN KEY (company_id)  REFERENCES office(id) ON DELETE CASCADE,
  PRIMARY KEY (id)
) ENGINE=InnoDb DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

-- Computer table
CREATE TABLE computer (
  computer_id     Integer(11)  NOT NULL AUTO_INCREMENT,
  hostname        NVarChar(64) NOT NULL,
  ipv4            NVarChar(15),
  description     NVarChar(128),
  service_tag     NVarChar(8),
  created         Timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  domain          NVarChar(128),
  manufacturer    NVarChar(128),
  model           NVarChar(128),
  image           NVarChar(128),
  serial_number   NVarChar(64),
  bios_version    NVarChar(32),
  system_type     NVarChar(32),
  modified        Timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  os_name         NVarChar(128),
  os_version      NVarChar(32),
  os_build        NVarChar(16),
  os_service_pack NVarChar(16), 
  PRIMARY KEY (
      computer_id
  )
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

-- Computer logical_disk
CREATE TABLE logical_disk (
  logical_disk_id Integer(11) NOT NULL AUTO_INCREMENT,
  computer_id     Integer(11) NOT NULL,
  device_id       NVarChar(32),
  description     NVarChar(128),
  file_system     NVarChar(128),
  capacity        BigInt(20),
  free_space      BigInt(11), 
  PRIMARY KEY (
      logical_disk_id
  )
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

-- Domain table
CREATE TABLE domain (
  id                 Integer(11) NOT NULL AUTO_INCREMENT,
  domain_name        NVarChar(256),
  description        NVarChar(128),
  status             NVarChar(128),
  created            Date,
  changed            Date,
  expires            Date,
  sponsor            NVarChar(128),
  referer            NVarChar(128),
  handle             NVarChar(128),
  source             NVarChar(128),
  dnssec             NVarChar(128),
  registrant         NVarChar(128),
  registrant_type    NVarChar(128),
  registrant_address Text,
  registrar          NVarChar(128),
  registrar_url      NVarChar(256),
  PRIMARY KEY (
    id
  )
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

-- Name servers
CREATE TABLE name_server (
  id Integer(11) NOT NULL AUTO_INCREMENT,
  hostname NVarchar(128),
  ipv4 NVarchar(15),
  PRIMARY KEY (
    id
  )
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

-- Domain name servers
CREATE TABLE domain_name_server (
  domain_id      Integer(11),
  name_server_id Integer(11),
  PRIMARY KEY (
    domain_id,
    name_server_id
  )
) ENGINE=InnoDb DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

-- Domain status
CREATE TABLE domain_status (
  id        Integer(11) NOT NULL AUTO_INCREMENT,
  domain_id Integer(11) NOT NULL,
  status    NVarchar(128),
  PRIMARY KEY (
    id
  )
) ENGINE = InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

-- User table
CREATE TABLE user (
  user_id Integer NOT NULL AUTO_INCREMENT,
  username            NVarChar(128),
  email               NVarChar(256),
  sam_account_name    NVarChar(128),
  user_principal_name NVarChar(128),
  telephone_number    NVarChar(32),
  mobile_number       NVarchar(32),
  extension_number    NVarChar(32),
  display_name        NVarChar(64),
  description         NVarChar(128),
  office              NVarChar(64),
  photo_filename      NVarChar(64),
  company             NVarChar(64),
  department          NVarChar(64),
  title               NVarChar(64),
  reports_to_id       Integer,
  bad_password_count  Integer,
  bad_password_time   DateTime
  PRIMARY KEY (user_id)
) ENGINE=InnoDb DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

-- Active Directory Group table.
CREATE TABLE ad_group (
  id              Integer(11) NOT NULL AUTO_INCREMENT,
  display_name    NVarChar(128) COLLATE utf8_general_ci NOT NULL,
  description     Text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  scope           NVarChar(12) COLLATE utf8_general_ci NOT NULL,
  group_type      NVarChar(12) COLLATE utf8_general_ci NOT NULL,
  sam_account_name NVarChar(20) NOT NULL,  
  PRIMARY KEY (
      id
  )
) ENGINE=InnoDB ROW_FORMAT=DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

-- User computer relationship table
CREATE TABLE user_computer (
  user_id     Integer NOT NULL,
  computer_id Integer NOT NULL, 
  PRIMARY KEY (
      user_id, 
      computer_id
  )
) ENGINE=InnoDB;

-- Project table
CREATE TABLE project (
  id                   Integer NOT NULL AUTO_INCREMENT,
  code                 NVarChar(32) COLLATE utf8_unicode_ci,
  name                 NVarChar(128) COLLATE utf8_unicode_ci NOT NULL,
  description          Text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  type_id              Integer,
  status_id            Integer NOT NULL,
  priority_id          Integer NOT NULL, 
  owner_id             Integer,
  scheduled_start      DateTime,
  scheduled_end        DateTime,
  actual_start         DateTime,
  actual_end           DateTime,
  projected_completion Date,
  estimated_hours      Decimal(18, 2),
  actual_hours         Decimal(18, 2),
  estimated_cost       Decimal(18, 2),
  actual_cost          Decimal(18, 2),
  created_time         Timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  milestone_count      Integer,
  milestone_completed  Integer,
  task_count           Integer,
  task_completed       Integer,
  PRIMARY KEY (
      id
  )
) ENGINE=InnoDB;

-- Project status table
CREATE TABLE project_status (
  id                     Integer NOT NULL AUTO_INCREMENT,
  status_name            NVarChar(32),
  status_description     NVarChar(128),
  colour                 NVarChar(12),
  PRIMARY KEY (id)
) ENGINE=InnoDb CHARACTER SET utf8 COLLATE utf8_general_ci;
insert into project_status (status_name, status_description, colour) values ('Open', 'Project is currently active and in progress.', 'blue');
insert into project_status (status_name, status_description, colour) values ('On hold', 'Project is currently on hold.', 'red');
insert into project_status (status_name, status_description, colour) values ('Cancelled', 'Project has been cancelled.', 'gray');
insert into project_status (status_name, status_description, colour) values ('Completed', 'Project has been completed.', 'gray');

-- Project priority table
CREATE TABLE project_priority (
  id                     Integer NOT NULL AUTO_INCREMENT,
  priority_name          NVarChar(32),
  priority_description   NVarChar(128),
  colour                 NVarChar(12),
  PRIMARY KEY (id)
) ENGINE=InnoDb CHARACTER SET utf8 COLLATE utf8_general_ci;
insert into project_priority (priority_name, priority_description, colour) values ('High', 'Project is a high priority.', 'red');
insert into project_priority (priority_name, priority_description, colour) values ('Medium', 'Project is a medium priority.', 'amber');
insert into project_priority (priority_name, priority_description, colour) values ('Low', 'Project is low low priority.', 'green');

-- Project Comment table
CREATE TABLE project_comment (
  project_id Integer,
  comment_id Integer,
  PRIMARY KEY (
    project_id,
    comment_id
  )
) ENGINE=InnoDB;

-- Milestone table
CREATE TABLE milestone (
  id                   Integer NOT NULL AUTO_INCREMENT,
  project_id           Integer NOT NULL,
  name                 NVarChar(128) COLLATE utf8_unicode_ci NOT NULL,
  description          Text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  status_id            Integer NOT NULL,
  priority_id          Integer NOT NULL, 
  owner_id             Integer,
  scheduled_start      DateTime,
  scheduled_end        DateTime,
  actual_start         DateTime,
  actual_end           DateTime,
  projected_completion Date,
  estimated_hours      Decimal(18, 2),
  actual_hours         Decimal(18, 2),
  estimated_cost       Decimal(18, 2),
  actual_cost          Decimal(18, 2),
  created_time         Timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  task_count           Integer,
  task_completed       Integer,
  PRIMARY KEY (
      id
  )
) ENGINE=InnoDB;

-- Milestone status table
CREATE TABLE milestone_status (
  id                     Integer NOT NULL AUTO_INCREMENT,
  status_name            NVarChar(32),
  status_description     NVarChar(128),
  colour                 NVarChar(12),
  PRIMARY KEY (id)
) ENGINE=InnoDb CHARACTER SET utf8 COLLATE utf8_general_ci;
insert into milestone_status (status_name, status_description, colour) values ('Open', 'Milestone is currently active and in progress.', 'blue');
insert into milestone_status (status_name, status_description, colour) values ('On hold', 'Milestone is currently on hold.', 'red');
insert into milestone_status (status_name, status_description, colour) values ('Cancelled', 'Milestone has been cancelled.', 'gray');
insert into milestone_status (status_name, status_description, colour) values ('Completed', 'Milestone has been completed.', 'gray');

-- Milestone priority table
CREATE TABLE milestone_priority (
  id                     Integer NOT NULL AUTO_INCREMENT,
  priority_name          NVarChar(32),
  priority_description   NVarChar(128),
  colour                 NVarChar(12),
  PRIMARY KEY (id)
) ENGINE=InnoDb CHARACTER SET utf8 COLLATE utf8_general_ci;
insert into milestone_priority (priority_name, priority_description, colour) values ('High', 'Milestone is a high priority.', 'red');
insert into milestone_priority (priority_name, priority_description, colour) values ('Medium', 'Milestone is a medium priority.', 'amber');
insert into milestone_priority (priority_name, priority_description, colour) values ('Low', 'Milestone is low low priority.', 'green');

-- Milestone Comment table
CREATE TABLE milestone_comment (
  milestone_id Integer,
  comment_id Integer,
  PRIMARY KEY (
    milestone_id,
    comment_id
  )
) ENGINE=InnoDB;

-- Task table
CREATE TABLE task (
  id                   Integer NOT NULL AUTO_INCREMENT,
  name                 NVarChar(128) COLLATE utf8_unicode_ci NOT NULL,
  description          Text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  type_id              Integer,  
  status_id            Integer NOT NULL,
  priority_id          Integer NOT NULL, 
  owner_id             Integer,
  scheduled_start      DateTime,
  scheduled_end        DateTime,
  actual_start         DateTime,
  actual_end           DateTime,
  projected_completion Date,
  estimated_hours      Decimal(18, 2),
  actual_hours         Decimal(18, 2),
  estimated_cost       Decimal(18, 2),
  actual_cost          Decimal(18, 2),
  created_time         Timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (
      id
  )
) ENGINE=InnoDB;

-- Task status table
CREATE TABLE task_status (
  id                     Integer NOT NULL AUTO_INCREMENT,
  status_name            NVarChar(32),
  status_description     NVarChar(128),
  colour                 NVarChar(12),
  PRIMARY KEY (id)
) ENGINE=InnoDb CHARACTER SET utf8 COLLATE utf8_general_ci;
insert into task_status (status_name, status_description, colour) values ('Open', 'Task is currently active and in progress.', 'blue');
insert into task_status (status_name, status_description, colour) values ('On hold', 'Task is currently on hold.', 'red');
insert into task_status (status_name, status_description, colour) values ('Cancelled', 'Task has been cancelled.', 'gray');
insert into task_status (status_name, status_description, colour) values ('Completed', 'Task has been completed.', 'gray');

-- Task priority table
CREATE TABLE task_priority (
  id                     Integer NOT NULL AUTO_INCREMENT,
  priority_name          NVarChar(32),
  priority_description   NVarChar(128),
  colour                 NVarChar(12),
  PRIMARY KEY (id)
) ENGINE=InnoDb CHARACTER SET utf8 COLLATE utf8_general_ci;
insert into task_priority (priority_name, priority_description, colour) values ('High', 'Task is a high priority.', 'red');
insert into task_priority (priority_name, priority_description, colour) values ('Medium', 'Task is a medium priority.', 'amber');
insert into task_priority (priority_name, priority_description, colour) values ('Low', 'Task is low low priority.', 'green');

-- Task Comment table
CREATE TABLE task_comment (
  task_id Integer,
  comment_id Integer,
  PRIMARY KEY (
    task_id,
    comment_id
  )
) ENGINE=InnoDB;

CREATE TABLE project_task (
  project_id Integer NOT NULL,
  task_id    Integer NOT NULL, 
  PRIMARY KEY (
      project_id, 
      task_id
  )
) ENGINE=InnoDB;

CREATE TABLE milestone_task (
  milestone_id Integer NOT NULL,
  task_id      Integer NOT NULL, 
  PRIMARY KEY (
      milestone_id, 
      task_id
  )
) ENGINE=InnoDB;

CREATE TABLE project_task (
  project_id Integer NOT NULL,
  task_id    Integer NOT NULL,
  PRIMARY KEY (
    project_id,
    task_id
  )
) ENGINE=InnoDB;

CREATE TABLE history (
    id        Integer      NOT NULL AUTO_INCREMENT,
    table_id  Integer      NOT NULL,
    row_id    Integer      NOT NULL,
    date_time Timestamp    NOT NULL,
    what      Varchar(120) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;

--  STORED PROCEDURES 

delimiter //
CREATE PROCEDURE project_recalc(proj_id Integer(11))
  NO SQL
begin

  declare m_count int;
  declare m_completed int;
  
  set m_count = (select count(id) from milestone where project_id = proj_id);
  set m_completed = (select count(id) from milestone where project_id = proj_id and status_id = 4);
  
  update
    project
  set
    milestone_count = m_count,
    milestone_completed = m_completed
  where
    id = proj_id; 
  
end

CREATE PROCEDURE project_recalc_tasks(proj_id Integer(11))
  NO SQL
begin

  declare t_count int;
  declare t_completed int;
  
  set t_count = (select count(*) from project_task where project_id = proj_id);
  set t_completed = (SELECT count(project_id) FROM project_task inner join task
                     on task.id = project_task.task_id WHERE project_id = proj_id and status_id = 4);
  
  update
    project
  set
    task_count = t_count,
    task_completed = t_completed
  where
    id = proj_id; 
  
end//

CREATE PROCEDURE milestone_recalc(mile_id Integer(11))
  NO SQL
begin

  declare t_count int;
  declare t_completed int;
  
  set t_count = (select count(*) from milestone_task where milestone_id = mile_id);
  set t_completed = (SELECT count(milestone_id) FROM milestone_task inner join task
                     on task.id = milestone_task.task_id WHERE milestone_id = mile_id and status_id = 4);
  
  update
    milestone
  set
    task_count = t_count,
    task_completed = t_completed
  where
    id = mile_id; 
  
end//
delimiter ;

-- TRIGGERS

delimiter //
CREATE TRIGGER milestone_insert
  AFTER INSERT
  ON milestone FOR EACH ROW
begin

 call project_recalc(new.project_id);
  
end//

CREATE TRIGGER milestone_update
  AFTER UPDATE
  ON milestone FOR EACH ROW
begin

  call project_recalc(new.project_id);
  call project_recalc(old.project_id);
  
end//

CREATE TRIGGER milestone_delete
  AFTER DELETE
  ON milestone FOR EACH ROW
begin

  call project_recalc(old.project_id);
   
end//

CREATE TRIGGER milestone_task_insert
  AFTER INSERT
  ON milestone_task FOR EACH ROW
begin

  call milestone_recalc(new.milestone_id);
   
end//

CREATE TRIGGER task_update AFTER UPDATE ON task FOR EACH ROW
begin
  DECLARE done INT DEFAULT FALSE;
  DECLARE mile_id integer;
  DECLARE proj_id integer;
  DECLARE mile_cur CURSOR FOR SELECT milestone_id FROM milestone_task WHERE task_id = new.id;
  DECLARE proj_cur CURSOR FOR SELECT project_id FROM project_task WHERE task_id = new.id;
  DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

  OPEN mile_cur;
  read_loop1: LOOP
    FETCH mile_cur INTO mile_id;
    IF done THEN
      LEAVE read_loop1;
    END IF;
    CALL milestone_recalc(mile_id);
  END LOOP;
  CLOSE mile_cur;
 
  SET done = FALSE;
  OPEN proj_cur;
  read_loop2: LOOP
    FETCH proj_cur INTO proj_id;
    IF done THEN
      LEAVE read_loop2;
    END IF;
    CALL project_recalc_tasks(proj_id);
  END LOOP;
  CLOSE proj_cur;

end//

CREATE TRIGGER milestone_task_delete
  AFTER DELETE
  ON milestone_task FOR EACH ROW
begin

  call milestone_recalc(old.milestone_id);
   
end//

CREATE TRIGGER project_task_insert
  AFTER INSERT
  ON project_task FOR EACH ROW
begin

  call project_recalc_tasks(new.project_id);
   
end//

CREATE TRIGGER project_task_delete
  AFTER DELETE
  ON project_task FOR EACH ROW
begin

  call project_recalc_tasks(old.project_id);
   
end//

create trigger user_history_insert after insert on user
for each row
begin
  insert into history (table_id, row_id, date_time, what)
  values (1, new.user_id, now(), 'User created.');
end//

create trigger user_history_update after update on user
for each row
begin
  insert into history (table_id, row_id, date_time, what)
  values (1, new.user_id, now(), 'User modified.');
end//

create trigger computer_history_insert after insert on computer
for each row
begin
  insert into history (table_id, row_id, date_time, what)
  values (2, new.computer_id, now(), 'Computer created.');
end//

create trigger computer_history_update after update on computer
for each row
begin
  insert into history (table_id, row_id, date_time, what)
  values (2, new.computer_id, now(), 'Computer modified.');
end//

create trigger project_insert after insert on project
for each row
begin
  insert into history (table_id, row_id, date_time, what)
  values (100, new.id, now(), 'Project created.');
end//

create trigger project_update after update on project
for each row
begin
  insert into history (table_id, row_id, date_time, what)
  values (100, new.id, now(), 'Project modified.');
end//

delimiter ;