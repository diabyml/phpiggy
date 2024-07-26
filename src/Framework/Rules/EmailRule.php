<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;

class EmailRule implements RuleInterface
{
    public function validate(array $formData, string $field, array $params): bool
    {
        return filter_var($formData[$field], FILTER_VALIDATE_EMAIL) !== false;
    }

    public function getMessage(array $formData, string $field, array $params): string
    {
        return "Invalid email.";
    }
}
