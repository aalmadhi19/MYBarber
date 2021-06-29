<?php

use App\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('password');
            $table->boolean('blocked')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
        User::create([
            'id' => 1,
            'name'  => 'Admin',
            'email' => 'admin@admin.com',
            'phone'  => '0570807590',
            'password' => Hash::make('12345678'),
            'blocked'  => '0',
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
