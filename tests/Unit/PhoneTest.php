<?php

namespace Tests\Unit;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use App\Rules\ValidPhoneNumber;

class ValidPhoneNumberTest extends TestCase
{
    protected ValidPhoneNumber $rule;

    protected function setUp(): void
    {
        parent::setUp();

        $this->rule = new ValidPhoneNumber();
    }

    #[Test]
    public function it_accepts_valid_phone_number_with_plus370(): void
    {
        $valid = '+37061234567';

        $fails = false;

        $this->rule->validate('phone', $valid, function () use (&$fails) {
            $fails = true;
        });

        $this->assertFalse($fails);
    }

    #[Test]
    public function it_accepts_valid_phone_number_with_86(): void
    {
        $valid = '861234567';

        $fails = false;

        $this->rule->validate('phone', $valid, function () use (&$fails) {
            $fails = true;
        });

        $this->assertFalse($fails);
    }

    #[Test]
    public function it_accepts_valid_phone_number_with_06(): void
    {
        $valid = '061234567';

        $fails = false;

        $this->rule->validate('phone', $valid, function () use (&$fails) {
            $fails = true;
        });

        $this->assertFalse($fails);
    }

    #[Test]
    public function it_rejects_invalid_short_phone_number(): void
    {
        $invalid = '12345';

        $fails = false;

        $this->rule->validate('phone', $invalid, function () use (&$fails) {
            $fails = true;
        });

        $this->assertTrue($fails);
    }

    #[Test]
    public function it_rejects_invalid_prefix(): void
    {
        $invalid = '051234567';

        $fails = false;

        $this->rule->validate('phone', $invalid, function () use (&$fails) {
            $fails = true;
        });

        $this->assertTrue($fails);
    }

    #[Test]
    public function it_rejects_phone_number_with_letters(): void
    {
        $invalid = '86ABC4567';

        $fails = false;

        $this->rule->validate('phone', $invalid, function () use (&$fails) {
            $fails = true;
        });

        $this->assertTrue($fails);
    }
}