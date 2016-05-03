-- FAQ Tables
CREATE TABLE faq_question (
  id Integer NOT NULL AUTO_INCREMENT,
  question Varchar(128),
  answer Text,
  PRIMARY KEY (
    id
  )
) ENGINE=InnoDB;