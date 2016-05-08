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