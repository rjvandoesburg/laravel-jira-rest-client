<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJiraOAuthTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
         array:5 [▼
  "oauth_token" => "QlRWtdv5dYnMwrrqTl8RQYPuU0FvavZQ"
  "oauth_token_secret" => "kcOJzzbn6uuQmljLbVDN7Iyevn43cUNE"
  "oauth_expires_in" => "157680000"
  "oauth_session_handle" => "sqsPzhsYKE81ZO7L9Px4NaLUldgammvk"
  "oauth_authorization_expires_in" => "160272000"
]
         */
        Schema::create('jira_oauth_tokens', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->string('oauth_token');
            $table->string('oauth_token_secret');
            $table->string('oauth_expires_in');
            $table->string('oauth_session_handle');
            $table->string('oauth_authorization_expires_in');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jira_oauth_tokens');
    }
}
