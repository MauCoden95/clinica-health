<?php

use App\Models\Doctor;
use App\Models\Specialty;
use App\Models\Turn;
use App\Repositories\DoctorRepository;
use App\Models\User;



it('example', function () {
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();
    $user3 = User::factory()->create();
    $user4 = User::factory()->create();

    $spec = Specialty::factory()->create();

    $doc1 = Doctor::factory()->create(['user_id' => $user1->id, 'specialty_id' => $spec->id]);
    $doc2 = Doctor::factory()->create(['user_id' => $user2->id, 'specialty_id' => $spec->id]);
    $doc3 = Doctor::factory()->create(['user_id' => $user3->id, 'specialty_id' => $spec->id]);
    $doc4 = Doctor::factory()->create(['user_id' => $user4->id, 'specialty_id' => $spec->id]);


    Turn::factory()->count(7)->create(['doctor_id' => $doc1->id, 'status' => 'unavailable']);
    Turn::factory()->count(4)->create(['doctor_id' => $doc2->id, 'status' => 'unavailable']);
    Turn::factory()->count(10)->create(['doctor_id' => $doc3->id, 'status' => 'unavailable']);
    Turn::factory()->count(1)->create(['doctor_id' => $doc4->id, 'status' => 'unavailable']);

    
    $repo = new DoctorRepository();
    $top = $repo->getTopThreeDoctors();

  
    expect($top->count())->toBe(3);                     
    expect($top->first()->name)->toBe($user3->name);
});
