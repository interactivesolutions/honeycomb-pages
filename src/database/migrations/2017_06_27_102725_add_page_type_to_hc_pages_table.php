<?php

declare(strict_types = 1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class AddPageTypeToHcPagesTable
 */
class AddPageTypeToHcPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('hc_pages', function (Blueprint $table) {
            $table->enum('type', ['PAGE', 'ARTICLE'])->nullable();
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
            $table->dropColumn('type');
        });
    }
}
