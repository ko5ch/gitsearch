<?php

namespace App\Http\Requests;

use App\Services\Api\GitService;
use Illuminate\Foundation\Http\FormRequest;

class RepositorySearchRequest extends FormRequest
{
    public function prepareForValidation()
    {
        GitService::getDefaultSearchValues()->only(['per_page', 'page'])->each( function ($defaultValue, $paramName) {
            if (is_null($this->request->get($paramName))) {
                $this->request->set($paramName, $defaultValue);
            }
        });
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
    public function rules()
    {
        return [
            'search_text'   => 'nullable|string|max:256',
            'per_page'      => 'sometimes|string|max:100',
            'sort'          => 'sometimes|string|max:10',
            'order'         => 'sometimes|string|max:5',
            'page'          => 'sometimes|string',
        ];
    }
}
