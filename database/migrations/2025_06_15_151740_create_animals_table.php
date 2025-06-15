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
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique()->index();
            $table->string('type');
            $table->string('name');
            $table->boolean('is_male')->nullable();
            $table->string('breed')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->text('description')->nullable();
            $table->text('history')->nullable();
            $table->text('likes')->nullable();
            $table->text('dislikes')->nullable();
            $table->date('arrival_date')->nullable();
            $table->boolean('is_archived')->default(false);
            $table->date('archived_date')->nullable();
            $table->string('archive_cause')->nullable();
            $table->unsignedBigInteger('shelter_id')->nullable();
            $table->foreign('shelter_id')->references('id')->on('shelters')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animals');
    }
};
