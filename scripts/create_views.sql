CREATE OR REPLACE VIEW katalog_foodtruck.foodtruck_info AS SELECT t.id_foodtrucka, f.id_firmy, f.nazwa AS nazwa_f, 
						p.nazwa AS nazwa_p, a.miasto, a.ulica, a.numer, t.godzina_otwarcia, t.godzina_zamkniecia,
						t.telefon FROM katalog_foodtruck.firma f JOIN katalog_foodtruck.foodtruck t USING (id_firmy) 
						JOIN katalog_foodtruck.foodpark p USING(id_foodparku) JOIN katalog_foodtruck.adres a USING (id_adresu);

CREATE OR REPLACE VIEW katalog_foodtruck.firma_info AS SELECT f.id_firmy, f.nazwa AS nazwa_f, f.nip, f.ocena FROM katalog_foodtruck.firma f;

CREATE OR REPLACE VIEW katalog_foodtruck.foodpark_info AS SELECT p.id_foodparku, p.nazwa AS nazwa_p, a.miasto, a.ulica, a.numer 
						FROM katalog_foodtruck.foodpark p JOIN katalog_foodtruck.adres a USING(id_adresu);


