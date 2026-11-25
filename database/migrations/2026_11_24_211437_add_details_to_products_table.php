<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->text('description')->nullable()->after('name');
            $table->boolean('has_sizes')->default(false)->after('stock');
            $table->json('sizes')->nullable()->after('has_sizes');
            $table->string('brand')->nullable()->after('image');
            $table->string('warranty')->nullable()->after('brand');
            $table->string('availability')->nullable()->after('warranty');
            $table->string('origin')->nullable()->after('availability');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'description',
                'has_sizes',
                'sizes',
                'brand',
                'warranty',
                'availability',
                'origin',
            ]);
        });
    }
};