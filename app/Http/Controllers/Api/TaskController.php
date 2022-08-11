<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Http\Requests\TaskRequest;
use App\Jobs\CryptTaskJob;
use App\Services\HashService;

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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        CryptTaskJob::dispatch(new HashService, $task);
        //return $this->sendResponse($task);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
