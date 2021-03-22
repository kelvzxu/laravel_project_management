<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Http\Controllers\MailController;
use Illuminate\Console\Command;

class SendNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:tasknotification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a daily email to all users with task notification';

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
        $results = User::with('tasks','tasks.project')->get();
        foreach( $results as $result){
            if ( count($result->tasks) != 0){
                app(MailController::class)->SendNotificationEmail($result);
            }
        }
    }
}
