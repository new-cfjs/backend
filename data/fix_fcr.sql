COPY fcr_clean(year, make, model, fuel_type, fuel_consumption_city, fuel_consumption_hwy, fuel_consumption_comb, co2_g_per_km)
FROM '/fixed_fcr_clean.csv'
DELIMITER ','
CSV HEADER;
