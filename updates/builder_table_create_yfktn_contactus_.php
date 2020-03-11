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
            $table->string('website')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('yfktn_contactus_');
    }
}
