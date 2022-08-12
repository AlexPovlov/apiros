<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Http\Requests\TaskPackRequest;
use App\Jobs\CryptTaskJob;
use App\Services\HashService;
use Bus;

class JobController extends BaseController
{

    /**
     * @OA\Get(
     *      path="/jobs",
     *      operationId="getJobs",
     *      tags={"jobs"},
     *      summary="Получение списка jobs",
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
        
        $jobs = Job::all();
        return $this->sendResponse($jobs);
    }


   
}
