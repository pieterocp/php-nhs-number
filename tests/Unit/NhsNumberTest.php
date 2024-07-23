<?php

namespace ImLiam\NhsNumber\Tests\Unit;

use ImLiam\NhsNumber\NhsNumber;
use ImLiam\NhsNumber\Tests\TestCase;
use ImLiam\NhsNumber\InvalidNhsNumberException;

class NhsNumberTest extends TestCase
{
    public function validNhsNumbersProvider()
    {
        yield 'example 1' => ['9077844449'];
        yield 'example 2' => ['4698651433'];
        yield 'example 3' => ['5835160933'];
        yield 'example 4' => ['5462903022'];
        yield 'example 5' => ['1032640960'];
        yield 'example 6' => ['1740296788'];
        yield 'example 7' => ['9278462608'];
        yield 'example 8' => ['7448556886'];
        yield 'example 9' => ['0372104223'];
        yield 'example 10' => ['8416367035'];
    }

    /** @dataProvider validNhsNumbersProvider */
    public function test_these_nhs_numbers_are_valid($number)
    {
        $this->assertTrue((new NhsNumber($number))->validate());
    }

    public function test_a_string_is_not_a_valid_nhs_number()
    {
        $this->expectException(InvalidNhsNumberException::class);
        (new NhsNumber('Hello world.'))->validate();
    }

    public function test_a_number_must_not_have_less_than_10_digits()
    {
        $this->expectException(InvalidNhsNumberException::class);
        (new NhsNumber((string) 12345))->validate();
    }

    public function a_number_must_not_have_more_than_10_digits()
    {
        $this->expectException(InvalidNhsNumberException::class);
        $this->expectExceptionMessage('An NHS number must be numeric and 10 characters long.');
        (new NhsNumber((string) 12345678901234567890))->validate();
    }

    public function test_a_number_must_have_a_valid_checksum()
    {
        $this->expectException(InvalidNhsNumberException::class);
        $this->expectExceptionMessage('The NHS number\'s check digit does not match.');
        (new NhsNumber('1740296781'))->validate();
    }

    public function a_random_valid_nhs_number_can_be_generated()
    {
        $number = NhsNumber::getRandomNumber();
        $this->assertTrue((new NhsNumber($number))->validate());
    }

    public function test_a_list_of_random_valid_nhs_numbers_can_be_generated()
    {
        $numbers = NhsNumber::getRandomNumbers(3);

        $this->assertCount(3, $numbers);

        foreach ($numbers as $number) {
            $this->assertTrue((new NhsNumber($number))->validate());
        }
    }

    public function test_a_valid_nhs_number_can_be_formatted_as_a_string()
    {
        $number = new NhsNumber('9077844449');

        $this->assertEquals('907 784 4449', $number->format());
    }

    public function test_a_random_valid_nhs_number_can_be_validated()
    {
        $number = NhsNumber::getRandomNumber();
        $this->assertTrue((new NhsNumber($number))->isValid());
    }

    public function test_a_invalid_nhs_number_can_be_validated()
    {
        $this->assertFalse((new NhsNumber('1000'))->isValid());
    }

    public function test_it_can_get_number()
    {
        $number = new NhsNumber('9077844449');

        $this->assertEquals('9077844449', $number->getNumber());
    }

    public function test_it_can_be_formatted_with_dashes()
    {
        $number = new NhsNumber('907-784-4449');

        $this->assertEquals('907-784-4449', $number->formatDashes());
    }

    public function test_it_can_get_formatted_nhs_number()
    {
        $number = new NhsNumber('9077844449');

        $this->assertEquals('907 784 4449', (string) $number);
    }
}
