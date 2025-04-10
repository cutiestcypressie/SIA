<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class OauthClientIdMigration extends Migration
{
    public function up()
    {
        // Delete existing clients
        DB::table('oauth_clients')->delete();
        
        // Reset auto-increment to 2
        DB::statement('ALTER TABLE oauth_clients AUTO_INCREMENT = 2');
        
        // Insert new client with ID 3
        DB::table('oauth_clients')->insert([
            'id' => 3,
            'name' => 'Lumen Client Credentials Client',
            'secret' => '$2y$10$your_secret_here', // You'll need to replace this with a proper secret
            'provider' => null,
            'redirect' => '',
            'personal_access_client' => 0,
            'password_client' => 0,
            'revoked' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down()
    {
        DB::table('oauth_clients')->where('id', 3)->delete();
    }
} 