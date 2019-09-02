<?php

namespace App\Console\Commands;

use App\Models\Vehicle;
use Exception;
use Illuminate\Console\Command;

class CreateVehicle extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vehicle:create';

    /**
     * The console command description.
     *
     * @var string
     *
     *
     */
    protected $description = 'Create Vehicles';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Vehicle $vehicle)
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
        // Creating Vehicles
        $this->info('VehicleControllers Creation Started');
        try {
            factory(Vehicle::class,1)->create();
        } catch (Exception $exception) {
            $this->error($exception->getMessage());
            return 1;
        }


        $this->info('VehicleControllers Creation End');
    }
}
