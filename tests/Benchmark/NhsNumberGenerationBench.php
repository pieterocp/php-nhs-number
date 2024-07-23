<?php

namespace ImLiam\NhsNumber\Tests\Benchmark;

use ImLiam\NhsNumber\NhsNumber;
use PhpBench\Benchmark\Metadata\Annotations\Iterations;
use PhpBench\Benchmark\Metadata\Annotations\Revs;

class NhsNumberGenerationBench
{
    /**
     * @Revs(10000)
     * @Iterations(5)
     */
    public function benchSingleGeneration()
    {
        $number = NhsNumber::getRandomNumber();
    }

    /**
     * @Revs(100)
     * @Iterations(5)
     */
    public function benchTenGeneration()
    {
        $number = NhsNumber::getRandomNumbers(10);
    }

    /**
     * @Revs(3)
     * @Iterations(5)
     */
    public function benchHundredGeneration()
    {
        $number = NhsNumber::getRandomNumbers(100);
    }

    /**
     * @Revs(3)
     * @Iterations(5)
     */
    public function benchThousandGeneration()
    {
        $number = NhsNumber::getRandomNumbers(1_000);
    }

    /**
     * @Revs(3)
     * @Iterations(5)
     */
    public function benchTenThousandGeneration()
    {
        $number = NhsNumber::getRandomNumbers(10_000);
    }

    /**
     * @Revs(100)
     * @Iterations(5)
     */
    public function benchTenGenerationNoDupeCheck()
    {
        $number = NhsNumber::getRandomNumbers(10, false);
    }

    /**
     * @Revs(3)
     * @Iterations(5)
     */
    public function benchHundredGenerationNoDupeCheck()
    {
        $number = NhsNumber::getRandomNumbers(100, false);
    }

    /**
     * @Revs(3)
     * @Iterations(5)
     */
    public function benchThousandGenerationNoDupeCheck()
    {
        $number = NhsNumber::getRandomNumbers(1_000, false);
    }

    /**
     * @Revs(3)
     * @Iterations(5)
     */
    public function benchTenThousandGenerationNoDupeCheck()
    {
        $number = NhsNumber::getRandomNumbers(10_000, false);
    }
}
