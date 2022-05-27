<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCountryRequest;
use App\Http\Requests\StoreCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use App\Models\Country;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CountryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Country::query()->select(sprintf('*', (new Country())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'country_show';
                $editGate = 'country_edit';
                $deleteGate = 'country_delete';
                $crudRoutePart = 'countries';

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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.countries.index');
    }

    public function create()
    {
        return view('admin.countries.create');
    }

    public function store(Request $request)
    {
        $countryExist = Country::where('name',$request->name)->where('name_ar',$request->name_ar)->first();
        if($countryExist){
            session()->flash('messageError','Country is alreay exist');
            return redirect()->route('dashboard.countries.index');
        }
        else{
        $country = Country::create($request->all());
        session()->flash('message','Country'.' '.trans('custom_messages.general.saved'));
        return redirect()->route('dashboard.countries.index');
        }
    }

    public function edit(Country $country)
    {

        return view('admin.countries.edit', compact('country'));
    }

    public function update(Request $request, Country $country)
    {
        $country->update($request->all());
        session()->flash('message','Country'.' '.trans('custom_messages.general.updated'));
        return redirect()->route('dashboard.countries.index');
    }

    public function show(Country $country)
    {

        return view('admin.countries.show', compact('country'));
    }

    public function destroy(Country $country)
    {
        $country->delete();
        session()->flash('message','Country'.' '.trans('custom_messages.general.deleted'));
        return redirect()->route('dashboard.countries.index');
    }

    public function massDestroy(MassDestroyCountryRequest $request)
    {
        Country::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
