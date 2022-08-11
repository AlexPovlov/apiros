<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
/**
 * @OA\Schema(
 *     title="Task",
 *     description="Task model",
 *     @OA\Xml(
 *         name="Task"
 *     )
 * )
 * 
 */

class Task extends Model
{
    /**
     * @OA\Property(
     *     title="ID",
     *     description="ID",
     *     format="int64",
     *     example=1
     * )
     *
     * @var bigInteger
     */
    private $id;
    /**
     * @OA\Property(
     *      title="Value",
     *      description="строка которую шифрует",
     *      example="qwerty"
     * )
     *
     * @var string
     */
    private $value;

    /**
     * @OA\Property(
     *      title="Repetitions",
     *      description="количетсво проходов шифра",
     *      format="int64",
     *      example=1
     * )
     *
     * @var int
     */
    private $repetitions;

    /**
     * @OA\Property(
     *      title="Repetition Repetitions",
     *      description="остаток проходов шифра",
     *      format="int64",
     *      example=1
     * )
     *
     * @var int
     */
    private $repetition_repetitions;
   
    /**
     * @OA\Property(
     *     title="Created at",
     *     description="Created at",
     *     example="2020-01-27 17:50:45",
     *     format="datetime",
     *     type="string"
     * )
     */
    
    private $created_at;
    /**
     * @OA\Property(
     *     title="Updated at",
     *     description="Updated at",
     *     example="2020-01-27 17:50:45",
     *     format="datetime",
     *     type="string"
     * )
     */
    private $updated_at;
    
    protected $table = 'tasks';

    protected $fillable = ['value','repetitions','job_id','status'];

    public function job(){
        return $this->belongsTo(Job::class);
    }
}
