<?php

class Validator
{
    protected array $rules = [];
    protected array $errors = [];
    protected $stopOnFirstFailure = false;

    public function __construct($rules, $stopOnFirstFailure = false)
    {
        $this->rules = $rules;
        $this->stopOnFirstFailure = $stopOnFirstFailure;
    }

    public function validateInput($data): array
    {
        return self::validate($data) ? ["data" => $data] : ["error" => self::getErrors()];

    }

    public function validate($data)
    {
        $this->errors = [];
        foreach ($this->rules as $attribute => $rules) {
            foreach ($rules as $rule) {
                $ruleObject = RuleFactory::make($rule);

                if (!$ruleObject->passes($data[$attribute])) {
                    $this->errors[$attribute][] = str_replace(':attribute', $attribute, $ruleObject->message());

                    if ($this->stopOnFirstFailure) {
                        break 2;
                    }
                }
            }
        }
        return empty($this->errors);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
