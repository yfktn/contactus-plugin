<?php namespace yfktn\ContactUs\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateYfktnContactus extends Migration
{
    public function up()
    {
        Schema::create('yfktn_contactus_', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->text('comment');
            $table->string('author');
            $table->string('email');
            $table->string('ip')->nullable();
            $table->string('website')->nullable();
            $table->tinyInteger('flagged')->nullable()->default(0)->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('yfktn_contactus_');
    }
}