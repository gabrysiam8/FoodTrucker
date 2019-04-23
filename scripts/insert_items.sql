INSERT INTO katalog_foodtruck.Adres(miasto, kod_pocztowy, ulica, numer) VALUES ('Kraków', '30-065', 'Piastowska', 20);
INSERT INTO katalog_foodtruck.Adres(miasto, kod_pocztowy, ulica, numer) VALUES ('Kraków', '31-154', 'Pawia', 30);
INSERT INTO katalog_foodtruck.Adres(miasto, kod_pocztowy, ulica, numer) VALUES ('Kraków', '31-052', 'Dajwór', 21);

INSERT INTO katalog_foodtruck.Typ_kuchni(nazwa) VALUES ('wegetariańska/wegańska');
INSERT INTO katalog_foodtruck.Typ_kuchni(nazwa) VALUES ('amerykańska');
INSERT INTO katalog_foodtruck.Typ_kuchni(nazwa) VALUES ('meksykańska');
INSERT INTO katalog_foodtruck.Typ_kuchni(nazwa) VALUES ('francuska');
INSERT INTO katalog_foodtruck.Typ_kuchni(nazwa) VALUES ('belgijska');

INSERT INTO katalog_foodtruck.Foodpark(nazwa, id_adresu) VALUES ('Bezogródek', 1);
INSERT INTO katalog_foodtruck.Foodpark(nazwa, id_adresu) VALUES ('Dworek', 2);
INSERT INTO katalog_foodtruck.Foodpark(nazwa, id_adresu) VALUES ('Truckarnia', 3);

INSERT INTO katalog_foodtruck.Firma(nazwa, nip) VALUES ('Cubanos', '9671374471');
INSERT INTO katalog_foodtruck.Firma(nazwa, nip) VALUES ('Curry up!', '6272694327');
INSERT INTO katalog_foodtruck.Firma(nazwa, nip) VALUES ('Frytki belgijskie', '6762518678');

INSERT INTO katalog_foodtruck.Foodtruck(godzina_otwarcia, godzina_zamkniecia, id_foodparku, id_firmy) VALUES ('12:00', '21:45', 2, 1);
INSERT INTO katalog_foodtruck.Foodtruck(godzina_otwarcia, godzina_zamkniecia, id_foodparku, id_firmy, telefon) VALUES ('12:00', '21:00', 1, 2, '730775073');
INSERT INTO katalog_foodtruck.Foodtruck(godzina_otwarcia, godzina_zamkniecia, id_foodparku, id_firmy, telefon) VALUES ('12:00', '22:00', 1, 3, '694662868');
INSERT INTO katalog_foodtruck.Foodtruck(godzina_otwarcia, godzina_zamkniecia, id_foodparku, id_firmy, telefon) VALUES ('11:00', '21:00', 2, 3, '515055699');

INSERT INTO katalog_foodtruck.Danie(nazwa, id_typu_kuch) VALUES ('Duże frytki', 5);
INSERT INTO katalog_foodtruck.Danie(nazwa, id_typu_kuch) VALUES ('Małe frytki', 5);

INSERT INTO katalog_foodtruck.firma_danie(id_firmy, id_dania) VALUES (3, 1);
INSERT INTO katalog_foodtruck.firma_danie(id_firmy, id_dania) VALUES (3, 2);

INSERT INTO katalog_foodtruck.wydarzenie(nazwa, data, id_adresu) VALUES ('Wielkie otwarcie Bezogródek Food Truck Park', '2018-04-08', 1);

INSERT INTO katalog_foodtruck.promocja(rodzaj, start, koniec) VALUES ('Wszystkie pozycje w menu w cenie 20 zł', '2018-12-06', '2018-12-09');