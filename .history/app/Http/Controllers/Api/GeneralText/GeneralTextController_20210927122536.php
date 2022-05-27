<?php

namespace App\Http\Controllers\Api\GeneralText;

use App\Http\Controllers\Controller;
use App\Models\GeneralSentence;
use App\Models\GeneralText;
use App\Traits\GeneralFunction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Nyholm\Psr7\Request as Psr7Request;

class GeneralTextController extends Controller
{
    use GeneralFunction;
    public function __construct()
    {
        $this->changeLang(request()->header('lang-app'));
    }
    public function index()
    {
        try {
            $data = GeneralText::query()->where('key',request('key_text'))->first();
            return $this->sendSuccessResponse($data);

        } catch (\Exception $ex) {
            return response()->json(['status' => false, 'message' => $ex->getMessage()], 500);
        }
    }


    public function indexSentence()
    {
        try {
             $query = GeneralSentence::query()->where('is_deleted', 0)->where('key',request('key'));
             request('with_paginate') == "yes" ?$data = $query->paginate(8) : $data = $query->get();
            return $this->sendSuccessResponse($data);
        } catch (\Exception $ex) {
            return $this->sendErrors($ex);
        }
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
        //
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
