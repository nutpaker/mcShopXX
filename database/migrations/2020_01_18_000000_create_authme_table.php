<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthmeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create Table
        Schema::create('authme', function (Blueprint $table) {
            //Default for Authme plugin
            $table->bigIncrements('id');
            $table->string('username')->unique();
            $table->string('realname');
            $table->string('password')->collation('ascii_bin');
            $table->string('lastlogin', 40)->collation('ascii_bin')->nullable();
            $table->string('ip', 40)->collation('ascii_bin')->nullable();
            $table->double('x')->nullable();
            $table->double('y')->nullable();
            $table->double('z')->nullable();
            $table->string('world')->nullable();
            $table->bigInteger('regdate')->nullable();
            $table->string('regip', 40)->collation('ascii_bin')->nullable();
            $table->float('yaw')->nullable();
            $table->float('pitch')->nullable();
            $table->string('email')->nullable();
            $table->smallInteger('isLogged')->default(0);
            $table->smallInteger('hasSession')->nullable();

            // For Laravel
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();

            // For Web
            $table->smallInteger('is_admin')->default(0)->comment("0->player,1->admin,other...");
            $table->float('points')->default(0.00)->comment('จำนวนเงิน');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('authme');
    }
}
