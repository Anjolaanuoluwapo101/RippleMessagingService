<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new Class extends Migration
{
    public function up()
    {
        Schema::table('ripples', function (Blueprint $table) {
            $table->foreign('ripple_reference_id')
                ->references('ripple_id')
                ->on('ripples')
                ->onDelete('cascade') // Cascade on delete
                ->onUpdate('cascade'); // Cascade on update
        });
    }

    public function down()
    {
        Schema::table('ripples', function (Blueprint $table) {
            $table->dropForeign(['rippler_reference_id']);
        });
    }
}
?>