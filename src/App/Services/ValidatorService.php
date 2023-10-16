<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Rules\EmailRule;
use Framework\Rules\MatchRule;
use Framework\Rules\MinRule;
use Framework\Rules\RequiredRule;
use Framework\Rules\socialMediaRule;
use Framework\Validator;

class ValidatorService
{
    private Validator $validator;

    function __construct()
    {
        $this->validator = new Validator();
        $this->validator->add('required', new RequiredRule);
        $this->validator->add('email', new EmailRule);
        $this->validator->add('min', new MinRule);
        $this->validator->add('url', new socialMediaRule);
        $this->validator->add('match', new MatchRule);
    }

    function validate(array $formData)
    {
        $this->validator->validateData($formData, [
            'email' => ['required', 'email'],
            'age' => ['required', 'min:18'],
            'country' => ['required'],
            'socialMedia' => ['required', 'url'],
            'password' => ['required'],
            'confirmPassword' => ['required', 'match:password'],
            'tos' => ['required']
        ]);
    }

    function validateLogin(array $formData)
    {
        $this->validator->validateData($formData, [
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
    }
}
