<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('urls', function (Blueprint $table) {
            $table->uuid('rippler_id');
            $table->text('url');//cant have the same url
            $table->text('encrypted_url')->primary();
            $table->timestamps();
             
             /*
            // Define foreign key constraint
            $table->foreign('rippler_id')
                ->references('rippler_id')
                ->on('users') // Assuming 'users' table is where 'rippler_id' references
                ->onDelete('cascade') // Optional: Specify the behavior on delete
                ->onUpdate('cascade'); // Optional: Specify the behavior on delete
              */
            // Other columns and constraints can be added here
        });
    }

    public function down()
    {
        Schema::dropIfExists('urls');
    }
}
?>