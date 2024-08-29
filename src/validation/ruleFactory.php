<?php

class RuleFactory
{
    public static function make($rule)
    {
        [$ruleName, $parameters] = self::parseRule($rule);
        $type = null;
        if (!empty($parameters) && str_contains($parameters, ':')) {
            [$type, $parameters] = explode(':', $parameters, 2) + [null, null];
        }
        $className = ucfirst($ruleName) . 'Rule';

        if (!class_exists($className)) {
            throw new Exception("Validation rule $ruleName does not exist." . PHP_EOL);
        }

        return new $className($type, $parameters);
    }

    private static function parseRule($rule): array
    {
        if (is_string($rule) && str_contains($rule, ':')) {
            return explode(':', $rule, 2);
        }
        return [$rule, null];
    }
}
