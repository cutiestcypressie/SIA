<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CleanupOAuthClients extends Command
{
    protected $signature = 'oauth:cleanup';
    protected $description = 'Delete all OAuth clients except client 1';

    public function handle()
    {
        // Delete all clients except client 1
        $deleted = DB::table('oauth_clients')->where('id', '>', 1)->delete();
        
        // Delete related access tokens
        DB::table('oauth_access_tokens')->whereNotIn('client_id', [1])->delete();
        
        $this->info("Deleted {$deleted} clients and their tokens. Only client 1 remains.");
    }
} 