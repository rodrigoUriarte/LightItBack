<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tokens', function (Blueprint $table) {
            // Table properties.
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';

            // Columns.
            $table->id();
            $table->foreignId('user_id');
            $table->string('token', 150);
            $table->timestamp('expires_at')->nullable();

            // Timestamps.
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();

            // Indexes.
            $table->unique('user_id');
            $table->index('token');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tokens');
    }
}
