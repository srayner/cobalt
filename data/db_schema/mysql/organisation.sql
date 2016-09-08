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
  FOREIGN KEY (company_id)  REFERENCES company(id) ON DELETE CASCADE,
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
  INDEX idx_department_comapany_id (company_id),
  FOREIGN KEY (company_id)  REFERENCES company(id) ON DELETE CASCADE,
  PRIMARY KEY (id)
) ENGINE=InnoDb DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

-- User table
CREATE TABLE `user` (
  id                  Integer NOT NULL AUTO_INCREMENT,
  username            VarChar(128),
  password            VarChar(128),
  domain              Varchar(128),
  email_address       VarChar(256),
  sam_account_name    VarChar(128),
  user_principal_name VarChar(128),
  telephone_number    VarChar(32),
  mobile_number       Varchar(32),
  extension_number    VarChar(32),
  display_name        VarChar(64),
  description         VarChar(128),
  office_id           Integer,
  company_id          Integer,
  department_id       Integer,
  title               VarChar(64),
  reports_to_id       Integer,
  photo_filename      VarChar(64),
  bad_password_count  Integer,
  bad_password_time   DateTime,
  INDEX idx_department_comapany_id (company_id),
  FOREIGN KEY (company_id) REFERENCES company(id), 
  PRIMARY KEY (id)
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

delimiter //

create trigger company_history_insert after insert on company
for each row
begin
  insert into history (table_id, row_id, date_time, what)
  values (500, new.id, now(), 'Company created.');
end//

create trigger company_history_update after update on company
for each row
begin
  insert into history (table_id, row_id, date_time, what)
  values (500, new.id, now(), 'Company modified.');
end//

create trigger office_history_insert after insert on office
for each row
begin
  insert into history (table_id, row_id, date_time, what)
  values (501, new.id, now(), 'Office created.');
end//

create trigger office_history_update after update on office
for each row
begin
  insert into history (table_id, row_id, date_time, what)
  values (501, new.id, now(), 'Office modified.');
end//

create trigger department_history_insert after insert on department
for each row
begin
  insert into history (table_id, row_id, date_time, what)
  values (502, new.id, now(), 'Department created.');
end//

create trigger department_history_update after update on department
for each row
begin
  insert into history (table_id, row_id, date_time, what)
  values (502, new.id, now(), 'Department modified.');
end//

create trigger user_history_insert after insert on user
for each row
begin
  insert into history (table_id, row_id, date_time, what)
  values (1, new.id, now(), 'User created.');
end//

create trigger user_history_update after update on user
for each row
begin
  insert into history (table_id, row_id, date_time, what)
  values (1, new.id, now(), 'User modified.');
end//

delimiter ;