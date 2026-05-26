<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $hadVisitorId = Schema::hasColumn('page_visits', 'visitor_id');

        Schema::table('page_visits', function (Blueprint $table) {
            if (! Schema::hasColumn('page_visits', 'visitor_id')) {
                $table->string('visitor_id', 80)->nullable()->after('product_id');
            }

            if (! Schema::hasColumn('page_visits', 'visit_date')) {
                $table->date('visit_date')->nullable()->after('user_agent');
            }
        });

        DB::table('page_visits')
            ->whereNull('visitor_id')
            ->orderBy('id')
            ->chunkById(500, function ($visits) {
                foreach ($visits as $visit) {
                    DB::table('page_visits')
                        ->where('id', $visit->id)
                        ->update([
                            'visitor_id' => $visit->user_id ? 'user-' . $visit->user_id : 'legacy-' . $visit->id,
                            'visit_date' => $visit->created_at ? substr((string) $visit->created_at, 0, 10) : now()->toDateString(),
                        ]);
                }
            });

        if (! $hadVisitorId) {
            Schema::table('page_visits', function (Blueprint $table) {
                $table->index(['visitor_id', 'created_at']);
                $table->index(['visitor_id', 'visit_date']);
            });
        }
    }

    public function down(): void
    {
        Schema::table('page_visits', function (Blueprint $table) {
            if (Schema::hasColumn('page_visits', 'visitor_id')) {
                $table->dropIndex(['visitor_id', 'created_at']);
                $table->dropIndex(['visitor_id', 'visit_date']);
                $table->dropColumn('visitor_id');
            }

            if (Schema::hasColumn('page_visits', 'visit_date')) {
                $table->dropColumn('visit_date');
            }
        });
    }
};
