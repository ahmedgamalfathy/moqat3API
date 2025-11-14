<?php

use App\Enums\Media\MediaType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {// path , type , category
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->string('path');
            $table->tinyInteger('type')->default(MediaType::PHOTO->value);
            $table->string('category')->nullable();//avatar , device
            $table->foreignId('slider_id')->nullable()->constrained('sliders')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
