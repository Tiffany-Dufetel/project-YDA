<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Http\Resources\CompanyController as ResourcesCompanyController;
use Illuminate\Support\Facades\Auth;

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

        // dd(Auth::user()->role);
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

        $request->validate([
            'member_count' => 'integer',
            'siret' => 'required|string',
            'name' => 'required|string',
            'adress' => 'required|string',
            'postcode' => 'required|string',
            'city' => 'required|string',

        ], [
            'siret.unique' => "L'entreprise que vous essayez de rajouter existe déjà.",
            'siret.required' => "Un numéro de siret est nécessaire.",
            'name.required' => "Vous devez inserez un nom d'entreprise.",
            'adress.required' => "Vous devez inserez une adresse.",
            'postcode.required' => "Vous devez inserez un code postal.",
            'city.required' => "Vous devez inserez une ville."
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
        return Company::findOrFail($id);
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
