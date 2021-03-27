<?php

namespace App\Modules\Orders\Constants;

/**
 * Class ShopConstant
 * @package App\Modules\Orders\Constants
 * @author HuyDien <huydien.it@gmail.com>
 */
class ShopConstant
{
    const bank = [
        'cycle_cod' => [
            '1_time_week' => 'Đối soát 1 lần/tuần',
            'payment_twice_per_week_odd' => 'Đối soát 2 lần/tuần thứ 3/5',
            'payment_3times_per_week' => 'Đối soát 3 lần/tuần vào thứ 2/4/6',
            'payment_once_per_month' => 'Đối soát 1 lần/tháng vào ngày cuối cùng của tháng',
            'payment_twice_per_month' => 'Đối soát 2 lần/tháng vào ngày 15 và ngày cuối cùng của tháng',
            'payment_by_amount_money' => 'Chỉ đối soát khi cộng dồn đủ số tiền (tùy chọn)',
        ]
    ];
}