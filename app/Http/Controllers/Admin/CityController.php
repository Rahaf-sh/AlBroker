<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCityRequest;
use App\Http\Requests\StoreCityRequest;
use App\Http\Requests\UpdateCityRequest;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CityController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $query = City::with(['country'])->select(sprintf('*', (new City())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'city_show';
                $editGate = 'city_edit';
                $deleteGate = 'city_delete';
                $crudRoutePart = 'cities';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->addColumn('country_name', function ($row) {
                return $row->country ? $row->country->name : '';
            });

            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'country']);

            return $table->make(true);
        }

        return view('admin.cities.index');
    }

    public function create()
    {

        $countries = Country::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.cities.create', compact('countries'));
    }

    public function store(Request $request)
    {
        $cityExist = City::where('country_id',$request->country_id)->where('name',$request->name)->where('name_ar',$request->name_ar)->first();
        if($cityExist){
            session()->flash('messageError','City is alreay exist');
            return redirect()->route('dashboard.cities.index');
        }
        else{
        $city = City::create($request->all());
        session()->flash('message','City'.' '.trans('custom_messages.general.saved'));
        return redirect()->route('dashboard.cities.index');
        }

    }

    public function edit(City $city)
    {

        $countries = Country::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $city->load('country');

        return view('admin.cities.edit', compact('countries', 'city'));
    }

    public function update(Request $request, City $city)
    {
        $city->update($request->all());
        session()->flash('message','City'.' '.trans('custom_messages.general.updated'));
        return redirect()->route('dashboard.cities.index');
    }

    public function show(City $city)
    {

        $city->load('country');

        return view('admin.cities.show', compact('city'));
    }

    public function destroy(City $city)
    {

        $city->delete();
        session()->flash('message','City'.' '.trans('custom_messages.general.deleted'));
        return redirect()->route('dashboard.cities.index');
    }

   
}
