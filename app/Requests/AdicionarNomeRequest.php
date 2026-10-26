<?php

declare(strict_types=1);

namespace App\Requests;

use Haki\Validation\FormRequest;
use Haki\Validation\Rule;

final class AdicionarNomeRequest extends FormRequest
{
    public function rules(Rule $rule): array
    {
        return [
            'nome' => $rule->text()->length(3, 100),
        ];
    }
}
