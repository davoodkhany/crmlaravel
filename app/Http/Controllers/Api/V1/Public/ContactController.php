<?php

namespace App\Http\Controllers\Api\V1\Public;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $company = User::find(1)->company;
        return $company;
    }

    public function getUserResponsible(Request $request)
    {
        $user = $request->user['id'];
        $company = User::find($user)->company->first();
        $users = $company->users;

        foreach ($users as $key => $value) {
            $users2[] = array('id' => $key, 'name' => $value['first_name'] . ' ' . $value['last_name']);
        }

        return response()->json(['users' => $users2], 200);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        return $request;

        $contact = Contact::create([
            'name' => $request->name,
            'family' => $request->family,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'responsible' => $request->responsible,
        ]);

        $contact->company()->sync([$request->company_id]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        //
    }
}
