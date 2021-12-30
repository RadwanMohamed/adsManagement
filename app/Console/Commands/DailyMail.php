<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Traits\Sender;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DailyMail extends Command
{
    use Sender;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily:mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'reminder to advertiser';

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
        $users = User::whereHas("ads" , function($q){
          return  $q->whereBetween("start_date",[Carbon::tomorrow()->startOfDay(),Carbon::tomorrow()->endOfDay()]);
        })->get();
        foreach ($users as $user){
            $this->sendEmail($user->email,"simulation email message","subject");
        }
        return 0;
    }
}
