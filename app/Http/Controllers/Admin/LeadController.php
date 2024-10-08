<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

use App\Models\Lead;

use Illuminate\Support\Facades\Mail;
use App\Mail\NewContact;

class LeadController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();
        $success = true;

        // Validazione dei dati
        $validator = Validator::make($data,
            [
                'name' => 'required|string|max:100',
                'email' => 'required|email|max:100',
                'message' => 'required|string|min:10|max:500',
            ],
            [
                'name.required' => 'Il campo nome è obbligatorio.',
                'name.string' => 'Il campo nome deve contenere solo testo.',
                'name.max' => 'Il campo nome non può superare i 100 caratteri.',

                'email.required' => 'Il campo email è obbligatorio.',
                'email.email' => 'Il campo email deve contenere un indirizzo email valido.',
                'email.max' => 'Il campo email non può superare i 100 caratteri.',

                'message.required' => 'Il campo messaggio è obbligatorio.',
                'message.string' => 'Il campo messaggio deve contenere solo testo.',
                'message.min' => 'Il campo messaggio deve contenere almeno 10 caratteri.',
                'message.max' => 'Il campo messaggio non può superare i 500 caratteri.',
            ],
        );

        if($validator->fails()){
            $success = false;
            $errors = $validator->errors();

            return response()->json(compact('errors','success'));

        }

        $new_lead = new Lead();
        $new_lead->fill($data);
        $new_lead->save();

        // invio della mail

        Mail::to($new_lead->email)->send(new NewContact($new_lead));


        return response()->json(compact('data','success'));
    }
}
