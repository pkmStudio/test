<?php
namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'nullable|string',
            'id' => 'nullable|integer',
            'id_group' => 'nullable|integer|exists:groups,id',
            'sort_by' => 'nullable|in:price,name',
            'order' => 'nullable|in:asc,desc',
            'page' => 'nullable|integer',
        ];
    }

    protected function passedValidation()
    {
        return $this->merge([
            'page' => $this->page ?? 1,
            'sort_by' => $this->input('sort_by', 'name'),
            'order' => $this->input('order', 'asc'),
        ]);
    }
}

