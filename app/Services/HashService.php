<?php

namespace App\Services;
use App\Models\Task;
use Hash;

class HashService
{
    protected $hash;

    public function __construct()
    {
        
    }

    
    public function crypt($task, int $curent_repetitions = 0)
    {
        if ($curent_repetitions <= (int)$task->repetitions) {
            $task->value = Hash::make($task->value);
            $task->repetition_repetitions = $curent_repetitions;
            $this->crypt($task,$curent_repetitions+1);
            
        }else{
            $task->save();
        }
    }


}