<?php
/**
 * Copyright (c) 2020. Electric
 */

namespace App\Modules\Operators\Controllers\Web;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Web\AbstractWebController;
use App\Modules\Operators\Models\Repositories\Contracts\ProvincesInterface;

class ProvincesController extends AbstractWebController
{

    protected $_provincesInterface;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ProvincesInterface $provincesInterface)
    {
        parent::__construct();

        $this->_provincesInterface = $provincesInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provinces = $this->_provincesInterface->getMore(array(), array('with' => array('districts')));

        return view('Operators::provinces.list', ['provinces' => $provinces]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Operators::provinces.create');
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
            'zone' => 'required|in:bac,trung,nam',
            'code' => 'required|max:10|unique:zone_provinces,code',
            'name' => 'required|max:255',
            'short_name' => 'required|max:10'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $this->_provincesInterface->create($request->all());
        $request->session()->flash('message', 'Successfully created province');
        return redirect()->route('provinces.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $province = $this->_provincesInterface->getById($id);
        return view('Operators::provinces.show', ['province' => $province]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $province = $this->_provincesInterface->getById($id);
        return view('Operators::provinces.edit', ['province' => $province]);
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
            'code' => 'required|max:10|unique:zone_provinces,code,' . $id,
            'name' => 'required|max:255',
            'short_name' => 'required|max:10'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $this->_provincesInterface->updateById($id, $request->all());
        $request->session()->flash('message', 'Successfully edited province');
        return redirect()->route('provinces.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $province = $this->_provincesInterface->getById($id);
        if ($province) {
            $province->delete();
        }
        return redirect()->route('provinces.index');
    }
}
