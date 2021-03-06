<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign(['note_id']);
            $table->dropColumn('note_id');
            $table->string('commentable_type');
            $table->integer('commentable_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->integer('note_id');
            $table->dropColumn('commentable_type');
            $table->dropColumn('commentable_id');

            $table->foreign('note_id')
                ->references('id')->on('notes');
        });
    }
}
