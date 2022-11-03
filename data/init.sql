    CREATE TABLE mes_ges (
        session_id varchar,
        email varchar(255),
        dtg timestamp default now(),
        point_depart geometry,
        point_arrivee geometry,
        marque_vehicule varchar,
        modele_vehicule varchar,
        annee_vehicule integer,
        temps_auto double precision, -- secondes.
        temps_transport_commun double precision,
        temps_velo double precision,
        temps_marche double precision,
        distance_auto double precision, -- metres.
        distance_transport_commun double precision,
        distance_velo double precision,
        distance_marche double precision
    );

CREATE TABLE fcr_clean
(
    year varchar,
    make varchar,
    model varchar,
    fuel_type varchar,
    fuel_consumption_city varchar,
    fuel_consumption_hwy varchar,
    fuel_consumption_comb varchar,
    co2_g_per_km varchar
);

COPY fcr_clean(year, make, model, fuel_type, fuel_consumption_city, fuel_consumption_hwy, fuel_consumption_comb, co2_g_per_km)
FROM '/docker-entrypoint-initdb.d/fcr_clean.csv'
DELIMITER ','
CSV HEADER;