<?php

declare(strict_types = 1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class MakeNullableAuthorIdInHcPages
 */
class MakeNullableAuthorIdInHcPages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('hc_pages', function (Blueprint $table) {
            $table->string('author_id', 36)->nullable()->change();
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
            $table->string('author_id', 36)->nullable(false)->change();
        });
    }
}
