<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new Class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ripples', function (Blueprint $table) {
            $table->uuid('ripple_reference_id')->nullable()->index();
            $table->integer('rippler_reference_id')->nullable();
            $table->uuid('ripple_id')->primary();//id of the ripple(message)
            $table->uuid('rippler_id')->index();
            $table->string('rippler_name')->nullable();// name of the owner of the message
            $table->string('rippler_email');
            $table->string('ripple_body')->nullable();
            $table->text('ripple_attachments')->default('a:0:{}');
            $table->text('ripplers_tagged')->default('a:0:{}');
            $table->integer('ripple_likes_count')->default(0);//number of 
            $table->integer('ripple_ripples_count')->default(0);//number of reply to a  ripple
            $table->integer('ripple_nest_level')->default(0);//store the nest level of the ripple
            $table->timestamps(); // Laravel timestamps (created_at and updated_at)

            // Add additional indexes if needed
            // $table->index('another_column');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ripples');
    }
}

?>