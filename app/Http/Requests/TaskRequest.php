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
            'value' => 'required|string|max:2000',
            'repetitions' => 'required|integer',
        ];
    }
}
