<?php

declare(strict_types = 1);

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class RemovePublishDatesFromPagesTranslationsTable
 */
class RemovePublishDatesFromPagesTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('hc_pages_translations', function (Blueprint $table) {
            $table->dropColumn(['publish_at', 'expires_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('hc_pages_translations', function (Blueprint $table) {
            $table->timestamp('publish_at')->useCurrent();
            $table->timestamp('expires_at')->nullable();
        });
    }
}
