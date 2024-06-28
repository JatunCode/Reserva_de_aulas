<?php

namespace App\Console\Commands;

use App\Http\Controllers\scripts\Automatizacion;
use Illuminate\Console\Command;

class Actualizacion extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:auto';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Hace la automatizacion de actualizacion de solicitudes.';

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
     * @return int
     */
    public function handle()
    {
        $automatizacion = new Automatizacion();
        $automatizacion->updateAll();
        return 0;
    }
}
