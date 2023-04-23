<?php

namespace App\Http\Controllers\Api\V1\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Admin\ContactRequest;
use App\Models\Company;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $contacts = $request->user()->contacts()->orderBy('created_at', 'desc')->get();

        $company = $request->user()->company()->first();

        $contacts_all =  $company->contacts()->get();

        return response()->json(['contacts' => $contacts, 'contacts_all' => $contacts_all], 200);

        // $company = User::find(1)->company;
        // return $company;
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
    public function store(ContactRequest $request)
    {

        $user = $request->user();
        $company_id = $request->user()->company->first()->id;

        $contact_mobile_exist = Contact::where('mobile', $request->mobile)->whereHas('companies', function ($query) use ($company_id) {
            $query->where('company_id', $company_id);
        })->exists();

        if ($contact_mobile_exist) {

            $errors = $request->validate([
                'mobile' => 'unique:contacts,mobile',
            ]);
            return response()->json(['errors' => $errors], 422);
        } else {

            $contact = Contact::create([
                'name' => $request->name,
                'family' => $request->family,
                'mobile' => $request->mobile,
                'email' => $request->email,
                'responsible' => $request->responsible,
            ]);

            $contact->companies()->attach([$company_id]);

            $user->contacts()->attach([$contact->id]);

            $company = $request->user()->company()->first();

            $contacts_all =  $company->contacts()->orderBy('created_at', 'desc')->get();


            return response()->json(['contacts_all' => $contacts_all], 200);

        }
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