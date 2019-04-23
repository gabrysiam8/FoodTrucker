CREATE SEQUENCE katalog_foodtruck.adres_id_adresu_seq;

CREATE DOMAIN dom_kod_pocz AS TEXT CONSTRAINT check_kod CHECK ( VALUE ~ '^[0-9]{2}-[0-9]{3}$' );

CREATE TABLE katalog_foodtruck.Adres (
                id_adresu INTEGER NOT NULL DEFAULT nextval('katalog_foodtruck.adres_id_adresu_seq'),
                miasto VARCHAR NOT NULL,
                kod_pocztowy dom_kod_pocz NOT NULL,
                ulica VARCHAR NOT NULL,
                numer INTEGER NOT NULL,
                CONSTRAINT id_adresu PRIMARY KEY (id_adresu)
);


ALTER SEQUENCE katalog_foodtruck.adres_id_adresu_seq OWNED BY katalog_foodtruck.Adres.id_adresu;

CREATE SEQUENCE katalog_foodtruck.wydarzenie_id_wydarzenia_seq;

CREATE TABLE katalog_foodtruck.Wydarzenie (
                id_wydarzenia INTEGER NOT NULL DEFAULT nextval('katalog_foodtruck.wydarzenie_id_wydarzenia_seq'),
                nazwa VARCHAR NOT NULL,
                data DATE NOT NULL,
                id_adresu INTEGER NOT NULL,
                CONSTRAINT id_wydarzenia PRIMARY KEY (id_wydarzenia)
);


ALTER SEQUENCE katalog_foodtruck.wydarzenie_id_wydarzenia_seq OWNED BY katalog_foodtruck.Wydarzenie.id_wydarzenia;

CREATE SEQUENCE katalog_foodtruck.promocja_id_promocji_seq;

CREATE TABLE katalog_foodtruck.Promocja (
                id_promocji INTEGER NOT NULL DEFAULT nextval('katalog_foodtruck.promocja_id_promocji_seq'),
                rodzaj VARCHAR NOT NULL,
                start DATE NOT NULL,
                koniec DATE NOT NULL,
                CONSTRAINT id_promocji PRIMARY KEY (id_promocji)
);


ALTER SEQUENCE katalog_foodtruck.promocja_id_promocji_seq OWNED BY katalog_foodtruck.Promocja.id_promocji;

CREATE SEQUENCE katalog_foodtruck.typ_kuchni_id_typu_kuch_seq;

CREATE TABLE katalog_foodtruck.Typ_kuchni (
                id_typu_kuch INTEGER NOT NULL DEFAULT nextval('katalog_foodtruck.typ_kuchni_id_typu_kuch_seq'),
                nazwa VARCHAR NOT NULL UNIQUE,
                CONSTRAINT id_typu_kuch PRIMARY KEY (id_typu_kuch)
);


ALTER SEQUENCE katalog_foodtruck.typ_kuchni_id_typu_kuch_seq OWNED BY katalog_foodtruck.Typ_kuchni.id_typu_kuch;

CREATE SEQUENCE katalog_foodtruck.danie_id_dania_seq;

CREATE TABLE katalog_foodtruck.Danie (
                id_dania INTEGER NOT NULL DEFAULT nextval('katalog_foodtruck.danie_id_dania_seq'),
                nazwa VARCHAR NOT NULL,
                id_typu_kuch INTEGER NOT NULL,
                CONSTRAINT id_dania PRIMARY KEY (id_dania)
);


ALTER SEQUENCE katalog_foodtruck.danie_id_dania_seq OWNED BY katalog_foodtruck.Danie.id_dania;

CREATE SEQUENCE katalog_foodtruck.foodpark_id_foodparku_seq;

CREATE TABLE katalog_foodtruck.Foodpark (
                id_foodparku INTEGER NOT NULL DEFAULT nextval('katalog_foodtruck.foodpark_id_foodparku_seq'),
                nazwa VARCHAR NOT NULL UNIQUE,
                id_adresu INTEGER NOT NULL,
                CONSTRAINT foodpark_id PRIMARY KEY (id_foodparku)
);


ALTER SEQUENCE katalog_foodtruck.foodpark_id_foodparku_seq OWNED BY katalog_foodtruck.Foodpark.id_foodparku;

CREATE SEQUENCE katalog_foodtruck.firma_id_firmy_seq;

CREATE DOMAIN dom_nip AS TEXT CONSTRAINT check_nip CHECK ( VALUE ~ '^[0-9]{10}$' );

CREATE TABLE katalog_foodtruck.Firma (
                id_firmy INTEGER NOT NULL DEFAULT nextval('katalog_foodtruck.firma_id_firmy_seq'),
                nazwa VARCHAR NOT NULL UNIQUE,
                nip dom_nip NOT NULL UNIQUE,
                ocena NUMERIC(2,1),
                CONSTRAINT id_firmy PRIMARY KEY (id_firmy)
);


ALTER SEQUENCE katalog_foodtruck.firma_id_firmy_seq OWNED BY katalog_foodtruck.Firma.id_firmy;

CREATE TABLE katalog_foodtruck.firma_typ_kuch (
                id_firmy INTEGER NOT NULL,
                id_typu_kuch INTEGER NOT NULL,
                CONSTRAINT id_firma_typ_kuch PRIMARY KEY (id_firmy, id_typu_kuch)
);


CREATE TABLE katalog_foodtruck.firma_promocja (
                id_firmy INTEGER NOT NULL,
                id_promocji INTEGER NOT NULL,
                CONSTRAINT firma_promo_id PRIMARY KEY (id_firmy, id_promocji)
);


