<?php

namespace App\Actions;

use App\Models\Contact;

class GetContactsAction
{
    protected $model;

    public function __construct(Contact $model)
    {
        $this->model = $model;
    }

    public function execute($limit = 10)
    {
        return $this->model->query()->where('user_id', auth()->user()->id)
            ->orderBy('updated_at', 'desc')
            ->paginate($limit);
    }
}
