CREATE TABLE produkty (
  id integer not null auto_increment primary key,
  nazov varchar(255) not null,
  popis text not null,
  cena decimal(10,2) not null,
  status char(1) default 'a' COMMENT 'a-aktiv,d-deleted',
  INDEX (id)
) ENGINE = InnoDB ;

CREATE TABLE ceny (
  id integer not null auto_increment primary key,
  produkt_id integer not null,
  cena decimal(10,2) not null,
  zmenene timestamp DEFAULT CURRENT_TIMESTAMP,
  INDEX (produkt_id)
) ENGINE = InnoDB ;

DELIMITER $$
CREATE TRIGGER zmena_ceny
AFTER UPDATE OF cena
ON produkty
FOR EACH ROW
BEGIN
    INSERT INTO ceny SET produkt_id = produkty.id , cena = produkty.cena
END$$
DELIMITER ;
