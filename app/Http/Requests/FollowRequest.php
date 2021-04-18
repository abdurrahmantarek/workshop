<?php

namespace App\Http\Requests;

use App\Rules\AnotherUserRule;
use Illuminate\Foundation\Http\FormRequest;

class FollowRequest extends FormRequest
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
            'following_user_id' => ["required", "exists:users,id", new AnotherUserRule()]
        ];
    }
}
