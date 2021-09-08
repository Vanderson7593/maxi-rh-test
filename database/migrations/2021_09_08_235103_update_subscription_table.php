<?php

use App\Constants\Model;
use App\Constants\Subscription;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateSubscriptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(Subscription::TABLE_NAME, function (Blueprint $table) {
            $table->string(Subscription::STATUS)->default(Subscription::STATUS_MAP[1])->change();
            $table->boolean(Model::IS_DELETED)->default(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
