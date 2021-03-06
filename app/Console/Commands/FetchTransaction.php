<?php

namespace App\Console\Commands;

use App\Http\Controllers\Traits\GameSpark;
use Illuminate\Console\Command;

class FetchTransaction extends Command
{
    use GameSpark;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gamespark:fetchtransaction';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch transactions from GameSpark';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $this->fetchTransactionList();
    }
}
