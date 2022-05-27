<?php

namespace App\Http\Controllers\Dashboard\Vessel;

use App\Http\Controllers\Controller;
use App\Models\Vessel;
use Illuminate\Http\Request;

class VesselController extends Controller
{


    private $view_index = 'dashboard.vessel.index';
    private $view_edit  = 'admin.pages.product.create';
    private $route      = 'vessel';
    private $model      =  Vessel::class;
    private $pageTitle  = 'vessel';

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


     
    public function index()
    {
        $paginate  =  request('paginate_count') > 0?  request('paginate_count') : 8;

        $data = $this->model::query()->
       

        when(request('date'),function ($q) {
            $q->whereDate('created_at',request('date'));
        })
       ->paginate($paginate);
       $route = $this->route;
        return view($this->view_index,compact('data','route'));

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
