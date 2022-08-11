<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     title="TaskPackRequest",
 *     description="Task Pack Request",
 *     @OA\Xml(
 *         name="TaskPackRequest"
 *     )
 * )
 * 
 */


class TaskPackRequest extends FormRequest
{
    /**
     * @OA\Property(
     *      title="Packege",
     *      description="Массив обьектов для шифрования",
     *      example="[{""value"":""qwert"",""repetitions"":12}]"
     * )
     *
     * @var string
     */
    private $packege;

    
    
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
            'packege' => 'array',
            
        ];
    }
}
