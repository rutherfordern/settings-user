<?php

declare(strict_types=1);

namespace App\Verification\VerificationCodeGenerator;

use Illuminate\Support\Str;

class VerificationCodeGenerator
{
    public function generate(int $length = 6): string
    {
        return Str::random($length);
    }
}
