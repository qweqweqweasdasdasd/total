<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StreamRequest extends FormRequest
{
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
     * @return array
     */
    public function rules()
    {
        return [
            'stream_name' => 'required|unique:streams,stream_name|max:200'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'stream_name.required' => '直播流名称必须存在',
            'stream_name.unique' => '直播流已经存在',
            'stream_name.max' => '直播流名称不得超出200个字符'
        ];
    }
}
