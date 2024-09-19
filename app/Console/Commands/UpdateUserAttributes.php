<?php

namespace App\Console\Commands;

use Exception;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UpdateUserAttributes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:update-attributes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to update user attributes';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $chunkSize = 1000;

        /* 
            I suppose here the updated record will be 40000
            if the updated record will be > 50000 we can use a counter to count the batches
            and sleep for some duration after making 5 batch requests to avoid the rate limit
        */


        User::hasUpdated()->chunkById($chunkSize, function ($users) {    
            foreach ($users as $user) {
                try {

                    $payload = [
                        'batches' => [
                            [
                                'subscribers' => [
                                    'email' => $user->email,
                                    'name' => $user->name,
                                    'timezone' => $user->timezone,
                                ],
                            ],
                        ],
                    ];

                    //Make call to batch api with the paylod

                    Log::info("id :".$user->id." "." name: ".$user->name.", timezone: ".$user->timezone);

                    // Update the is_updated flag to false after processing
                    User::where('id', $user->id)->update(['is_updated' => false]);

                } catch (Exception $e) {
                    Log::error("error in updating user attributes ".$e->getMessage());
                }
            }
        });
    }
}
