# Backend

1. Build docker image for backend (adds postgresql driver for php)
    ```bash
    docker build . -t php:apache-pg
    ```
2. Launch backend
    ```bash
    docker compose up -d
    ```
3. Load data from : https://www.donneesquebec.ca/recherche/dataset/decoupages-administratifs# 

From another host with pre-requisite postgis, execute:

    ```bash
    shp2pgsql -s 4269 backend/data/large-files/decoupage_administratif/munic_s | psql -h 172.22.65.48 -p 5433 -U postgres -d opendata
    shp2pgsql -s 4269 backend/data/large-files/decoupage_administratif/arron_s | psql -h 172.22.65.48 -p 5433 -U postgres -d opendata
    ```

4. Create the sql function in the database so that the Analysis dashboard can query the database.



