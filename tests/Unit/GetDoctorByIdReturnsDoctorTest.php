<?php

use App\Models\Doctor;
use App\Repositories\DoctorRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;




it('returns a doctor by id', function () {
    $doctor = Doctor::factory()->create();

    $repo = new DoctorRepository();
    $result = $repo->getDoctorById($doctor->id);

    expect($result)->not()->toBeNull();
    expect($result->id)->toBe($doctor->id);
});
