<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('notifications')) {
            return;
        }

        if (!Schema::hasColumn('notifications', 'user_id')) {
            Schema::table('notifications', function (Blueprint $table) {
                $table->foreignId('user_id')->nullable()->after('id')->constrained()->onDelete('cascade');
            });
        }

        if (!Schema::hasColumn('notifications', 'related_review_id')) {
            Schema::table('notifications', function (Blueprint $table) {
                $table->foreignId('related_review_id')->nullable()->after('type')->constrained('reviews')->onDelete('cascade');
            });
        }

        if (!Schema::hasColumn('notifications', 'read_at')) {
            Schema::table('notifications', function (Blueprint $table) {
                $table->timestamp('read_at')->nullable()->after('is_read');
            });
        }

        if (Schema::hasColumn('notifications', 'user_id') && Schema::hasColumn('users', 'role')) {
            $adminId = DB::table('users')->where('role', 'admin')->value('id');

            if ($adminId) {
                DB::table('notifications')
                    ->whereNull('user_id')
                    ->update(['user_id' => $adminId]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!Schema::hasTable('notifications')) {
            return;
        }

        Schema::table('notifications', function (Blueprint $table) {
            if (Schema::hasColumn('notifications', 'read_at')) {
                $table->dropColumn('read_at');
            }

            if (Schema::hasColumn('notifications', 'related_review_id')) {
                $table->dropForeign(['related_review_id']);
                $table->dropColumn('related_review_id');
            }

            if (Schema::hasColumn('notifications', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }
        });
    }
};