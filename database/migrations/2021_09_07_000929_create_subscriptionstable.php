<?php

use App\Constants\Model;
use App\Constants\Subscription;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

const CASCADE = 'cascade';

class CreateSubscriptionsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Subscription::TABLE_NAME, function (Blueprint $table) {
            $table->bigIncrements(Model::ID);

            $table->foreignId(Subscription::USER_ID)
                ->constrained()
                ->onUpdate(CASCADE)
                ->onDelete(CASCADE);

            $table->integer(Subscription::TOTAL)->default(0);
            $table->string(Subscription::STATUS)->default();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(Subscription::TABLE_NAME);
    }
}
