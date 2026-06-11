<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // For SQLite: we need to recreate the table because SQLite doesn't support
        // ALTER COLUMN for CHECK constraints. We'll use a temporary table approach.
        
        // Step 1: Create temporary table with new schema
        DB::statement('CREATE TABLE reviews_new (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            user_id INTEGER NOT NULL,
            product_id INTEGER NOT NULL,
            rating INTEGER NOT NULL,
            comment TEXT,
            status VARCHAR(20) NOT NULL DEFAULT \'published\' CHECK(status IN (\'published\', \'hidden\')),
            admin_response TEXT,
            reviewed_at TIMESTAMP,
            created_at TIMESTAMP,
            updated_at TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
            FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
        )');

        // Step 2: Copy data, converting statuses
        DB::statement("INSERT INTO reviews_new (id, user_id, product_id, rating, comment, status, admin_response, reviewed_at, created_at, updated_at)
            SELECT id, user_id, product_id, rating, comment,
                CASE 
                    WHEN status = 'approved' THEN 'published'
                    WHEN status = 'pending' THEN 'published'
                    WHEN status = 'rejected' THEN 'hidden'
                    ELSE 'published'
                END,
                admin_response, reviewed_at, created_at, updated_at
            FROM reviews");

        // Step 3: Drop old table and rename new one
        DB::statement('DROP TABLE reviews');
        DB::statement('ALTER TABLE reviews_new RENAME TO reviews');
    }

    public function down(): void
    {
        DB::statement('CREATE TABLE reviews_old (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            user_id INTEGER NOT NULL,
            product_id INTEGER NOT NULL,
            rating INTEGER NOT NULL,
            comment TEXT,
            status VARCHAR(20) NOT NULL DEFAULT \'pending\' CHECK(status IN (\'pending\', \'approved\', \'rejected\')),
            admin_response TEXT,
            reviewed_at TIMESTAMP,
            created_at TIMESTAMP,
            updated_at TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
            FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
        )');

        DB::statement("INSERT INTO reviews_old (id, user_id, product_id, rating, comment, status, admin_response, reviewed_at, created_at, updated_at)
            SELECT id, user_id, product_id, rating, comment,
                CASE 
                    WHEN status = 'published' THEN 'approved'
                    WHEN status = 'hidden' THEN 'rejected'
                    ELSE 'pending'
                END,
                admin_response, reviewed_at, created_at, updated_at
            FROM reviews");

        DB::statement('DROP TABLE reviews');
        DB::statement('ALTER TABLE reviews_old RENAME TO reviews');
    }
};
