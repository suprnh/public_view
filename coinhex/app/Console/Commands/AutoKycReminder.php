<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Mail;

class AutoKycReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'AutoKycReminder:AutoKycReminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto Kyc Reminder ran successfully';

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
	   $query = "SELECT u.ID,u.email,u.full_name FROM contribution AS c  JOIN users AS u ON c.submitted_by=u.ID  where u.status='1' AND u.role_id='2' AND NOT EXISTS (SELECT * FROM kyc AS k WHERE k.user_id = u.ID AND k.latest_one='1' AND k.status!='2') GROUP BY u.ID";
	   $result = DB::select($query);
	   if(!empty($result) && count($result)){
		   foreach($result as $res){
			   $email = $res->email;
			   $data = array('email'=>$email,'name'=>$res->full_name);
			   Mail::send('mail.kyc-reminder', $data, function ($message) use ($data) {
					$message->from('support1@tapendra.com', 'P2P');
					$message->to($data['email'], $data['email'])->subject('P2P - AML/KYC Reminder');
			   });
				 
		   }
	   }
		$this->info('Auto Kyc Reminder ran successfully!');
    }
}
