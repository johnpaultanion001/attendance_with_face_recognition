<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestedDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requested_documents', function (Blueprint $table) {
            $table->id();
            $table->string('request_number');
            $table->string('user_id');
            $table->string('resident_id');
            $table->string('document_id');
            $table->date('claiming_date')->nullable();
            $table->float('amount_to_pay')->nullable();
            $table->longText('remarks')->nullable();
            $table->boolean('isRemove')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requested_documents');
    }
}
