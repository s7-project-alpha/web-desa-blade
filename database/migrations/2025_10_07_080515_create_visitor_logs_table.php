<?php
// database/migrations/xxxx_xx_xx_create_visitor_logs_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('visitor_logs', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address', 45);
            $table->text('user_agent')->nullable();
            $table->string('page_url');
            $table->string('referer')->nullable();
            $table->string('device_type', 20)->nullable(); // mobile, desktop, tablet
            $table->string('browser', 50)->nullable();
            $table->string('platform', 50)->nullable();
            $table->date('visit_date');
            $table->timestamps();

            $table->index('ip_address');
            $table->index('visit_date');
            $table->index('created_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('visitor_logs');
    }
};
