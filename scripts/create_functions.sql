CREATE OR REPLACE FUNCTION katalog_foodtruck.dodaj_opinie(text, decimal, text, text) RETURNS text AS '
DECLARE
id_f integer;
BEGIN
	SELECT id_firmy INTO id_f FROM katalog_foodtruck.firma WHERE LOWER(nazwa) = LOWER($1);
	IF NOT FOUND THEN
		RETURN ''W bazie nie istnieje firma o nazwie ''|| $1 ||''!'';
	END IF;
	INSERT INTO katalog_foodtruck.opinia (ocena, informacja, autor, id_firmy) VALUES ($2, $3, $4, id_f);
	RETURN ''Opinia została dodana.'';
END;
' LANGUAGE 'plpgsql';


CREATE OR REPLACE FUNCTION katalog_foodtruck.zaktualizuj_ocene() RETURNS TRIGGER AS '
DECLARE
	oc float8;
	BEGIN
		IF (TG_OP = ''UPDATE'' OR TG_OP = ''INSERT'') THEN
			SELECT AVG(o.ocena) INTO oc FROM katalog_foodtruck.opinia o, katalog_foodtruck.firma f WHERE o.id_firmy=new.id_firmy 
			AND o.id_firmy=f.id_firmy;
			UPDATE katalog_foodtruck.firma SET ocena=oc WHERE id_firmy=new.id_firmy;
			RETURN NEW;
		ELSE
			SELECT AVG(o.ocena) INTO oc FROM katalog_foodtruck.opinia o, katalog_foodtruck.firma f WHERE o.id_firmy=old.id_firmy 
			AND o.id_firmy=f.id_firmy;
			UPDATE katalog_foodtruck.firma SET ocena=oc WHERE id_firmy=old.id_firmy;
			RETURN NULL;
		END IF;
	END;
' LANGUAGE 'plpgsql';

CREATE TRIGGER licznik_oceny AFTER INSERT OR UPDATE OR DELETE ON katalog_foodtruck.Opinia FOR EACH ROW EXECUTE PROCEDURE 
katalog_foodtruck.zaktualizuj_ocene();


CREATE OR REPLACE FUNCTION katalog_foodtruck.dodaj_foodtruck(text, text, time without time zone, time without time zone, text) 
RETURNS text AS '
DECLARE
id_f integer;
id_p integer;
ft RECORD;
tel_format boolean;
BEGIN
	SELECT id_firmy INTO id_f FROM katalog_foodtruck.firma WHERE LOWER(nazwa) = LOWER($1);
	IF NOT FOUND THEN
		RETURN ''W bazie nie istnieje firma o nazwie ''|| $1 ||''!'';
	END IF;
	SELECT id_foodparku INTO id_p FROM katalog_foodtruck.foodpark WHERE LOWER(nazwa) = LOWER($2);
	IF NOT FOUND THEN
		RETURN ''W bazie nie istnieje food park o nazwie ''|| $2 ||''!'';
	END IF;
	SELECT * INTO ft FROM katalog_foodtruck.foodtruck f WHERE f.id_firmy=id_f AND f.id_foodparku=id_p;
	IF NOT FOUND THEN
		SELECT $5 ~ ''^[0-9]*$'' INTO tel_format;
		IF tel_format THEN
			INSERT INTO katalog_foodtruck.foodtruck ( godzina_otwarcia, godzina_zamkniecia, telefon, id_firmy, id_foodparku) VALUES 
			( $3, $4, $5, id_f, id_p);
			RETURN ''Food truck został dodany.'';
		ELSE
			RETURN ''Zły numer telefonu!'';
		END IF; 
	ELSE
		RETURN ''W danym food parku jest już food truck danej firmy!'';
	END IF;
END;
' LANGUAGE 'plpgsql';

