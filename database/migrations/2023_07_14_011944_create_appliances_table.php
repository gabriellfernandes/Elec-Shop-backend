<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('appliances', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('image')->nullable();
            $table->integer('quantity')->default(0);
            $table->string('description');
            $table->string('marking');
            $table->string('voltage');
            $table->timestamps();
        });
    }

    public function down(): void
    {

        Schema::dropIfExists('appliances');
    }
};
