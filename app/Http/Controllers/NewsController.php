<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actuality;
use App\Http\Resources\NewsController as ResourcesNewsController;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = Actuality::orderByDesc('created_at')->get();
        return response()->json($news);

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
    public function store(Request $request)
    {

        $request->validate([
            'title' =>'required|string',
            'text' =>'required',
            'company_id' => 'required|int'

        ]);

        $news = [
            'title' => $request->input ('title'),
            'text' => $request->input ('text'),
            'company_id' => $request->input ('company_id'),


        ];
        Actuality::create($news);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
            $news = Actuality::findOrFail($id);
            return response()->json($news);
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

            $res = Actuality::findOrFail($id)->delete();

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

    public function findByCompanyId($companyId)
    {
        $actualites = Actuality::where('company_id', $companyId)->get();

        return response($actualites);
    }
}
