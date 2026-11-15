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
        Schema::create('template_header_repeater_fields', function (Blueprint $table) {
            $table->id('id_header_repeater_field');
            $table->unsignedBigInteger('id_template_header');
            $table->foreign('id_template_header')
                ->references('id_template_header')
                ->on('template_header_sections')
                ->cascadeOnDelete();
            $table->string('label', 255);
            $table->string('name', 100);
            $table->enum('type', [
                'text',
                'textarea',
                'date',
                'number',
                'email',
                'url',
                'richtext',
            ]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('template_header_repeater_fields');
    }
};
