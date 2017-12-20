<?php

declare(strict_types = 1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class RemoveExpiresDateFromPagesTable
 */
class RemoveExpiresDateFromPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('hc_pages', function (Blueprint $table) {
            $table->dropColumn('expires_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('hc_pages', function (Blueprint $table) {
            $table->timestamp('expires_at')->nullable();
        });
    }
}
