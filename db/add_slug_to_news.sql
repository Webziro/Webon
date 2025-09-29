-- add_slug_to_news.sql
-- Adds a 'slug' column to the news table and populates it for existing rows.

ALTER TABLE news
ADD COLUMN slug VARCHAR(255) NULL;

-- Populate slug for existing rows using a safe transliteration via PHP is preferable,
-- but if you want to do it in SQL, here's a simple approach that uses the title
-- and appends id to ensure uniqueness. Adjust as needed.

UPDATE news
SET slug = CONCAT(
    LOWER(REPLACE(REPLACE(REPLACE(title, ' ', '-'), "'", ''), '"', '')),
    '-', id
)
WHERE slug IS NULL OR slug = '';

-- Add unique index
ALTER TABLE news
ADD UNIQUE KEY uk_news_slug (slug);
