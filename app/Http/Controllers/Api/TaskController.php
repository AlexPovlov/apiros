<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Http\Requests\TaskRequest;
use App\Jobs\CryptTaskJob;
use App\Models\Job;
use App\Services\HashService;
use Bus;

class TaskController extends BaseController
{
    /**
     * @OA\Get(
     *      path="/task",
     *      operationId="getTask",
     *      tags={"tasks"},
     *      summary="Получение списка задач",
     *      description="Метод возвращает данные ...",
     * 
     *       @OA\Parameter(
     *          name="id",
     *          description="id task",
     *          in="path",
     *          @OA\Schema(
     *              type="sting"
     *          )
     *          
     *     ),
     * 
     *     @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Task")
     *     )
     * )
     * 
     */
    public function index()
    {
        
        $task = Task::all();
        return $this->sendResponse($task);
    }

    /**
     * @OA\Post(
     *      path="/task",
     *      operationId="setTask",
     *      tags={"tasks"},
     *      summary="Создание данных",
     *      description="Метод содает данные и шифрует их ...",
     * 
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/TaskRequest")
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

    public function store(TaskRequest $request)
    {
        $validated = $request->validated();
        
        $task = Task::create($validated);
        CryptTaskJob::dispatch(new HashService(),$task);
        return $this->sendResponse($task);
       
        
    }

    /**
     * @OA\Post(
     *      path="/task/stop/{id}",
     *      operationId="stoptask",
     *      tags={"tasks"},
     *      summary="Получение списка задач",
     *      description="Метод останавливает шифрование ...",
     * 
     *      @OA\Parameter(
     *          name="id",
     *          description="id task",
     *          in="path",
     *          @OA\Schema(
     *              type="sting"
     *          )
     *          
     *     ),
     * 
     
     *     @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Task")
     *     )
     * )
     * 
     */

    public function stopTask($id)
    {
        $task = Task::find($id);
        $task->status = 'stop';
        $task->save();
        Job::destroy($task->job_id);
        return $this->sendResponse($task);
        
    }

    /**
     * @OA\Post(
     *      path="/task/start/{id}",
     *      operationId="starttask",
     *      tags={"tasks"},
     *      summary="Получение списка задач",
     *      description="Метод запускает шифрование ...",
     * 
     *      @OA\Parameter(
     *          name="id",
     *          description="id task",
     *          in="path",
     *          @OA\Schema(
     *              type="sting"
     *          )
     *          
     *     ),
     
     *     @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Task")
     *     )
     * )
     * 
     */

    public function startTask($id)
    {
        $task = Task::find($id);
        $task->status = 'start';
        $task->save();
        CryptTaskJob::dispatch(new HashService(),$task);
    }

    

    
}
