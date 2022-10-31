# Backend

1. Load data
    - Start docker image with gdal
        ```bash
        docker run -it --rm --name gdal -v ./data:/home/data osgeo/gdal:latest
        ```
    - Load data
        ```bash
        $USER = 
        $DATABASE = 
        $PASSWORD =
        $HOSTNAME = 

        PGCLIENTENCODING=LATIN1 ogr2ogr -nln fcr_clean -f "PostgreSQL" PG:"host=$HOSTNAME user=$USER dbname=$DATABASE password=$PASSWORD" /home/data/fcr_clean.csv
        ```
2. Build docker image for backend (adds postgresql driver for php)
    ```bash
    docker build . -t php:apache-pg
    ```
3. Launch backend
    ```bash
    docker compose up -d
    ```
