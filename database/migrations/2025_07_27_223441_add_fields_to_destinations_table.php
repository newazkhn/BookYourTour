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
        Schema::table('destinations', function (Blueprint $table) {
            $table->decimal('price_from', 10, 2)->nullable()->after('image');
            $table->decimal('rating', 3, 2)->nullable()->after('price_from');
            $table->string('category')->nullable()->after('rating');
            $table->boolean('featured')->default(false)->after('category');
            $table->json('gallery')->nullable()->after('featured');
            $table->json('amenities')->nullable()->after('gallery');
            $table->string('duration')->nullable()->after('amenities');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('destinations', function (Blueprint $table) {
            $table->dropColumn([
                'price_from',
                'rating',
                'category',
                'featured',
                'gallery',
                'amenities',
                'duration'
            ]);
        });
    }
};
