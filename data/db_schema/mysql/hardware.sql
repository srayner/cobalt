-- Hardware type table
CREATE TABLE hardware_type(
    id Integer                 NOT NULL AUTO_INCREMENT,
    name Varchar(64)           NOT NULL,
    description Text               NULL,
    PRIMARY KEY(id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

-- Hardware status table
CREATE TABLE hardware_status(
    id Integer                 NOT NULL AUTO_INCREMENT,
    name Varchar(64)           NOT NULL,
    description Text               NULL,
    PRIMARY KEY(id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

-- Hardware manufacturer table
CREATE TABLE hardware_manufacturer(
    id Integer                 NOT NULL AUTO_INCREMENT,
    name Varchar(128)          NOT NULL,
    address Text                   NULL,
    email Varchar(256)             NULL,
    website_url Varchar(256)       NULL,
    PRIMARY KEY(id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE hardware(
    id                Integer     NOT NULL AUTO_INCREMENT,
    reference         Varchar(16)     NULL,
    type_id           Integer     NOT NULL,
    status_id         Integer     NOT NULL,
    model             Varchar(64)     NULL,
    serial_number     Varchar(64)     NULL,
    manufacturer_id   Integer     NOT NULL,
    purchase_date     Date            NULL,
    warranty_end_date Date            NULL,
    disposal_date     Date            NULL,
    asset_number      Varchar(32)     NULL,
    notes             Text            NULL,
    INDEX idx_hardware_type_id (type_id),
    INDEX idx_hardware_status_id (status_id),
    INDEX idx_hardware_manufacturer_id (manufacturer_id),
    FOREIGN KEY (type_id)         REFERENCES hardware_type(id)         ON DELETE RESTRICT,
    FOREIGN KEY (status_id)       REFERENCES hardware_status(id)       ON DELETE RESTRICT,
    FOREIGN KEY (manufacturer_id) REFERENCES hardware_manufacturer(id) ON DELETE RESTRICT,
    PRIMARY KEY(id)
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

-- User computer relationship table
CREATE TABLE user_computer (
  user_id     Integer NOT NULL,
  computer_id Integer NOT NULL, 
  PRIMARY KEY (
      user_id, 
      computer_id
  )
) ENGINE=InnoDB;