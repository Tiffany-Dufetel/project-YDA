<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)//$id
    {
        //public function store(Request $request, $id)
       // $user_id = Auth::user()->id;

        $request->validate([
            'member_count' => 'integer',
            'siret'=> 'required|string',
            'name'=> 'required|string',
            'adress'=> 'required|string',
            'postCode'=> 'required|integer',
            'city'=> 'required|string',
        ]);

        $companies = [
            'member_count' => $request->input('member_count'),
            'name' => $request->input('name'),
            'siret' => $request->input('siret'),
            'adress' => $request->input('adress'),
            'postCode' => $request->input('postCode'),
            'city' => $request->input('city'),

        ];

        Company::create($companies);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
