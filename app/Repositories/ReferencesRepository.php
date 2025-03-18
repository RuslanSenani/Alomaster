<?php

namespace App\Repositories;

use App\Contracts\IReferencesRepository;
use App\Models\Front\Reference;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class ReferencesRepository implements IReferencesRepository
{

    private Reference $reference;

    public function __construct(Reference $reference)
    {
        $this->reference = $reference;
    }

    public function all(array $where, array $order): Collection
    {
        return $this->reference->where($where)->orderBy($order[0], $order[1])->get();
    }

    public function find($id): ?Model
    {
        return $this->reference->findOrFail($id);
    }

    public function getModel(): Model
    {
        return $this->reference;
    }

    public function create(array $attributes): Model
    {

        return $this->reference->create($attributes);
    }

    public function update($id, array $attributes): bool
    {
        $reference = $this->reference->findOrFail($id);
        return $reference->update($attributes);
    }

    public function delete($id): bool
    {
        return $this->reference->destroy($id);
    }
}
