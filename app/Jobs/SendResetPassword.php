<?php

namespace App\Jobs;

use App\Mail\SendForgotPassword;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

// Facades Email
use Illuminate\Support\Facades\Mail;


class SendResetPassword implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;
    protected $email;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data, $email)
    {
        //
        $this->data = $data;
        $this->email = $email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        Mail::to($this->email)->queue(new SendForgotPassword($this->data));
    }


}
