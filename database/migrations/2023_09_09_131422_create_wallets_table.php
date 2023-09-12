<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('natural_id')->nullable()->references('id')->on('naturals');
            $table->foreignId('shopkeeper_id')->nullable()->references('id')->on('shopkeepers');
            $table->float('balance')->default(0);
            $table->timestamps();

        });

        DB::statement('ALTER TABLE wallets ADD CONSTRAINT parent_control_check
            CHECK ((natural_id IS NOT NULL AND shopkeeper_id IS NULL)
                       OR (natural_id IS NULL AND shopkeeper_id IS NOT NULL))');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallets');
    }
};
