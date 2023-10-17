<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

final class CreateFeaturablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('featurables', function (Blueprint $table): void {
            $table->bigIncrements('id');
            $table->integer('feature_id');

            $table->integer('featurable_id');
            $table->string('featurable_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::drop('featurables');
    }
}
