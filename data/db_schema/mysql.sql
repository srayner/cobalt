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

-- User table
CREATE TABLE user (
  user_id Integer NOT NULL AUTO_INCREMENT,
  username            NVarChar(128),
  email               NVarChar(256),
  sam_account_name    NVarChar(128),
  user_principal_name NVarChar(128),
  telephone_number    NVarChar(32),
  extension_number    NVarChar(32),
  display_name        NVarChar(64),
  description         NVarChar(128),
  office              NVarChar(64),
  photo_filename      NVarChar(64),
  company             NVarChar(64),
  department          NVarChar(64),
  title               NVarChar(64)
  PRIMARY KEY (user_id)
) ENGINE=InnoDb DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

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
  PRIMARY KEY (
      id
  )
) ENGINE=InnoDB;

-- Project status table
CREATE TABLE project_status (
  id                     Integer NOT NULL AUTO_INCREMENT,
  status_name            NVarChar(32),
  status_description     NVarChar(128),
  PRIMARY KEY (id)
) ENGINE=InnoDb CHARACTER SET utf8 COLLATE utf8_general_ci;
insert into project_status (status_name, status_description) values ('Open', 'Project is currently active and in progress.');
insert into project_status (status_name, status_description) values ('On hold', 'Project is currently on hold.');
insert into project_status (status_name, status_description) values ('Cancelled', 'Project has been cancelled.');
insert into project_status (status_name, status_description) values ('Completed', 'Project has been completed.');

-- Project priority table
CREATE TABLE project_priority (
  id                     Integer NOT NULL AUTO_INCREMENT,
  priority_name          NVarChar(32),
  priority_description   NVarChar(128),
  PRIMARY KEY (id)
) ENGINE=InnoDb CHARACTER SET utf8 COLLATE utf8_general_ci;
insert into project_priority (priority_name, priority_description) values ('High', 'Project is a high priority.');
insert into project_priority (priority_name, priority_description) values ('Medium', 'Project is a medium priority.');
insert into project_priority (priority_name, priority_description) values ('Low', 'Project is low low priority.');

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
  PRIMARY KEY (
      id
  )
) ENGINE=InnoDB;

-- Milestone status table
CREATE TABLE milestone_status (
  id                     Integer NOT NULL AUTO_INCREMENT,
  status_name            NVarChar(32),
  status_description     NVarChar(128),
  PRIMARY KEY (id)
) ENGINE=InnoDb CHARACTER SET utf8 COLLATE utf8_general_ci;
insert into milestone_status (status_name, status_description) values ('Open', 'Milestone is currently active and in progress.');
insert into milestone_status (status_name, status_description) values ('On hold', 'Milestone is currently on hold.');
insert into milestone_status (status_name, status_description) values ('Cancelled', 'Milestone has been cancelled.');
insert into milestone_status (status_name, status_description) values ('Completed', 'Milestone has been completed.');

-- Milestone priority table
CREATE TABLE milestone_priority (
  id                     Integer NOT NULL AUTO_INCREMENT,
  priority_name          NVarChar(32),
  priority_description   NVarChar(128),
  PRIMARY KEY (id)
) ENGINE=InnoDb CHARACTER SET utf8 COLLATE utf8_general_ci;
insert into milestone_priority (priority_name, priority_description) values ('High', 'Milestone is a high priority.');
insert into milestone_priority (priority_name, priority_description) values ('Medium', 'Milestone is a medium priority.');
insert into milestone_priority (priority_name, priority_description) values ('Low', 'Milestone is low low priority.');

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
  PRIMARY KEY (id)
) ENGINE=InnoDb CHARACTER SET utf8 COLLATE utf8_general_ci;
insert into task_status (status_name, status_description) values ('Open', 'Task is currently active and in progress.');
insert into task_status (status_name, status_description) values ('On hold', 'Task is currently on hold.');
insert into task_status (status_name, status_description) values ('Cancelled', 'Task has been cancelled.');
insert into task_status (status_name, status_description) values ('Completed', 'Task has been completed.');

-- Task priority table
CREATE TABLE task_priority (
  id                     Integer NOT NULL AUTO_INCREMENT,
  priority_name          NVarChar(32),
  priority_description   NVarChar(128),
  PRIMARY KEY (id)
) ENGINE=InnoDb CHARACTER SET utf8 COLLATE utf8_general_ci;
insert into task_priority (priority_name, priority_description) values ('High', 'Task is a high priority.');
insert into task_priority (priority_name, priority_description) values ('Medium', 'Task is a medium priority.');
insert into task_priority (priority_name, priority_description) values ('Low', 'Task is low low priority.');

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

-- Comment Table
CREATE TABLE comment (
  id Integer NOT NULL AUTO_INCREMENT,
  comment Text,
  PRIMARY KEY (
    id
  )
) ENGINE=InnoDB;


