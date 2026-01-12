<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGameRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'icon' => 'required|string|max:10',
            'title' => 'required|string|max:255|unique:games,title',
            'category' => 'required|string|max:100',
            'description' => 'nullable|string|max:1000',
            'plays' => 'nullable|integer|min:0',
            'rating' => 'nullable|numeric|min:1|max:5',
            'status' => 'required|in:active,inactive',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'url' => 'nullable|url|max:500'
        ];
    }

    public function messages()
    {
        return [
            'icon.required' => 'Game icon is required',
            'title.required' => 'Game title is required',
            'title.unique' => 'This game title already exists',
            'category.required' => 'Please select a category',
            'rating.min' => 'Rating must be between 1 and 5',
            'rating.max' => 'Rating must be between 1 and 5',
            'thumbnail.image' => 'Thumbnail must be an image',
            'thumbnail.max' => 'Thumbnail size must not exceed 2MB',
        ];
    }
}