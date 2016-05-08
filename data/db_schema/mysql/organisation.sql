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

-- Department table
CREATE TABLE department(
  id Integer       NOT NULL AUTO_INCREMENT,
  name Varchar(64) NOT NULL,
  description Text     NULL,
  phone Varchar(24)    NULL,
  fax Varchar(24)      NULL,
  company_id Integer NOT NULL,
  INDEX idx_department_comapny_id (company_id),
  FOREIGN KEY (company_id)  REFERENCES office(id) ON DELETE CASCADE,
  PRIMARY KEY (id)
) ENGINE=InnoDb DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

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

-- History table.
CREATE TABLE history (
    id        Integer      NOT NULL AUTO_INCREMENT,
    table_id  Integer      NOT NULL,
    row_id    Integer      NOT NULL,
    date_time Timestamp    NOT NULL,
    what      Varchar(120) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;

-- Triggers
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