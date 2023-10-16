<?php

declare(strict_types=1);

namespace Framework;

use Framework\Contracts\RuleInterface;
use Framework\Exceptions\ValidationException;

class Validator
{

    private array $rules = [];

    public function add(string $alias, RuleInterface $rule)
    {
        $this->rules[$alias] = $rule;
    }

    public function validateData(array $formData, array $fields)
    {

        $errors = [];
        foreach ($fields as $fieldName => $rules) {
            foreach ($rules as $rule) {
                $ruleParams = [];

                // Check to see if we have parameters
                if (str_contains($rule, ':')) {

                    [$rule, $ruleParams] = explode(':', $rule);
                    $ruleParams = explode(',', $ruleParams);

                    //debugVar($ruleParams);
                }

                $ruleValidator = $this->rules[$rule];
                if ($ruleValidator->validate($formData, $fieldName, $ruleParams)) {
                    continue;
                }

                $errors[$fieldName][] = $ruleValidator->getMessage($formData, $fieldName, $ruleParams);
            }
        }

        if (count($errors)) {
            throw new ValidationException($errors);
        }
    }
}
