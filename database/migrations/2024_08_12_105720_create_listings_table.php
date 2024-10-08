<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key to the users table
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); // Foreign key to the categories table
            $table->string('title');
            $table->string('logo')->nullable();
            $table->string('tags');
            $table->date('expiry_date')->nullable();
            $table->string('status')->default('active');
            $table->string('company');
            $table->string('location');
            $table->string('email');
            $table->string('website');
            $table->string('job_type'); // Added
            $table->string('salary_type'); // Added
            $table->decimal('min_salary', 10, 2)->nullable(); // Added
            $table->decimal('max_salary', 10, 2)->nullable(); // Added
            $table->string('experience'); // Added
            $table->string('city'); // Added
            $table->string('state'); // Added
            $table->string('country'); // Added
            $table->longText('description');
            $table->timestamps(); // Created at and Updated at columns
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('listings');
    }
};
