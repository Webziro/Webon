-- upgrade_news_views.sql
-- Set existing news rows to have at least 100 views
-- Run this once in your database (phpMyAdmin or mysql CLI)

UPDATE news
SET views = 100
WHERE views < 100;
