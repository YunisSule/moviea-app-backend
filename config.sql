
-- Create view for movie genres
CREATE VIEW genres AS SELECT DISTINCT(genre) FROM title_genres;

-- Create view for regions
CREATE VIEW regions AS SELECT DISTINCT(region) FROM aliases

-- Create view for title types 
CREATE VIEW types AS SELECT DISTINCT(title_type) FROM titles

-- Create view for release years 
CREATE VIEW years AS SELECT DISTINCT(start_year) FROM titles;