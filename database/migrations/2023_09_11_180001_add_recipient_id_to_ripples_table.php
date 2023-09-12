<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new Class extends Migration
{
    public function up()
    {
        Schema::table('ripples', function (Blueprint $table) {
            $table->integer('rippler_reference_id')->after('ripple_recipient_id')->default(0);
        });
    }

    public function down()
    {
        Schema::table('ripples', function (Blueprint $table) {
            $table->dropColumn('rippler_reference_id');
        });
    }
}

?>