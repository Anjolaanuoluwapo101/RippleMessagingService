<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('rippler_information', function (Blueprint $table) {
            $table->uuid('rippler_id')->index();
            $table->text('rippler_name');
            $table->text('rippler_email');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rippler_information');
    }
};

?>