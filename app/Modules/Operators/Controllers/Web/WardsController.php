<?php
/**
 * Copyright (c) 2020. Electric
 */

namespace App\Modules\Operators\Controllers\Web;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Web\AbstractWebController;
use App\Modules\Operators\Models\Repositories\Contracts\WardsInterface;
use App\Modules\Operators\Models\Repositories\Contracts\DistrictsInterface;
use App\Modules\Operators\Models\Repositories\Contracts\ProvincesInterface;

class WardsController extends AbstractWebController
{

    protected $_provincesInterface;
    protected $_districtsInterface;
    protected $_wardsInterface;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ProvincesInterface $provincesInterface,
                                DistrictsInterface $districtsInterface,
                                WardsInterface $wardsInterface)
    {
        parent::__construct();

        $this->_provincesInterface = $provincesInterface;
        $this->_districtsInterface = $districtsInterface;
        $this->_wardsInterface = $wardsInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $districts = array();
        $arrFilter = array('p_id' => 0, 'd_id' => 0, 'name' => '');
        if ($request->has('p')) {
            $arrFilter['p_id'] = (int)$request->input('p');
            if ($arrFilter['p_id'] > 0) {
                $districts = $this->_districtsInterface->getMore(array('p_id' => $arrFilter['p_id']));
            }
        }
        if ($request->has('d')) {
            $arrFilter['d_id'] = (int)$request->input('d');
        }
        if ($request->has('n')) {
            $arrFilter['name'] = $request->input('n');
        }

        $provinces = $this->_provincesInterface->getMore();
        $wards = $this->_wardsInterface->getMore($arrFilter, array('with' => array('provinces', 'districts')), 10);

        return view('Operators::wards.list', ['wards' => $wards, 'provinces' => $provinces, 'districts' => $districts, 'arrFilter' => $arrFilter]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provinces = $this->_provincesInterface->getMore();
        $districts = $this->_districtsInterface->getMore(array('p_id' => $provinces[0]->id));
        return view('Operators::wards.create', ['provinces' => $provinces, 'districts' => $districts]);
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
            'p_id' => 'required',
            'd_id' => 'required',
            'code' => 'required|max:10|unique:zone_wards,code',
            'name' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $this->_wardsInterface->create($request->all());
        $request->session()->flash('message', 'Successfully created ward');
        return redirect()->route('wards.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ward = $this->_wardsInterface->getById($id);
        return view('Operators::wards.show', ['ward' => $ward]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ward = $this->_wardsInterface->getById($id);
        $provinces = $this->_provincesInterface->getMore();
        $districts = $this->_districtsInterface->getMore(array('p_id' => $ward->p_id));
        return view('Operators::wards.edit', ['ward' => $ward, 'provinces' => $provinces, 'districts' => $districts]);
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
            'zone' => 'required|in:bac,trung,nam',
            'code' => 'required|max:10|unique:zone_wards,code,' . $id,
            'name' => 'required|max:255',
            'short_name' => 'required|max:10'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $this->_wardsInterface->updateById($id, $request->all());
        $request->session()->flash('message', 'Successfully edited ward');
        return redirect()->route('wards.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ward = $this->_wardsInterface->getById($id);
        if ($ward) {
            $ward->delete();
        }
        return redirect()->route('wards.index');
    }
}
