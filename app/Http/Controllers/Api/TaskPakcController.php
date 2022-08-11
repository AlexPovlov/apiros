<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Job;
use App\Http\Requests\TaskPackRequest;
use App\Jobs\CryptTaskJob;
use App\Services\HashService;
use Bus;

class TaskPakcController extends BaseController
{

    /**
     * @OA\Post(
     *      path="/task/pack",
     *      operationId="setPackTask",
     *      tags={"task pack"},
     *      summary="Создание данных",
     *      description="Метод содает данные пакетом и шифрует их ...",
     * 
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/TaskPackRequest")
     *          
     *      ),
     * 
     *     @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          
     *     )
     * )
     * 
     */

    public function store(TaskPackRequest $request)
    {
        $validated = $request->validated();
        
        $jobs = [];
        $tasks = [];

        foreach ($validated['packege'] as $key => $pack) {
            $task = Task::create($pack);
            $tasks[] = $task;
            $jobs[] = new CryptTaskJob(new HashService(),$task);
        }

        $batch = Bus::batch($jobs)->dispatch();
        return $this->sendResponse($tasks);
        
    }


    /**
     * @OA\Post(
     *      path="/task/pack/all",
     *      operationId="GetPackTask",
     *      tags={"task pack"},
     *      summary="Создание данных",
     *      description="Возвращает пакет данных",
     * 
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/TaskPackRequest")
     *          
     *      ),
     * 
     *     @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          
     *     )
     * )
     * 
     */



    public function showpack(TaskPackRequest $request)
    {
        $tasks = Task::whereIn('id', $request['packege'])->get();
        return $this->sendResponse($tasks);
    }


    /**
     * @OA\Post(
     *      path="/task/pack/stop",
     *      operationId="stopPackTask",
     *      tags={"task pack"},
     *      summary="Создание данных",
     *      description="Останавливает шифрование пакетно",
     * 
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/TaskPackRequest")
     *          
     *      ),
     * 
     *     @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          
     *     )
     * )
     * 
     */


    public function stopTask(TaskPackRequest $request)
    {
        $validated = $request->validated();

        $tasks = [];

        foreach ($validated['packege'] as $key => $id) {
            $task = Task::find($id);
            $task->status = 'stop';
            $task->save();
            $tasks[] = $task;
            Job::destroy($task->job_id);
        }

        return $this->sendResponse($tasks);
        
    }


    /**
     * @OA\Post(
     *      path="/task/pack/start",
     *      operationId="startPackTask",
     *      tags={"task pack"},
     *      summary="Создание данных",
     *      description="Запускает шифрование пакетно",
     * 
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/TaskPackRequest")
     *          
     *      ),
     * 
     *     @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          
     *     )
     * )
     * 
     */

    public function startTask(TaskPackRequest $request)
    {
        $validated = $request->validated();

        $jobs = [];
        $tasks = [];

        foreach ($validated['packege'] as $key => $id) {
            $task = Task::find($id);
            $task->status = 'start';
            $task->save();
            $tasks[] = $task;

            $jobs[] = new CryptTaskJob(new HashService(),$task);
        }

        $batch = Bus::batch($jobs)->dispatch();

        return $this->sendResponse($tasks);
    }

    
}
