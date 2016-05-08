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