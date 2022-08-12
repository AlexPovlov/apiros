<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     title="TaskRequest",
 *     description="Task Request",
 *     @OA\Xml(
 *         name="TaskRequest"
 *     )
 * )
 * 
 */


class TaskRequest extends FormRequest
{
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
     *      title="Salt",
     *      description="соль добавляющяясь к строке",
     *      
     *      example="saltqweqwe"
     * )
     *
     * @var int
     */
    private $salt;

     /**
     * @OA\Property(
     *      title="Repetitions",
     *      description="Ограничение секунд выполнения проходов шифрования",
     *      format="int64",
     *      example=2
     * )
     *
     * @var int
     */
    private $sleep;
    
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            
            'value' => 'string|max:255',
            'repetitions' => 'integer',
            'salt' => 'string|max:255',
            'sleep' => 'integer',
        ];
    }
}
