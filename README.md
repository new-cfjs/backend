# Backend

1. Build docker image for backend (adds postgresql driver for php)
    ```bash
    docker build . -t php:apache-pg
    ```
2. Launch backend
    ```bash
    docker compose up -d
    ```
3. Charger les polygones des arrondissements, villes et mrc. Il faut télécharger les shapefiles et les extraire dans le dossier exposé à docker-gdal a l'étape 1: https://www.donneesquebec.ca/recherche/dataset/decoupages-administratifs# Les données de polygones sont utilisés pour l'analyses des données collectés.
    ```bash
    ogr2ogr -nlt PROMOTE_TO_MULTI -f "PostgreSQL" PG:"host=$HOSTNAME user=$USER dbname=$DATABASE password=$PASSWORD" /home/opendata/quebec/decoupage-administratif/SHP/arron_s.shp
    ogr2ogr -nlt PROMOTE_TO_MULTI -f "PostgreSQL" PG:"host=$HOSTNAME user=$USER dbname=$DATABASE password=$PASSWORD" /home/opendata/quebec/decoupage-administratif/SHP/munic_s.shp
    ogr2ogr -nlt PROMOTE_TO_MULTI -f "PostgreSQL" PG:"host=$HOSTNAME user=$USER dbname=$DATABASE password=$PASSWORD" /home/opendata/quebec/decoupage-administratif/SHP/mrc_s.shp
    ```
    ```sql
    ALTER TABLE mrc_s ALTER COLUMN mrs_co_mrc TYPE integer USING mrs_co_mrc::integer;
    ```
