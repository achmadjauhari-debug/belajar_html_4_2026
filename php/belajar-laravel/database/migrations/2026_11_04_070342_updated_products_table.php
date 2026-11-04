<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'slug', 'brief_description', 'description')) {
                $table->dropColumn('slug', 'brief_description', 'description');
            }
            $table->string('slug')->nullable()->after('name')->unique();
            $table->text('price_art_cartoon')->nullable()->after('price');
            $table->text('price_art_paper')->nullable()->after('price_art_cartoon');
            $table->text('price_hvs')->nullable()->after('price_art_paper');
            $table->text('price_doft')->nullable()->after('price_hvs');
            $table->text('price_glossy')->nullable()->after('price_doft');
            $table->text('price_cutting')->nullable()->after('price_glossy');
            $table->text('price_no_cutting')->nullable()->after('price_cutting');
            $table->text('brief_description')->nullable()->after('price_no_cutting');
            $table->text('description')->nullable()->after('brief_description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
};
