<?php
/**
 * Copyright (c) 2020. Electric
 */

namespace App\Modules\Operators\Controllers\Web;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Web\AbstractWebController;
use App\Modules\Operators\Models\Repositories\Contracts\ProvincesInterface;
use App\Modules\Operators\Models\Repositories\Contracts\DistrictsInterface;

use App\Modules\Systems\Models\Entities\User;
use Spatie\Permission\Models\Permission;

class DistrictsController extends AbstractWebController
{

    protected $_provincesInterface;
    protected $_districtsInterface;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ProvincesInterface $provincesInterface, DistrictsInterface $districtsInterface)
    {
        parent::__construct();

        $this->_provincesInterface = $provincesInterface;
        $this->_districtsInterface = $districtsInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $arrFilter = array('p_id' => 0, 'name' => '');
        if ($request->has('p')) {
            $arrFilter['p_id'] = (int)$request->input('p');
        }
        if ($request->has('n')) {
            $arrFilter['name'] = $request->input('n');
        }

        $provinces = $this->_provincesInterface->getMore();
        $districts = $this->_districtsInterface->getMore($arrFilter, array('with' => array('provinces', 'wards')), 10);

        return view('Operators::districts.list', ['provinces' => $provinces, 'districts' => $districts, 'arrFilter' => $arrFilter]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provinces = $this->_provincesInterface->getMore();
        return view('Operators::districts.create', ['provinces' => $provinces]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|in:noi,ngoai,huyen',
            'code' => 'required|max:10|unique:zone_districts,code',
            'name' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $this->_districtsInterface->create($request->all());
        $request->session()->flash('message', 'Successfully created district');
        return redirect()->route('districts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $district = $this->_districtsInterface->getById($id);
        return view('Operators::districts.show', ['district' => $district]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $provinces = $this->_provincesInterface->getMore();
        $district = $this->_districtsInterface->getById($id);
        return view('Operators::districts.edit', [
            'provinces' => $provinces,
            'district' => $district
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|in:noi,ngoai,huyen',
            'code' => 'required|max:10|unique:zone_districts,code,' . $id,
            'name' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $this->_districtsInterface->updateById($id, $request->all());
        $request->session()->flash('message', 'Successfully edited district');
        return redirect()->route('districts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $district = $this->_districtsInterface->getById($id);
        if ($district) {
            $district->delete();
        }
        return redirect()->route('districts.index');
    }
}
