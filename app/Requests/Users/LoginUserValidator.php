<?php
namespace App\Requests\Users;


use App\Requests\BaseRequestFormApi;


class LoginUserValidator extends BaseRequestFormApi
{
    public function rules(): array
    {
        return [

            'email' => 'required|string|email|min:5|max:50',
            'password' => 'required|string|min:6|max:50',
        ];
    }

    public function authorized(): bool
    {
        return true;
    }
}
