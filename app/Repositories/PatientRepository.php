<?php

namespace App\Repositories;

use App\Models\User;

class PatientRepository
{
    public function getAllPatients($dniFilter = '')
    {
        return User::with('roles')
            ->whereHas('roles', function ($query) {
                $query->where('name', 'paciente');
            })
            ->when($dniFilter, function ($query) use ($dniFilter) {
                return $query->where('dni', 'like', $dniFilter . '%');
            })
            ->get();
    }

    public function findPatientById($id)
    {
        return User::find($id);
    }

    public function createPatient($data)
    {
        $user = User::create(array_merge($data, ['password' => bcrypt(env('DEFAULT_PASSWORD'))]));
        $user->assignRole('paciente');
        return $user;
    }

    public function updatePatient($id, $data)
    {
        $patient = $this->findPatientById($id);
        if ($patient) {
            $patient->update($data);
        }
        return $patient;
    }

    public function deletePatient($id)
    {
        $patient = $this->findPatientById($id);
        if ($patient) {
            $patient->removeRole('paciente');
            $patient->delete();
            return true;
        }
        return false;
    }
}
