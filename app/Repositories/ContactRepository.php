<?php

namespace App\Repositories;

use App\Contracts\IContactRepository;
use App\Models\Front\Contact;
use App\Models\Front\Reference;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class ContactRepository implements  IContactRepository
{

    private Contact $model;

    public function __construct(Contact $model)
    {
        $this->model = $model;
    }

    public function all(array $where, array $order): Collection
    {
        return $this->model->where($where)->orderBy($order[0], $order[1])->get();
    }

    public function find($id): ?Model
    {
        return $this->model->findOrFail($id);
    }

    public function getModel(): Model
    {
        return $this->model;
    }

    public function create(array $attributes): Model
    {

        return $this->model->create($attributes);
    }

    public function update($id, array $attributes): bool
    {
        $contact = $this->model->findOrFail($id);
        return $contact->update($attributes);
    }

    public function delete($id): bool
    {
        return $this->model->destroy($id);
    }
}
