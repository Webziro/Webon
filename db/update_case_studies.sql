-- Updated SQL for case_studies table with new fields
CREATE TABLE `case_studies` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `description` TEXT NOT NULL,
  `image` VARCHAR(255) NOT NULL,
  `challenges_title` VARCHAR(255),
  `challenges_description` TEXT,
  `challenges_points` VARCHAR(255),
  `solution_title` VARCHAR(255),
  `solution_description` TEXT,
  `solution_points` VARCHAR(255),
  `solution_image` VARCHAR(255),
  `score_points` VARCHAR(255),
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- For existing table, use this ALTER TABLE statement:
-- ALTER TABLE `case_studies`
--   ADD COLUMN `challenges_title` VARCHAR(255),
--   ADD COLUMN `challenges_description` TEXT,
--   ADD COLUMN `challenges_points` VARCHAR(255),
--   ADD COLUMN `solution_title` VARCHAR(255),
--   ADD COLUMN `solution_description` TEXT,
--   ADD COLUMN `solution_points` VARCHAR(255),
--   ADD COLUMN `solution_image` VARCHAR(255),
--   ADD COLUMN `score_points` VARCHAR(255);

-- SQL for case_studies table
