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
    Schema::create('template_header_sections', function (Blueprint $table) {
        $table->id('id_template_header');
        $table->string('title', 255);
        $table->enum('type', [
            'text',
            'textarea',
            'repeater',
            'list',
            'richtext',
        ]);
        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('template_header_sections');
    }
};
