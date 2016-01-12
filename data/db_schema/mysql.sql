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
  username          NVarChar(128),
  email             NVarChar(256),
  sam_account_name  NVarChar(128),
  userPrincipalName NVarChar(128),
  telephoneNumber   NVarChar(32),
  extensionNumber   NVarChar(32),
  displayName       NVarChar(64),
  description       NVarChar(128),
  office            NVarChar(64),
  photoFilename     NVarChar(64),
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
  created_by_id        Integer NOT NULL,
  created_time         Timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (
      id
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
  created_by_id        Integer NOT NULL,
  created_time         Timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (
      id
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
  created_by_id        Integer NOT NULL,
  created_time         Timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (
      id
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

