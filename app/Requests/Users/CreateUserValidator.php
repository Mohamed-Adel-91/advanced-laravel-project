<?php
namespace App\Requests\Users;


use App\Requests\BaseRequestFormApi;


class CreateUserValidator extends BaseRequestFormApi
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|between:2,50',
            'email' => 'required|string|email|min:5|max:50|unique:users',
            'password' => 'required|string|confirmed|min:6|max:50',
        ];
    }

    public function authorized(): bool
    {
        return true;
    }
}
