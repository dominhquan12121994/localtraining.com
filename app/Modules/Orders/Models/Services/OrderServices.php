<?php
/**
 * Copyright (c) 2020. Electric
 */

namespace App\Modules\Orders\Models\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;

use App\Modules\Orders\Models\Repositories\Contracts\OrdersInterface;
use App\Modules\Orders\Models\Repositories\Contracts\ShopsInterface;
use App\Modules\Orders\Models\Repositories\Contracts\ShopBankInterface;
use App\Modules\Orders\Models\Repositories\Contracts\ShopAddressInterface;

class OrderServices
{
    protected $_ordersInterface;
    protected $_shopsInterface;
    protected $_shopBankInterface;
    protected $_shopAddressInterface;

    public function __construct(OrdersInterface $ordersInterface,
                                ShopsInterface $shopsInterface,
                                ShopBankInterface $shopBankInterface,
                                ShopAddressInterface $shopAddressInterface)
    {

        $this->_ordersInterface = $ordersInterface;
        $this->_shopsInterface = $shopsInterface;
        $this->_shopBankInterface = $shopBankInterface;
        $this->_shopAddressInterface = $shopAddressInterface;
    }
}
