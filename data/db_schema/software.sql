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
    PRIMARY_KEY(id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

-- Software type table
CREATE TABLE software_type(
    id Integer                 NOT NULL AUTO_INCREMENT,
    name Varchar(64)           NOT NULL,
    description Text               NULL,
    PRIMARY_KEY(id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

-- Software category table
CREATE TABLE software_category(
    id Integer                 NOT NULL AUTO_INCREMENT,
    name Varchar(64)           NOT NULL,
    description Text               NULL,
    PRIMARY_KEY(id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

-- Software manufacturer table
CREATE TABLE software_manufacturer(
    id Integer                 NOT NULL AUTO_INCREMENT,
    name Varchar(128)          NOT NULL,
    address Text                   NULL,
    support_email Varchar(256)     NULL,
    website_url Varchar(256)       NULL,
    PRIMARY_KEY(id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

-- Software installation table
CREATE TABLE software_installation(
    id Integer                 NOT NULL AUTO_INCREMENT,
    computer_id Integer        NOT NULL,
    software_id Integer        NOT NULL,
    installed_date Date            NULL,
    license_key Varchar(128)       NULL,
    usage Varchar(32)              NULL,
    PRIMARY_KEY(id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

-- Software license table
CREATE TABLE software_installation(
    id Integer                    NOT NULL AUTO_INCREMENT,
    software_id Integer           NOT NULL,
    license_key Varchar(128)          NULL,
    installations_allowed Integer NOT NULL,
    PRIMARY_KEY(id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;