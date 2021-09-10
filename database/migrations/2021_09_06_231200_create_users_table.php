<?php

use App\Constants\Model;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Constants\User;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(User::TABLE_NAME, function (Blueprint $table) {
            $table->id();
            $table->string(User::NAME, 50);
            $table->string(User::EMAIL, 50)->unique();
            $table->string(User::CATEGORY, 20)->nullable();
            $table->string(User::UF, 2)->nullable();
            $table->string(User::CPF, 11)->nullable();
            $table->string(User::ADDRESS, 50)->nullable();
            $table->string(User::COMPANY, 50)->nullable();
            $table->string(User::PHONE, 20)->nullable();
            $table->string(User::TELEPHONE, 20)->nullable();
            $table->string(User::ROLE, 10)->default(User::ROLES[2]);
            $table->string(User::PASSWORD);
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
        Schema::dropIfExists(User::TABLE_NAME);
    }
}
