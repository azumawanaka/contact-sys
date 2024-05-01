<?php

namespace App\Actions;

use App\Models\Contact;

class UpdateContactAction
{
    protected $model;

    public function __construct(Contact $model)
    {
        $this->model = $model;
    }

    public function execute(Contact $contact, $data)
    {
        return $contact->update([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'company' => $data['company'],
            'email' => $data['email'],
        ]);
    }
}