CREATE TABLE katalog_foodtruck.firma_danie (
                id_dania INTEGER NOT NULL,
                id_firmy INTEGER NOT NULL,
                CONSTRAINT firma_danie_id PRIMARY KEY (id_dania, id_firmy)
);


CREATE SEQUENCE katalog_foodtruck.opinia_id_opinii_seq;

CREATE TABLE katalog_foodtruck.Opinia (
                id_opinii INTEGER NOT NULL DEFAULT nextval('katalog_foodtruck.opinia_id_opinii_seq'),
                ocena NUMERIC(2,1) NOT NULL,
                informacja VARCHAR,
                autor VARCHAR,
                id_firmy INTEGER NOT NULL,
                CONSTRAINT id_opinii PRIMARY KEY (id_opinii)
);


ALTER SEQUENCE katalog_foodtruck.opinia_id_opinii_seq OWNED BY katalog_foodtruck.Opinia.id_opinii;

CREATE SEQUENCE katalog_foodtruck.foodtruck_id_foodtrucka_seq;

CREATE DOMAIN dom_tel AS TEXT CONSTRAINT check_tel CHECK ( VALUE ~ '^[0-9]*$' );

CREATE TABLE katalog_foodtruck.Foodtruck (
                id_foodtrucka INTEGER NOT NULL DEFAULT nextval('katalog_foodtruck.foodtruck_id_foodtrucka_seq'),
                godzina_otwarcia TIME NOT NULL,
                godzina_zamkniecia TIME NOT NULL,
                telefon dom_tel,
                id_foodparku INTEGER NOT NULL,
                id_firmy INTEGER NOT NULL,
                CONSTRAINT id_foodtrucka PRIMARY KEY (id_foodtrucka)
);


ALTER SEQUENCE katalog_foodtruck.foodtruck_id_foodtrucka_seq OWNED BY katalog_foodtruck.Foodtruck.id_foodtrucka;

CREATE TABLE katalog_foodtruck.wydarzenie_foodtruck (
                id_foodtrucka INTEGER NOT NULL,
                id_wydarzenia INTEGER NOT NULL,
                CONSTRAINT wydarzenie_foodtruck_id PRIMARY KEY (id_foodtrucka, id_wydarzenia)
);


ALTER TABLE katalog_foodtruck.Foodpark ADD CONSTRAINT adres_foodpark_fk
FOREIGN KEY (id_adresu)
REFERENCES katalog_foodtruck.Adres (id_adresu)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE katalog_foodtruck.Wydarzenie ADD CONSTRAINT adres_wydarzenie_fk
FOREIGN KEY (id_adresu)
REFERENCES katalog_foodtruck.Adres (id_adresu)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE katalog_foodtruck.wydarzenie_foodtruck ADD CONSTRAINT wydarzenie_wydarzenie_foodtruck_fk
FOREIGN KEY (id_wydarzenia)
REFERENCES katalog_foodtruck.Wydarzenie (id_wydarzenia)
ON DELETE CASCADE
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE katalog_foodtruck.firma_promocja ADD CONSTRAINT promocja_firma_promocja_fk
FOREIGN KEY (id_promocji)
REFERENCES katalog_foodtruck.Promocja (id_promocji)
ON DELETE CASCADE
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE katalog_foodtruck.Danie ADD CONSTRAINT typ_kuchni_danie_fk
FOREIGN KEY (id_typu_kuch)
REFERENCES katalog_foodtruck.Typ_kuchni (id_typu_kuch)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE katalog_foodtruck.firma_typ_kuch ADD CONSTRAINT typ_kuchni_firma_typ_kuch_fk
FOREIGN KEY (id_typu_kuch)
REFERENCES katalog_foodtruck.Typ_kuchni (id_typu_kuch)
ON DELETE CASCADE
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE katalog_foodtruck.firma_danie ADD CONSTRAINT danie_firma_danie_fk
FOREIGN KEY (id_dania)
REFERENCES katalog_foodtruck.Danie (id_dania)
ON DELETE CASCADE
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE katalog_foodtruck.Foodtruck ADD CONSTRAINT foodpark_foodtruck_fk
FOREIGN KEY (id_foodparku)
REFERENCES katalog_foodtruck.Foodpark (id_foodparku)
ON DELETE CASCADE
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE katalog_foodtruck.Opinia ADD CONSTRAINT firma_opinia_fk
FOREIGN KEY (id_firmy)
REFERENCES katalog_foodtruck.Firma (id_firmy)
ON DELETE CASCADE
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE katalog_foodtruck.Foodtruck ADD CONSTRAINT firma_foodtruck_fk
FOREIGN KEY (id_firmy)
REFERENCES katalog_foodtruck.Firma (id_firmy)
ON DELETE CASCADE
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE katalog_foodtruck.firma_danie ADD CONSTRAINT firma_firma_danie_fk
FOREIGN KEY (id_firmy)
REFERENCES katalog_foodtruck.Firma (id_firmy)
ON DELETE CASCADE
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE katalog_foodtruck.firma_promocja ADD CONSTRAINT firma_firma_promocja_fk
FOREIGN KEY (id_firmy)
REFERENCES katalog_foodtruck.Firma (id_firmy)
ON DELETE CASCADE
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE katalog_foodtruck.firma_typ_kuch ADD CONSTRAINT firma_firma_typ_kuch_fk
FOREIGN KEY (id_firmy)
REFERENCES katalog_foodtruck.Firma (id_firmy)
ON DELETE CASCADE
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE katalog_foodtruck.wydarzenie_foodtruck ADD CONSTRAINT foodtruck_wydarzenie_foodtruck_fk
FOREIGN KEY (id_foodtrucka)
REFERENCES katalog_foodtruck.Foodtruck (id_foodtrucka)
ON DELETE CASCADE
ON UPDATE NO ACTION
NOT DEFERRABLE;