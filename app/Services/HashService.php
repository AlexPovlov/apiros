<?php

namespace App\Services;
use App\Models\Task;
use Hash;

class HashService
{
    protected $hash;
    protected $task;

    public function __construct()
    {
        
    }

    /**
     * 
     * метод шифрования строки задачи
     * 
     * @param Task $task задача
     * @param int $curent_repetitions колличество проходов шифрования
     * 
     * @return void
     */

    
    public function crypt($task,$curent_repetitions = 0)
    {
       
        if ($curent_repetitions <= $task->repetitions and $task->status !== 'stop') {

            $task->refresh();

            //echo $task->status;
            if ($curent_repetitions != 0) {
                $task->value = $task->value ."_". $task->salt;
            }

            $task->last_value = $task->value;
            $task->value = Hash::make($task->last_value);

            $task->repetition_repetitions = $curent_repetitions;

            sleep($task->sleep);
            $task->save();
            $this->crypt($task,$curent_repetitions + 1);
        }

        return 0;
        // else {
            
        //     $task->save();
        // }
    }


}