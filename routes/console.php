<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('cron:hourly', function () {
    try {
        // Instead of calling the URL, directly execute whatever logic your /api/cron endpoint would do
        // For example, if you have a controller method that handles this, call it directly:

        // Option 1: If you know the controller and method
        // app()->make(\App\Http\Controllers\CronController::class)->handleHourlyCron();

        // Option 2: Use the router to execute the route directly
        $request = Request::create('/api/cron', 'GET');
        $response = app()->handle($request);

        $this->info('Hourly cron job executed directly. Status: ' . $response->getStatusCode());
    } catch (\Exception $e) {
        $this->error('Exception occurred: ' . $e->getMessage());
    }
})->purpose('Execute hourly cron logic directly');

// Schedule the command to run every hour
Schedule::command('cron:hourly')->everyMinute();
