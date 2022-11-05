# Backend

1. Build docker image for backend (adds postgresql driver for php)
    ```bash
    docker build . -t php:apache-pg
    ```
2. Launch backend
    ```bash
    docker compose up -d
    ```
3. Load data from : 
- https://www.donneesquebec.ca/recherche/dataset/decoupages-administratifs# 
- https://www.donneesquebec.ca/recherche/dataset/vque_9#

From another host with pre-requisite postgis, execute:

    ```bash
    shp2pgsql -s 4269 backend/data/large-files/decoupage_administratif/munic_s | psql -h localhost -p 5433 -U postgres -d opendata
    shp2pgsql -s 4269 backend/data/large-files/decoupage_administratif/arron_s | psql -h localhost -p 5433 -U postgres -d opendata
    shp2pgsql -s 4326 backend/data/large-files/vdq-quartier/vdq-quartier | psql -h localhost -p 5433 -U postgres -d opendata

    ```
insert into munic_s(mus_nm_mun, geom) Select nom, ST_Force2d(st_transform(geom,4269)) from vdq_quartier;
delete from munic_s where mus_nm_mun like 'Québec';



4. Create the sql function in the database so that the Analysis dashboard can query the database.



