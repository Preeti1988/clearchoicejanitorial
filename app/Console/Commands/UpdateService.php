<?php

namespace App\Console\Commands;

use App\Models\Service;
use Illuminate\Console\Command;

class UpdateService extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'services:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $services = Service::whereDate("scheduled_end_date", "<", now())->get();
        foreach ($services as $item) {
            $item->status = "completed";
            $item->save();
        }
    }
}
