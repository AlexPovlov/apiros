<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Bus\Batchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CryptTaskJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $timeout = 300;
    protected $cryptor;
    protected $task;
    
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($cryptor,$task)
    {
        $this->cryptor = $cryptor;
        $this->task = $task;
       
        
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->task->job()->associate($this->job->getJobId());
        echo "Started crypt with job ID:" . $this->job->getJobId() . "\n";
        $this->task->save();
        $this->cryptor->crypt($this->task);
    }
}
