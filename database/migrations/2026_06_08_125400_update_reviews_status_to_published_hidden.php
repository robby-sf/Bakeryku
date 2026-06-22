<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Update status values: approved/pending -> published, rejected -> hidden
        DB::table('reviews')
            ->whereIn('status', ['approved', 'pending'])
            ->update(['status' => 'published']);

        DB::table('reviews')
            ->where('status', 'rejected')
            ->update(['status' => 'hidden']);

        // Update any remaining unexpected status values to 'published'
        DB::table('reviews')
            ->whereNotIn('status', ['published', 'hidden'])
            ->update(['status' => 'published']);

        // Change the column default
        Schema::table('reviews', function (Blueprint $table) {
            $table->string('status', 20)->default('published')->change();
        });
    }

    public function down(): void
    {
        // Reverse: published -> approved, hidden -> rejected
        DB::table('reviews')
            ->where('status', 'published')
            ->update(['status' => 'approved']);

        DB::table('reviews')
            ->where('status', 'hidden')
            ->update(['status' => 'rejected']);

        // Update any remaining unexpected status values to 'pending'
        DB::table('reviews')
            ->whereNotIn('status', ['approved', 'rejected'])
            ->update(['status' => 'pending']);

        // Change the column default back
        Schema::table('reviews', function (Blueprint $table) {
            $table->string('status', 20)->default('pending')->change();
        });
    }
};
