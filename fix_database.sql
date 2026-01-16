-- Fix Missing Columns in Database
-- Jalankan query ini di phpMyAdmin atau MySQL command line

-- Add 'title' column if it doesn't exist
ALTER TABLE site_content ADD COLUMN IF NOT EXISTS title VARCHAR(255) AFTER id;

-- Add 'description' column if it doesn't exist
ALTER TABLE site_content ADD COLUMN IF NOT EXISTS description TEXT AFTER title;

-- Verify columns
DESCRIBE site_content;
