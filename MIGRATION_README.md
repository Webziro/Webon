Slug + Views Migration
=======================

This project includes two options to add and populate a `slug` column on the `news` table and set `views` minimum/default to 100.

IMPORTANT: BACK UP YOUR DATABASE BEFORE RUNNING ANY MIGRATION.

Options
-------
1) Run SQL directly (MySQL 8+ recommended)
   - File: `db/add_slugs.sql`
   - Use phpMyAdmin or mysql CLI to run this SQL.

   Example (PowerShell):
   ```powershell
   mysql -u DB_USER -p DB_NAME < db\add_slugs.sql
   ```

2) Run PHP migration script (works with any MySQL version and uses project helpers)
   - File: `scripts/add_slugs.php`
   - This script will create the `slug` column (if missing), populate slugs using `webon_create_slug()`, add a unique index (if possible), and set views to at least 100.

   Example (PowerShell):
   ```powershell
   php .\scripts\add_slugs.php
   ```

Pre-checks
----------
- Ensure `includes/config.php` has correct DB connection settings (it normally does if the app is running).
- Backup:
  ```powershell
  mysqldump -u DB_USER -p DB_NAME > C:\path\to\backup.sql
  ```

Verification
------------
- Check duplicates (should be zero rows):
  ```sql
  SELECT slug, COUNT(*) c FROM news GROUP BY slug HAVING c > 1;
  ```
- Inspect some rows:
  ```sql
  SELECT id, title, slug, views FROM news ORDER BY id DESC LIMIT 20;
  ```
- Test a slug URL in your browser e.g.:
  http://localhost/webonTech/blog-details.php/some-slug

If you run into any errors, paste the error text here and I will help fix it.
