-- Mail Table
CREATE TABLE mail (
  id            integer(11)  not null auto_increment,
  subject       varchar(128)     null,
  content_type  varchar(255)     null,
  status        integer(11)  not null,
  reply_name    varchar(64)  not null,
  reply_address varchar(254) not null,
  created_time  DateTime     not null,
  PRIMARY KEY (id)
) ENGINE=InnoDB;

-- Sender/Reciever table
CREATE TABLE mail_participant(
  id             integer(11)  not null auto_increment,
  composition    varchar(4)   not null,
  name           varchar(64)  not null,
  address        varchar(254) not null,
  mail_id        integer(11)  not null,
  INDEX idx_mail_recipient_mail_id (mail_id),
  FOREIGN KEY (mail_id)  REFERENCES mail(id) ON DELETE CASCADE,
  PRIMARY KEY (id)
) ENGINE=InnoDB;

-- Content table
CREATE TABLE mail_part (
  id      integer(11) not null auto_increment,
  type    varchar(32) not null,
  content text        not null,
  mail_id integer(11) not null,
  INDEX idx_mail_part_mail_id (mail_id),
  FOREIGN KEY (mail_id)  REFERENCES mail(id) ON DELETE CASCADE,
  PRIMARY KEY (id)
) ENGINE=InnoDb;
