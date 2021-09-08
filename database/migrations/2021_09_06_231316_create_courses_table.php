<?php

use App\Constants\Course;
use App\Constants\Model;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Course::TABLE_NAME, function (Blueprint $table) {
            $table->id();
            $table->string(Course::NAME);
            $table->string(Course::DESCRIPTION);
            $table->integer(Course::VALUE)->default(0);
            $table->integer(Course::MAX_SUB);
            $table->date(Course::SUB_START_DATE);
            $table->date(Course::SUB_END_DATE);
            $table->string(Course::FILE)->nullable();
            $table->boolean(Model::IS_DELETED)->default(false);
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
        Schema::dropIfExists(Course::TABLE_NAME);
    }
}
