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
  public function up() {
    Schema::create('ripples', function (Blueprint $table) {
    /*
    the first two columns helps link this newly created message(ripple) to an older message IF the new message being recorded is replying an old message
    if not..the firt two columns will be null for that message
    */
    $table->uuid('ripple_reference_id')->nullable()->index();
    $table->uuid('rippler_reference_id')->nullable();
    
    //linker columns..help form links with other Models(tables)
    $table->text('encrypted_url')->index();//links the Ripple model to the Url model
    $table->uuid('rippler_id')->index(); //links the Ripple model to the User(rippler) model
    
    //Rippler details...the message details are actually stored here
    $table->uuid('ripple_id')->index(); //id of the ripple(message).. it's unique to every ripple(message)
    $table->integer('isQuote')->default(0);
    $table->string('ripple_body')->nullable();
    $table->text('ripple_attachments')->default('a:0:{}');
    $table->text('ripplers_tagged')->default('a:0:{}');
    $table->integer('ripple_likes_count')->default(0); //number of
    $table->integer('ripple_ripples_count')->default(0); //number of reply to a  ripple
    $table->integer('ripple_nest_level')->default(0); //store the nest level of the ripple
    $table->timestamps(); // Laravel timestamps (created_at and updated_at)

    // Add additional indexes
    /*
    $table->foreign('ripple_reference_id')
      ->references('ripple_id')
      ->on('ripples')
      ->onDelete('cascade') // Cascade on delete
      ->onUpdate('cascade'); // Cascade on update
    */
      
    $table->foreign('rippler_id')
      ->references('ripple_id')
      ->on('users')
      ->onDelete('cascade') // Cascade on delete
      ->onUpdate('cascade'); // Cascade on update

    $table->foreign('encrypted_url')
      ->references('encrypted_url')
      ->on('urls')
      ->onDelete('cascade') // Cascade on delete
      ->onUpdate('cascade'); // Cascade on update

    });
  }

    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down() {
      Schema::dropIfExists('ripples');
    }
  }

  ?>