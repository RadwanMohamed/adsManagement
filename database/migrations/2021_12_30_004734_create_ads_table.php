<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use \App\Models\Ads;
class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->text("description");
            $table->string("advertiser");
            $table->dateTime("start_date");
            $table->enum("type",Ads::getAvailableTypes());
            $table->unsignedBigInteger("category_id");
            $table->timestamps();

            $table->foreign("category_id")
                  ->references("id")
                  ->on("categories")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ads');
    }
}
