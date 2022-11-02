CREATE OR REPLACE
FUNCTION public.munic_s_intersects(
            z integer, x integer, y integer, lon double precision default -71.25, lat double precision default 46.83)
RETURNS bytea
AS $$
    WITH
    bounds AS (
      SELECT ST_TileEnvelope(z, x, y) AS geom
    ),
    mvtgeom AS (
      SELECT ST_AsMVTGeom(ST_Transform(m.geom, 3857), bounds.geom) AS geom,
        m.mus_nm_mun,
        count(*)
      FROM bounds, munic_s m
    Inner join mes_ges ON ST_Intersects(m.geom, ST_Transform(mes_ges.point_depart,4269))
    AND ST_Intersects(
        (select munic_s.geom from munic_s where ST_Intersects(munic_s.geom, ST_Transform(ST_SetSRID(ST_Point(lon, lat),4326),4269))), 
        ST_Transform(mes_ges.point_arrivee,4269))
	GROUP BY m.geom, m.mus_nm_mun, bounds.geom
    )
    SELECT ST_AsMVT(mvtgeom, 'public.munic_s') FROM mvtgeom;
$$
LANGUAGE 'sql'
STABLE
PARALLEL SAFE;