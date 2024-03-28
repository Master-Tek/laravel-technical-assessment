<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTableAddPersonelInfoFields extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('firstName')->nullable();
            $table->string('lastName')->nullable();
            $table->text('address')->nullable(); // Using text type for longer addresses
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->date('dateOfBirth')->nullable(); // Date type for storing only the date
            $table->boolean('married')->default(false);
            $table->date('dateOfMarriage')->nullable(); // Date type for storing only the date
            $table->string('marriageCountry')->nullable();
            $table->boolean('widowed')->default(false);
            $table->boolean('marriedInPast')->default(false);
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'firstName',
                'lastName',
                'address',
                'city',
                'country',
                'dateOfBirth',
                'married',
                'dateOfMarriage',
                'marriageCountry',
                'widowed',
                'marriedInPast'
            ]);
        });
    }
}
