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
            $table->uuid('ripple_reference_id')->index();
            $table->uuid('id')->primary();//id of the ripple(message)
            $table->uuid('rippler_id')->index();
            $table->string('rippler_name');// name of the owner of the message
            $table->string('rippler_email');
            $table->string('ripple_body')->default("");
            $table->text('ripple_attachments')->default("{}");
            $table->text('ripplers_tagged')->default("{}");
            $table->integer('ripple_likes_count');//number of 
            $table->integer('ripple_ripples_count');//number of reply to a  ripple
            $table->integer('ripple_nest_level');//store the nest level of the ripple
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