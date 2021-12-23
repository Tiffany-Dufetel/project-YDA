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
            'name' => 'required|string',
            'member_count' => 'integer',
            'siret' => 'required|string',
            'adress' => 'required|string',
            'postcode' => 'required|string',
            'city' => 'required|string',
            'number' => 'integer',
            'day' => 'string',
            'time' => 'string',
            'dayTwo' => 'string',
            'timeTwo' => 'string',

        ], [
            'siret.unique' => "L'entreprise que vous essayez de rajouter existe déjà.",
            'siret.required' => "Un numéro de siret est nécessaire.",
            'name.required' => "Vous devez inserez un nom d'entreprise.",
            'adress.required' => "Vous devez inserez une adresse.",
            'postcode.required' => "Vous devez inserez un code postal.",
            'city.required' => "Vous devez inserez une ville."
        ]);

        $company = [
            'member_count' => $request->input('member_count'),
            'name' => $request->input('name'),
            'siret' => $request->input('siret'),
            'adress' => $request->input('adress'),
            'postcode' => $request->input('postcode'),
            'city' => $request->input('city'),
            'day' => $request->input('day'),
            'time' => $request->input('time'),
            'dayTwo' => $request->input('dayTwo'),
            'timeTwo' => $request->input('timeTwo'),
            'number' => $request->input('number'),
        ];

        return Company::create($company);

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
    public function update(Request $request, $company)
    {
        $company = Company::find($company);

        $request->validate([
            'member_count' => 'required|integer',
            'siret' => 'required|string',
            'name' => 'required|string',
            'adress' => 'required|string',
            'postcode' => 'required|string',
            'city' => 'required|string',
            'number' => 'integer',
            'day' => 'string',
            'time' => 'string',
            'dayTwo' => 'string',
            'timeTwo' => 'string',
        ], [
            'siret.unique' => "L'entreprise que vous essayez de rajouter existe déjà.",
            'siret.required' => "Un numéro de siret est nécessaire.",
            'name.required' => "Vous devez inserez un nom d'entreprise.",
            'adress.required' => "Vous devez inserez une adresse.",
            'postcode.required' => "Vous devez inserez un code postal.",
            'city.required' => "Vous devez inserez une ville."
        ]);

        $company->siret = $request->siret;
        $company->member_count = $request->member_count;
        $company->name = $request->name;
        $company->adress = $request->adress;
        $company->postcode = $request->postcode;
        $company->city = $request->city;
        $company->member_count = $request->member_count;
        $company->day = $request->day;
        $company->time = $request->time;
        $company->dayTwo = $request->dayTwo;
        $company->timeTwo = $request->timeTwo;

        $company->save();


        if ($company) {
            $data = [
                'status' => '1',
                'msg' => 'success'
            ];
        } else {
            $data = [
                'status' => '0',
                'msg' => 'fail'
            ];
        }

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = Company::findOrFail($id)->delete();

        /* Check the status response */
        if ($res) {
            $data = [
                'status' => '1',
                'msg' => 'success'
            ];
        } else {
            $data = [
                'status' => '0',
                'msg' => 'fail'
            ];
        }

        /* Return the response as json */
        return response()->json($data);
    }
}
