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
            'day' => 'string',
            'time' => 'string',

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
        $res = Company::findOrFail($id)->delete();

        /* Check the status response */
        if ($res) {
            $data = [
                'status'=>'1',
                'msg'=>'success'
            ];
        } else {
            $data = [
                'status'=>'0',
                'msg'=>'fail'
            ];
        }

        /* Return the response as json */
        return response()->json($data);
    }
}