CREATE OR REPLACE FUNCTION katalog_foodtruck.zaktualizuj_foodtruck(text, text, time without time zone, time without time zone, text, integer) 
RETURNS text AS '
DECLARE
id_f integer;
id_p integer;
ft RECORD;
tel_format boolean;
BEGIN
	SELECT id_firmy INTO id_f FROM katalog_foodtruck.firma WHERE LOWER(nazwa) = LOWER($1);
	IF NOT FOUND THEN
		RETURN ''W bazie nie istnieje firma o nazwie ''|| $1 ||''!'';
	END IF;
	SELECT id_foodparku INTO id_p FROM katalog_foodtruck.foodpark WHERE LOWER(nazwa)=LOWER($2);
	IF NOT FOUND THEN
		RETURN ''W bazie nie istnieje food park o nazwie ''|| $2 ||''!'';
	END IF;
	SELECT * INTO ft FROM katalog_foodtruck.foodtruck f WHERE f.id_firmy=id_f AND f.id_foodparku=id_p AND id_foodtrucka<>$6;
	IF NOT FOUND THEN
		SELECT $5 ~ ''^[0-9]*$'' INTO tel_format;
		IF tel_format THEN
			UPDATE katalog_foodtruck.foodtruck SET godzina_otwarcia=$3, godzina_zamkniecia=$4, telefon=$5, id_firmy=id_f, id_foodparku=id_p 
			WHERE id_foodtrucka=$6;
			RETURN ''Food truck został zmodyfikowany.'';
		ELSE
			RETURN ''Zły numer telefonu!'';
		END IF; 	
	ELSE
		RETURN ''W bazie istnieje już taki food truck!'';
	END IF;
END;
' LANGUAGE 'plpgsql';


CREATE OR REPLACE FUNCTION katalog_foodtruck.dodaj_firme(text, text) RETURNS text AS '
DECLARE
firm RECORD;
nip_format boolean;
BEGIN
	SELECT * INTO firm FROM katalog_foodtruck.firma WHERE LOWER(nazwa)=LOWER($1);
	IF FOUND THEN
		RETURN ''W bazie istnieje już firma o nazwie ''|| $1 ||''!'';
	END IF;
	SELECT * INTO firm FROM katalog_foodtruck.firma WHERE nip = $2;
	IF FOUND THEN
		RETURN ''W bazie istnieje już firma o numerze NIP ''|| $2 ||''!'';
	END IF;
	SELECT $2 ~ ''^[0-9]{10}$'' INTO nip_format;
	IF nip_format THEN
		INSERT INTO katalog_foodtruck.firma ( nazwa, nip ) VALUES ( $1, $2 );
		RETURN ''Firma została dodana.'';
	ELSE
		RETURN ''Zły numer NIP!'';
	END IF; 
END;
' LANGUAGE 'plpgsql';

CREATE OR REPLACE FUNCTION katalog_foodtruck.zaktualizuj_firme(text, text, integer) RETURNS text AS '
DECLARE
firm RECORD;
nip_format boolean;
BEGIN
	SELECT * INTO firm FROM katalog_foodtruck.firma WHERE LOWER(nazwa) = LOWER($1) AND id_firmy<>$3;
	IF FOUND THEN
		RETURN ''W bazie istnieje już firma o nazwie ''|| $1 ||''!'';
	END IF;
	SELECT * INTO firm FROM katalog_foodtruck.firma WHERE nip = $2 AND id_firmy<>$3;
	IF FOUND THEN
		RETURN ''W bazie istnieje już firma o numerze NIP ''|| $2 ||''!'';
	END IF;
	SELECT $2 ~ ''^[0-9]{10}$'' INTO nip_format;
	IF nip_format THEN
		UPDATE katalog_foodtruck.firma SET nazwa=$1, nip=$2 WHERE id_firmy=$3;
		RETURN ''Firma została zmodyfikowana.'';
	ELSE
		RETURN ''Zły numer NIP!'';
	END IF; 
END;
' LANGUAGE 'plpgsql';


CREATE OR REPLACE FUNCTION katalog_foodtruck.dodaj_adres(text, text, text, integer) RETURNS text AS '
DECLARE
adr RECORD;
kod_pocz_format boolean;
BEGIN
	SELECT * INTO adr FROM katalog_foodtruck.adres WHERE LOWER(miasto) = LOWER($1) AND kod_pocztowy=$2 AND LOWER(ulica)=LOWER($3) 
	AND numer=$4;
	IF FOUND THEN
		RETURN '''';
	ELSE
		SELECT $2 ~ ''^[0-9]{2}-[0-9]{3}$'' INTO kod_pocz_format;
		IF kod_pocz_format THEN
			IF $4>0 THEN
				INSERT INTO katalog_foodtruck.adres(miasto, kod_pocztowy, ulica, numer) VALUES ($1, $2, $3, $4);
				RETURN '''';
			ELSE
				 RETURN ''Zly numer!'';
			END IF;
		ELSE
			RETURN ''Zły kod pocztowy!'';
		END IF; 
	END IF;
END;
' LANGUAGE 'plpgsql';

