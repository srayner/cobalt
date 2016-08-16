-- Software type table
CREATE TABLE software_type(
    id Integer                 NOT NULL AUTO_INCREMENT,
    name Varchar(64)           NOT NULL,
    description Text               NULL,
    PRIMARY KEY(id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

-- Software category table
CREATE TABLE software_category(
    id Integer                 NOT NULL AUTO_INCREMENT,
    name Varchar(64)           NOT NULL,
    description Text               NULL,
    PRIMARY KEY(id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

-- Software manufacturer table
CREATE TABLE software_manufacturer(
    id Integer                 NOT NULL AUTO_INCREMENT,
    name Varchar(128)          NOT NULL,
    address Text                   NULL,
    support_email Varchar(256)     NULL,
    website_url Varchar(256)       NULL,
    PRIMARY KEY(id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

-- Software table
CREATE TABLE software(
    id Integer                 NOT NULL AUTO_INCREMENT,
    name Varchar(128)          NOT NULL,
    version Varchar(32)            NULL,
    manufacturer_id Integer    NOT NULL,
    type_id Integer            NOT NULL,
    category_id Integer        NOT NULL,
    installation_count Integer NOT NULL,
    description Text               NULL,
    INDEX idx_software_manufacturer_id (manufacturer_id),
    INDEX idx_software_type_id (type_id),
    INDEX idx_software_category_id (category_id),
    FOREIGN KEY (manufacturer_id) REFERENCES software_manufacturer(id) ON DELETE RESTRICT,
    FOREIGN KEY (type_id)         REFERENCES software_type(id)         ON DELETE RESTRICT,
    FOREIGN KEY (category_id)     REFERENCES software_category(id)     ON DELETE RESTRICT,
    PRIMARY KEY(id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

-- Software installation table
CREATE TABLE software_installation(
    id Integer                  NOT NULL AUTO_INCREMENT,
    computer_id     Integer     NOT NULL,
    software_id     Integer     NOT NULL,
    installed_date  Date            NULL,
    license_key     Varchar(128)    NULL,
    usage_frequency Varchar(32)     NULL,
    INDEX idx_software_inst_comp_id (computer_id),
    INDEX idx_software_inst_soft_id (software_id),
    FOREIGN KEY (computer_id) REFERENCES computer(id) ON DELETE RESTRICT,
    FOREIGN KEY (software_id) REFERENCES software(id) ON DELETE RESTRICT,
    PRIMARY KEY(id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

-- Software license table
CREATE TABLE software_license(
    id Integer                    NOT NULL AUTO_INCREMENT,
    software_id Integer           NOT NULL,
    license_key Varchar(128)          NULL,
    installations_allowed Integer NOT NULL,
    INDEX idx_software_lice_soft_id (software_id),
    FOREIGN KEY (software_id) REFERENCES software(id) ON DELETE RESTRICT,
    PRIMARY KEY(id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

delimiter//

create trigger software_history_insert after insert on software
for each row
begin
  insert into history (table_id, row_id, date_time, what)
  values (400, new.id, now(), 'Software created.');
end//

create trigger software_history_update after update on software
for each row
begin
  insert into history (table_id, row_id, date_time, what)
  values (400, new.id, now(), 'Software modified.');
end//

delimiter;