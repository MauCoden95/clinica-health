<?php

namespace App\Repositories;

use App\Models\Supplier;
use Illuminate\Database\QueryException;

class SupplierRepository
{
    public function getAll()
    {
        return Supplier::all();
    }

    public function getById($id)
    {
        return Supplier::find($id);
    }

    public function create(array $data)
    {
        try {
            return Supplier::create($data);
        } catch (QueryException $e) {
            throw $e;
        }
    }


    public function update($id, array $data)
    {
        $supplier = Supplier::find($id);
        return $supplier ? $supplier->update($data) : false;
    }


    public function delete($id)
    {
        $supplier = Supplier::find($id);
        return $supplier ? $supplier->delete() : false;
    }
}