CREATE OR REPLACE FUNCTION katalog_foodtruck.dodaj_foodpark(text, text, text, text, integer) RETURNS text AS '
DECLARE
fp RECORD;
id_adr integer;
BEGIN
	SELECT * INTO fp FROM katalog_foodtruck.foodpark WHERE LOWER(nazwa) = LOWER($1);
	IF FOUND THEN
		RETURN ''W bazie istnieje już food park o nazwie ''|| $1 ||''!'';
	END IF;
	SELECT * INTO fp FROM katalog_foodtruck.foodpark WHERE id_adresu IN (SELECT id_adresu FROM katalog_foodtruck.adres 
	WHERE LOWER(miasto)=LOWER($2) AND kod_pocztowy=$3 AND LOWER(ulica)=LOWER($4) AND numer=$5);
	IF FOUND THEN
		RETURN ''W bazie istnieje już food park o danym adresie!'';
	END IF;
	SELECT id_adresu INTO id_adr FROM katalog_foodtruck.adres WHERE LOWER(miasto)=LOWER($2) AND kod_pocztowy=$3 AND 
	LOWER(ulica)=LOWER($4) AND numer=$5;
	INSERT INTO katalog_foodtruck.foodpark (nazwa, id_adresu) VALUES ($1, id_adr);
	RETURN ''Food park został dodany.'';
END;
' LANGUAGE 'plpgsql';



CREATE OR REPLACE FUNCTION katalog_foodtruck.dodaj_wydarzenie (text, date, text, text, text, integer) RETURNS text AS '
DECLARE
id_adr integer;
BEGIN
	SELECT id_adresu INTO id_adr FROM katalog_foodtruck.adres WHERE LOWER(miasto)=LOWER($3) AND kod_pocztowy=$4 
	AND LOWER(ulica)=LOWER($5) AND numer=$6;
	INSERT INTO katalog_foodtruck.wydarzenie (nazwa, data, id_adresu) VALUES ($1, $2, id_adr);
	RETURN ''Wydarzenie zostalo dodane.'';
END;
' LANGUAGE 'plpgsql';


CREATE OR REPLACE FUNCTION katalog_foodtruck.dodaj_danie (text, text) RETURNS integer AS '
DECLARE
dan RECORD;
typ_k RECORD;
BEGIN
	SELECT * INTO typ_k FROM katalog_foodtruck.typ_kuchni WHERE LOWER(nazwa)=LOWER($2);
	IF NOT FOUND THEN
		INSERT INTO katalog_foodtruck.typ_kuchni (nazwa) VALUES ($2);
		SELECT * INTO typ_k FROM katalog_foodtruck.typ_kuchni WHERE LOWER(nazwa)=LOWER($2);
	END IF;
	SELECT * INTO dan FROM katalog_foodtruck.danie WHERE LOWER(nazwa)=LOWER($1) AND id_typu_kuch=typ_k.id_typu_kuch;
	IF NOT FOUND THEN
		INSERT INTO katalog_foodtruck.danie ( nazwa, id_typu_kuch ) VALUES ($1, typ_k.id_typu_kuch);
		SELECT * INTO dan FROM katalog_foodtruck.danie WHERE LOWER(nazwa)=LOWER($1) AND id_typu_kuch=typ_k.id_typu_kuch;
	END IF;
	RETURN dan.id_dania;
END;
' LANGUAGE 'plpgsql';


CREATE OR REPLACE FUNCTION katalog_foodtruck.dodaj_firma_promocja(integer, text) RETURNS text AS '
DECLARE
firm RECORD;
fp RECORD;
BEGIN
	SELECT * INTO firm FROM katalog_foodtruck.firma WHERE LOWER(nazwa)=LOWER($2);
	IF NOT FOUND THEN
		RETURN ''W bazie nie istnieje firma o nazwie ''|| $2 ||''!'';
	END IF;
	SELECT * INTO fp FROM katalog_foodtruck.firma_promocja WHERE id_firmy=firm.id_firmy AND id_promocji=$1;
	IF FOUND THEN
		RETURN ''Ta firma bierze już udział w tej promocji!'';
	END IF; 
	INSERT INTO katalog_foodtruck.firma_promocja ( id_firmy, id_promocji) VALUES ( firm.id_firmy, $1);
	RETURN ''Firma została dodana do promocji.'';
END;
' LANGUAGE 'plpgsql';


