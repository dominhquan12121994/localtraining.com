<?php
/**
 * Copyright (c) 2020. Electric
 */

namespace App\Modules\Orders\Controllers\Web;

use Illuminate\Support\Facades\Auth;
use Validator;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Web\AbstractWebController;
use App\Modules\Orders\Constants\ShopConstant;

/**  */
use App\Modules\Orders\Models\Repositories\Contracts\OrdersInterface;
use App\Modules\Orders\Models\Repositories\Contracts\ShopsInterface;
use App\Modules\Orders\Models\Repositories\Contracts\ShopBankInterface;
use App\Modules\Orders\Models\Repositories\Contracts\ShopAddressInterface;

/**  */
use App\Modules\Operators\Models\Repositories\Contracts\WardsInterface;
use App\Modules\Operators\Models\Repositories\Contracts\DistrictsInterface;
use App\Modules\Operators\Models\Repositories\Contracts\ProvincesInterface;

use App\Modules\Orders\Models\Services\ShopServices;

class OrdersController extends AbstractWebController
{

    protected $_ordersInterface;
    protected $_shopsInterface;
    protected $_shopBankInterface;
    protected $_shopAddressInterface;
    protected $_provincesInterface;
    protected $_districtsInterface;
    protected $_wardsInterface;
    protected $_shopServices;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(OrdersInterface $ordersInterface,
                                ShopsInterface $shopsInterface,
                                ShopBankInterface $shopBankInterface,
                                ShopAddressInterface $shopAddressInterface,
                                ProvincesInterface $provincesInterface,
                                DistrictsInterface $districtsInterface,
                                WardsInterface $wardsInterface,
                                ShopServices $shopServices)
    {
        parent::__construct();

        $this->_ordersInterface = $ordersInterface;
        $this->_shopsInterface = $shopsInterface;
        $this->_shopBankInterface = $shopBankInterface;
        $this->_shopAddressInterface = $shopAddressInterface;
        $this->_provincesInterface = $provincesInterface;
        $this->_districtsInterface = $districtsInterface;
        $this->_wardsInterface = $wardsInterface;
        $this->_shopServices = $shopServices;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = $this->_ordersInterface->getMore(array(), array(), 10);

        return view('Orders::orders.list', ['orders' => $orders]);
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
        $wards = $this->_wardsInterface->getMore(array('d_id' => $districts[0]->id));

        return view('Orders::orders.create', [
            'provinces' => $provinces,
            'districts' => $districts,
            'wards' => $wards
        ]);
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
            'phone' => 'required|unique:order_shops',
            'email' => 'required|unique:order_shops',
            'name' => 'required|max:255',
            'password' => 'required|confirmed|min:6'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        $this->_shopServices->crudStore($request);

        $request->session()->flash('message', 'Successfully created shop');
        return redirect()->route('shops.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $shop = $this->_shopsInterface->getById($id);

        return view('Orders::shops.show', ['shop' => $shop]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $addDistricts = $addWards = array();
        $shop = $this->_shopsInterface->getById($id);
        $shopBank = $this->_shopBankInterface->getById($id);
        $shopAddress = $this->_shopAddressInterface->getMore(array('shop_id' => $id));
        if (count($shopAddress) > 0) {
            foreach ($shopAddress as $key => $address) {
                $addDistricts[$key] = $this->_districtsInterface->getMore(array('p_id' => $address->p_id));
                $addWards[$key] = $this->_wardsInterface->getMore(array('d_id' => $address->d_id));
            }
        }

        $provinces = $this->_provincesInterface->getMore();
        $districts = $this->_districtsInterface->getMore(array('p_id' => $provinces[0]->id));
        $wards = $this->_wardsInterface->getMore(array('d_id' => $districts[0]->id));

        return view('Orders::shops.edit', [
            'shop' => $shop,
            'shopBank' => $shopBank,
            'shopAddress' => $shopAddress,
            'provinces' => $provinces,
            'districts' => $districts,
            'wards' => $wards,
            'addWards' => $addWards,
            'addDistricts' => $addDistricts,
            'cycleCodList' => ShopConstant::bank['cycle_cod']
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
            'phone' => 'required|unique:order_shops,phone,' . $id,
            'email' => 'required|unique:order_shops,email,' . $id,
            'name' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $this->_shopServices->crudUpdate($request, $id);

        $request->session()->flash('message', 'Successfully edited shop');
        return redirect()->route('shops.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shop = $this->_shopsInterface->getById($id);
        if ($shop) {
            $shop->delete();
        }
        return redirect()->route('shops.index');
    }
}
