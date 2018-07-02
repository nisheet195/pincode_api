<?php

namespace App\Console\Commands;

use App\Model\Pincode;
use Illuminate\Console\Command;

class ExtractData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'extract:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Extract data from external database';

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
        $model = new Pincode;
        $model->populateDatabase();
    }
}
