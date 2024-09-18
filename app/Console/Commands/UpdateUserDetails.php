<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class UpdateUserDetails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update user name and timezone randomly';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        /*
            In the test, i have to update the user firstname and lastname, these fields are not found in the user model
            and there is no order to create these fields i just used name instead because need more details on this matter
        */

        $timezones = ['CET', 'CST', 'GMT+1'];

        User::all()->each(function ($user) use ($timezones) {
            $user->update([
                'name' => fake()->name,
                'timezone' => fake()->randomElement($timezones),
            ]);
        });

        $this->info('Users name and timezone successfully!');
    }
}
