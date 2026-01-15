<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGameRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $gameId = $this->route('game')->id;

        return [
            'icon' => 'required|string|max:10',
            'title' => 'required|string|max:255|unique:games,title,' . $gameId,
            'category' => 'required|string|max:100',
            'description' => 'nullable|string|max:1000',
            'plays' => 'nullable|integer|min:0',
            'rating' => 'nullable|numeric|min:1|max:5',
            'status' => 'required|in:active,inactive',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'url' => 'nullable|url|max:500'
        ];
    }
}