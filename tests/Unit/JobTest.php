<?php

use App\Models\Employer;
use App\Models\Job;

test('it belongs to employer', function () {
    // Arrange, Act, Assert - AAA

    // 
    $employer = Employer::factory()->create();
    $job = Job::factory()->create([
        'employer_id' => $employer->id,
    ]);

    // 
    // TDD: we would need to add the relation/function in models if we didn't cuz the test would fail then
    expect($job->employer->is($employer))->toBeTrue();
});

it('can have tags', function(){
    // AAA

    // 
    $job = Job::factory()->create();

    // 
    $job->tag('Frontend');

    // 
    expect($job->tags)->toHaveCount(1);
});