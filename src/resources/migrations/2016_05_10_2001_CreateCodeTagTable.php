<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migration\Migration;

class CreateCodeTagTable {

    public function up() {
        Schema::create('codepress_tags', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->nullable(true)->unsigned();
            $table->foreign('parent_id')->references('id')->on('codepress_tags');
            $table->string('name');
            $table->integer('taggable_id')->nullable();
            $table->string('taggable_type')->nullable();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::drop('codepress_tags');
    }

}
