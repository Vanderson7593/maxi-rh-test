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
            $table->string(User::NAME);
            $table->string(User::EMAIL)->unique();
            $table->string(User::CATEGORY)->nullable();
            $table->string(User::UF)->nullable();
            $table->string(User::CPF)->nullable();
            $table->string(User::ADDRESS)->nullable();
            $table->string(User::COMPANY)->nullable();
            $table->string(User::PHONE)->nullable();
            $table->string(User::TELEPHONE)->nullable();
            $table->string(User::ROLE)->default(User::ROLES[2]);
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
