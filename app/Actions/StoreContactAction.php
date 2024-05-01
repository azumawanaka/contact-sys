<?php

namespace App\Actions;

use App\Models\Contact;

class StoreContactAction
{
    protected $model;

    public function __construct(Contact $model)
    {
        $this->model = $model;
    }

    public function execute($data)
    {
        return $this->model->create([
            'user_id' => auth()->user()->id,
            'name' => $data['name'],
            'phone' => $data['phone'],
            'company' => $data['company'],
            'email' => $data['email'],
        ]);
    }
}
