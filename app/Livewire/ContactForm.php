<?php

namespace App\Livewire;

use App\Models\Contact;
use Livewire\Component;

class ContactForm extends Component
{
    public $name;
    public $email;
    public $subject;
    public $messsage;


    public function save()
    {
        $validatedData = $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'messsage' => 'required',
        ]);

        Contact::create($validatedData);

        $this->reset(); 

        session()->flash('success', 'messsage send successfully!');
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
