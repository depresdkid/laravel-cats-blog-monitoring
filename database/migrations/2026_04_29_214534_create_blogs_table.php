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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('resource_id')->constrained()->onDelete('cascade');
            $table->string('identifier');
            $table->string('cat_name');
            $table->decimal('rating', 5, 2)->nullable();
            $table->integer('check_interval')->default(18000);
            $table->timestamp('last_sync_at')->nullable();
            $table->timestamps();

            $table->unique(['resource_id', 'identifier']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
