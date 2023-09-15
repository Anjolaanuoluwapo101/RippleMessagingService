<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new Class extends Migration
{
    public function up()
    {
        Schema::table('ripples', function (Blueprint $table) {
            $table->integer('isQuote')->default(0);
        });
    }

    public function down()
    {
        Schema::table('ripples', function (Blueprint $table) {
            $table->dropColumn('isQuote');
        });
    }
}

?>