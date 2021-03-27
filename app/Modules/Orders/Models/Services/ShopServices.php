<?php
/**
 * Copyright (c) 2020. Electric
 */

namespace App\Modules\Orders\Models\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;

use App\Modules\Orders\Models\Repositories\Contracts\ShopsInterface;
use App\Modules\Orders\Models\Repositories\Contracts\ShopBankInterface;
use App\Modules\Orders\Models\Repositories\Contracts\ShopAddressInterface;

class ShopServices
{
    protected $_shopsInterface;
    protected $_shopBankInterface;
    protected $_shopAddressInterface;

    public function __construct(ShopsInterface $shopsInterface,
                                ShopBankInterface $shopBankInterface,
                                ShopAddressInterface $shopAddressInterface)
    {

        $this->_shopsInterface = $shopsInterface;
        $this->_shopBankInterface = $shopBankInterface;
        $this->_shopAddressInterface = $shopAddressInterface;
    }

    public function crudStore($request)
    {
        try {
            DB::beginTransaction();

            /** Tạo mới shop */
            $shop = $this->_shopsInterface->create(array(
                'phone' => $request->input('phone'),
                'email' => $request->input('email'),
                'name' => $request->input('name'),
                'address' => $request->input('address', '') ?: '',
                'password' => $request->input('password')
            ));

            /** Add thông tin ngân hàng cho shop */
            $request->merge(array('id' => $shop->id));
            $this->_shopBankInterface->create(array(
                'id' => $shop->id,
                'bank_name' => $request->input('bank_name', '') ?: '',
                'bank_branch' => $request->input('bank_branch', '') ?: '',
                'cycle_cod' => $request->input('cycle_cod', '') ?: '',
                'stk_name' => $request->input('stk_name', '') ?: '',
                'stk' => $request->input('stk', '') ?: ''
            ));


            if ($request->has('addName')) {
                $addName = $request->input('addName');
                $addPhone = $request->input('addPhone');
                $addAddress = $request->input('addAddress');
                $addProvinces = $request->input('addProvinces');
                $addDistricts = $request->input('addDistricts');
                $addWards = $request->input('addWards');

                foreach ($addName as $key => $name) {
                    $phone = $addPhone[$key];
                    $address = $addAddress[$key];
                    $province = $addProvinces[$key];
                    $district = $addDistricts[$key];
                    $ward = $addWards[$key];

                    if ($name && $phone && $address) {
                        $this->_shopAddressInterface->create(array(
                            'shop_id' => $shop->id,
                            'name' => $name,
                            'phone' => $phone,
                            'address' => $address,
                            'p_id' => $province,
                            'd_id' => $district,
                            'w_id' => $ward
                        ));
                    }
                }
            }
            //
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            $message = $e->getMessage();
            $messageBag = new MessageBag;
            $messageBag->add('error', $message);
            return redirect()->back()->withInput()->withErrors($messageBag);
        }
    }

    public function crudUpdate($request, $id)
    {
        try {
            DB::beginTransaction();
            //
            $shop = $this->_shopsInterface->updateById($id, array(
                'phone' => $request->input('phone'),
                'email' => $request->input('email'),
                'name' => $request->input('name'),
                'address' => $request->input('address', '') ?: ''
            ));

            $this->_shopBankInterface->updateById($id, array(
                'bank_name' => $request->input('bank_name', '') ?: '',
                'bank_branch' => $request->input('bank_branch', '') ?: '',
                'cycle_cod' => $request->input('cycle_cod', '') ?: '',
                'stk_name' => $request->input('stk_name', '') ?: '',
                'stk' => $request->input('stk', '') ?: ''
            ));

            $addIds = $request->input('addIds');
            $checkExists = $this->_shopAddressInterface->checkExist(array('shop_id' => $id));
            if ($addIds) {
                if ($checkExists !== count($addIds)) {
                    $this->_shopAddressInterface->delByCond(array('id_not_in' => $addIds));
                }
            } else {
                if ($checkExists) {
                    // delete all address by shop
                    $this->_shopAddressInterface->delByCond(array('shop_id' => $id));
                }
            }

            if ($request->has('addName')) {
                $addIds = $request->input('addIds');
                $addName = $request->input('addName');
                $addPhone = $request->input('addPhone');
                $addAddress = $request->input('addAddress');
                $addProvinces = $request->input('addProvinces');
                $addDistricts = $request->input('addDistricts');
                $addWards = $request->input('addWards');

                foreach ($addName as $key => $name) {
                    $phone = $addPhone[$key];
                    $address = $addAddress[$key];
                    $province = $addProvinces[$key];
                    $district = $addDistricts[$key];
                    $ward = $addWards[$key];

                    if (isset($addIds[$key])) {
                        $this->_shopAddressInterface->updateById($addIds[$key], array(
                            'name' => $name,
                            'phone' => $phone,
                            'address' => $address,
                            'p_id' => $province,
                            'd_id' => $district,
                            'w_id' => $ward
                        ));
                    } else {
                        if ($name && $phone && $address) {
                            $this->_shopAddressInterface->create(array(
                                'shop_id' => $shop->id,
                                'name' => $name,
                                'phone' => $phone,
                                'address' => $address,
                                'p_id' => $province,
                                'd_id' => $district,
                                'w_id' => $ward
                            ));
                        }
                    }
                }
            }
            //
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            $message = $e->getMessage();
            $messageBag = new MessageBag;
            $messageBag->add('error', $message);
            return redirect()->back()->withInput()->withErrors($messageBag);
        }
    }
}
