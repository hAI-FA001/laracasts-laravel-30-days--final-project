<?php

namespace Tests\Unit;

use App\Models\Employer;
use App\Models\Job;
use PHPUnit\Framework\TestCase;

class JobTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_it_belongs_to_an_employer(): void
    {
        // Arrange, Act, Assert -> AAA

        // 
        $employer = Employer::factory()->create();
        $job = Job::factory()->create([
            'employer_id' => $employer->id,
        ]);

        // 
        $this->assertTrue($job->employer->is($employer));
    }
}
