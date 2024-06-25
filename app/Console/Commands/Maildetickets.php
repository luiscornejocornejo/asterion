<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;

class MailTickets extends Command
{
    protected $signature = 'ma:mailtickets';
    protected $description = 'Descripción del comando';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Lógica del comando
    }
}
