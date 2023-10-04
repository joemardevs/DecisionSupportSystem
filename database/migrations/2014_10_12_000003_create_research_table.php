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
        Schema::create('research', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('department_id');
            $table->string('title');
            $table->unsignedBigInteger('status_id');
            $table->string('venue')
                ->nullable();
            $table->date('date_presented')
                ->nullable();
            $table->string('organizer')
                ->nullable();
            $table->string('journal_name')
                ->nullable();
            $table->string('issn')
                ->nullable();
            $table->string('vol')
                ->nullable();
            $table->string('country')
                ->nullable();
            $table->date('date_completed')
                ->nullable();
            $table->date('date_issued')
                ->nullable();
            $table->string('reg_number')
                ->nullable();
            $table->timestamps();

            $table->foreign('department_id')
                ->references('id')
                ->on('departments');
            $table->foreign('status_id')
                ->references('id')
                ->on('statuses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('research');
    }
};
