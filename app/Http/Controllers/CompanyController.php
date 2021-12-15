<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Http\Resources\CompanyController as ResourcesCompanyController;

use function GuzzleHttp\Promise\all;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ResourcesCompanyController::collection(Company::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) //$id
    {
        //public function store(Request $request, $id)
        // $user_id = Auth::user()->id;

        $request->validate([
            'member_count' => 'integer',
            'siret' => 'required|string',
            'name' => 'required|string',
            'adress' => 'required|string',
            'postcode' => 'required|string',
            'city' => 'required|string',

        ]);

        $companies = [
            'member_count' => $request->input('member_count'),
            'name' => $request->input('name'),
            'siret' => $request->input('siret'),
            'adress' => $request->input('adress'),
            'postcode' => $request->input('postcode'),
            'city' => $request->input('city'),

        ];

        Company::create($companies);

        //Company::create($request->all());

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
<<<<<<< HEAD
        Company::findOrFail($id);
        /*
        //récupération des éléments id, name, email et password directement assignés dans des variables
        $CompanyId = Auth::id();
        $CompanyName = Auth::user()->name;
        $companyAdress = Auth::user()->email;
        $companyPostcode = Auth::user()->password;
        $companyPostcode = Auth::user()->password;
        $companyPostcode = Auth::user()->password;

        //retourne la vue profile via la route profile.show/{{profileIdFront}} = id récupéré
        return view('trello.profile', compact('profileIdFront', 'profileName', 'profileEmail', 'profilePassword')); */
=======
        return Company::findOrFail($id);
>>>>>>> origin/master
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
