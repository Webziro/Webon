-- db/add_slugs.sql
-- SQL migration to add and populate `slug` column in `news` (MySQL 8+ recommended)

-- 1) Add slug column (nullable for now)
ALTER TABLE `news` ADD COLUMN `slug` VARCHAR(255) DEFAULT NULL;

-- 2) Populate slug from title (MySQL 8+ with REGEXP_REPLACE)
UPDATE `news`
SET `slug` = TRIM(BOTH '-' FROM REGEXP_REPLACE(
    LOWER(REGEXP_REPLACE(`title`, '[^a-z0-9]+', '-')),
    '-+', '-'
));

-- 3) Make duplicates unique by appending id
UPDATE news n
JOIN (SELECT slug FROM news GROUP BY slug HAVING COUNT(*) > 1) d
  ON n.slug = d.slug
SET n.slug = CONCAT(n.slug, '-', n.id);

-- 4) Fallback for rows with NULL or empty slug
UPDATE news SET slug = CONCAT('post-', id) WHERE slug IS NULL OR slug = '';

-- 5) Add unique index (fails if duplicates still exist)
ALTER TABLE `news` ADD UNIQUE INDEX `uniq_slug` (`slug`);

-- 6) Make slug NOT NULL (optional)
ALTER TABLE `news` MODIFY `slug` VARCHAR(255) NOT NULL;

-- 7) Ensure views are at least 100 and set default
UPDATE news SET views = 100 WHERE views IS NULL OR views < 100;
ALTER TABLE news MODIFY `views` INT NOT NULL DEFAULT 100;
