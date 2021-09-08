<?php

use App\Constants\CourseSubscription;
use App\Constants\Subscription;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseSubscriptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(CourseSubscription::TABLE_NAME, function (Blueprint $table) {

            $table->foreignId(CourseSubscription::SUBSCRIPTION_ID)
                ->constrained()
                ->onUpdate(CASCADE)
                ->onDelete(CASCADE);

            $table->foreignId(CourseSubscription::COURSE_ID)
                ->constrained()
                ->onUpdate(CASCADE)
                ->onDelete(CASCADE);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(CourseSubscription::TABLE_NAME);
    }
}
