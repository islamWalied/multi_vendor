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
        Schema::create('stores', function (Blueprint $table) {
//            $table->bigInteger('id')->unsigned()->autoIncrement()->primary();
//            $table->unsignedBigInteger()->autoIncrement()->primary();
//            $table->bigIncrements()->primary();
            $table->id();
            $table->string('name'); // varchar(255)
            $table->string('slug')->unique(); // to avoid knowing the store name by user
            $table->text('description')->nullable(); // in text, you did not determine the value of other than varchar
            $table->string('logo_image')->nullable();
            $table->string('cover_image')->nullable();
            $table->enum('status',['active','inactive'])->default('active');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};
