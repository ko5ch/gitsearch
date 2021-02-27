<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RepositoryFavoriteRequest extends FormRequest
{
    public function prepareForValidation()
    {
        //
    }

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
    public function rules() //todo
    {
        return [
            'owner_login'       => 'required|string|max:39',
            'stargazers_count'  => 'required|integer',
            'description'       => 'nullable|string',
            'html_url'          => 'required|string',
            'repo_id'           => 'required|integer',
            'name'              => 'required|string',
        ];
    }
}