CREATE OR REPLACE FUNCTION katalog_foodtruck.dodaj_foodtruck_wydarzenie(integer, text, text) RETURNS text AS '
DECLARE
firm RECORD;
fp RECORD;
ft RECORD;
wf RECORD;
BEGIN
	SELECT * INTO firm FROM katalog_foodtruck.firma WHERE LOWER(nazwa)=LOWER($2);
	SELECT * INTO fp FROM katalog_foodtruck.foodpark WHERE LOWER(nazwa)=LOWER($3);
	SELECT * INTO ft FROM katalog_foodtruck.foodtruck WHERE id_firmy=firm.id_firmy AND id_foodparku=fp.id_foodparku;
	IF NOT FOUND THEN
		RETURN ''W bazie nie istnieje taki food truck!'';
	END IF;
	SELECT * INTO wf FROM katalog_foodtruck.wydarzenie_foodtruck WHERE id_foodtrucka=ft.id_foodtrucka AND id_wydarzenia=$1;
	IF FOUND THEN
		RETURN ''Ten food truck bierze już udział w tym wydarzeniu!'';
	END IF; 
	INSERT INTO katalog_foodtruck.wydarzenie_foodtruck (id_foodtrucka, id_wydarzenia) VALUES (ft.id_foodtrucka, $1);
	RETURN ''Food truck został dodany do wydarzenia.'';
END;
' LANGUAGE 'plpgsql';


CREATE OR REPLACE FUNCTION katalog_foodtruck.dodaj_firma_danie(integer, integer) RETURNS text AS '
DECLARE
fd RECORD;
BEGIN
	SELECT * INTO fd FROM katalog_foodtruck.firma_danie WHERE id_firmy=$1 AND id_dania=$2;
	IF FOUND THEN
		RETURN ''To danie jest już zapisane w menu firmy!'';
	END IF; 
	INSERT INTO katalog_foodtruck.firma_danie (id_firmy, id_dania) VALUES ($1, $2);
	RETURN ''Danie zostało dodane do menu firmy.'';
END;
' LANGUAGE 'plpgsql';


CREATE OR REPLACE FUNCTION katalog_foodtruck.sprawdz_typ_kuchni() RETURNS TRIGGER AS '
DECLARE
	id_tk integer;
	ft RECORD;
	dan RECORD;
	BEGIN
		IF (TG_OP = ''INSERT'') THEN
			SELECT id_typu_kuch INTO id_tk FROM katalog_foodtruck.Danie WHERE id_dania=new.id_dania;
			SELECT * INTO ft FROM katalog_foodtruck.firma_typ_kuch WHERE id_firmy=new.id_firmy AND id_typu_kuch=id_tk;
			IF NOT FOUND THEN
				INSERT INTO katalog_foodtruck.firma_typ_kuch (id_firmy, id_typu_kuch) VALUES (new.id_firmy, id_tk);
			END IF;
			RETURN NEW;
		ELSE
			SELECT id_typu_kuch INTO id_tk FROM katalog_foodtruck.Danie WHERE id_dania=old.id_dania;
			SELECT * INTO dan FROM katalog_foodtruck.Danie WHERE id_dania IN (SELECT id_dania FROM katalog_foodtruck.firma_danie 
			WHERE id_firmy=old.id_firmy) AND id_typu_kuch=id_tk;
			IF NOT FOUND THEN
				DELETE FROM katalog_foodtruck.firma_typ_kuch WHERE id_firmy=old.id_firmy AND id_typu_kuch=id_tk;
			END IF;
			RETURN NULL;
		END IF;
	END;
' LANGUAGE 'plpgsql';

CREATE TRIGGER sprawdzenie_typu AFTER INSERT OR DELETE ON katalog_foodtruck.firma_danie FOR EACH ROW EXECUTE PROCEDURE 
katalog_foodtruck.sprawdz_typ_kuchni();


CREATE OR REPLACE FUNCTION katalog_foodtruck.sprawdz_danie() RETURNS TRIGGER AS '
DECLARE
	fd RECORD;
	BEGIN
		SELECT * INTO fd FROM katalog_foodtruck.firma_danie WHERE id_dania=old.id_dania;
		IF NOT FOUND THEN
			DELETE FROM katalog_foodtruck.Danie WHERE id_dania=old.id_dania;
		END IF;
		RETURN NULL;
	END;
' LANGUAGE 'plpgsql';

CREATE TRIGGER sprawdzenie_dania AFTER DELETE ON katalog_foodtruck.firma_danie FOR EACH ROW EXECUTE PROCEDURE 
katalog_foodtruck.sprawdz_danie();


