<?php

namespace Baubyte\Tests\Validation;

use Baubyte\Validation\Rules\Email;
use Baubyte\Validation\Rules\Required;
use Baubyte\Validation\Rules\RequiredWith;
use PHPUnit\Framework\TestCase;

class ValidationRulesTest extends TestCase {
    public function emails() {
        return [
            ["test@test.com", true],
            ["admin@baubyte.com", true],
            ["test@testcom", false],
            ["test@test.", false],
            ["baubyte@", false],
            ["baubyte@.", false],
            ["baubyte", false],
            ["@", false],
            ["", false],
            [null, false],
            [4, false],
        ];
    }

    /**
     * @dataProvider emails
     */
    public function test_email($email, $expected) {
        $data = ["email" => $email];
        $rule = new Email();
        $this->assertEquals($expected, $rule->isValid('email', $data));
    }

    public function requiredData() {
        return [
            ["", false],
            [null, false],
            [5, true],
            ["test", true],
        ];
    }

    /**
     * @dataProvider requiredData
     */
    public function test_required($value, $expected) {
        $data = ["test" => $value];
        $rule = new Required();
        $this->assertEquals($expected, $rule->isValid('test', $data));
    }

    public function test_required_with() {
        $rule = new RequiredWith("other");
        $data = ["other" => 10, "test" => 5];
        $this->assertTrue($rule->isValid('test', $data));
        $data = ["other" => 10];
        $this->assertFalse($rule->isValid('test', $data));
    }
}
