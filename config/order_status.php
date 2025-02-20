<?php

return [
  "order_status_admin" => [
    "pending" => [
      "status" => "Đang xử lý",
      "detail" => "Đơn hàng đang được hệ thống xử lý"
    ],
    // "processed_and_ready_to_ship" => [
    //   "status" => "Đơn hàng sẵn sàng được vận chuyển",
    //   "detail" => "Đơn hàng đã được chuẩn bị sẵn sàng để vận chuyển"
    // ],
    "dropped_off" => [
      "status" => "Đơn hàng đã đến kho vận chuyển",
      "detail" => "Đơn hàng đã được đưa đến kho vận chuyển"
    ],
    "shipped" => [
      "status" => "Đơn hàng đã được vận chuyển đi",
      "detail" => "Đơn hàng đã được vận chuyển đến điểm kế tiếp"
    ],
    "out_for_delivery" => [
      "status" => "Đơn hàng đang giao đến khách hàng",
      "detail" => "Đơn hàng đang trên đường giao đến khách hàng"
    ],
    "delivered" => [
      "status" => "Đơn hàng đã được giao",
      "detail" => "Đơn hàng đã được giao đến khách hàng"
    ],
    "cancelled" => [
      "status" => "Đơn hàng đã bị hủy",
      "detail" => "Đơn hàng đã bị hủy"
    ],
    // "refunded" => [
    //   "status" => "Đơn hàng đã được hoàn trả",
    //   "detail" => "Đơn hàng đã được hoàn trả"
    // ]
  ],

  "order_status_vendor" => [
    "pending" => [
      "status" => "Đang xử lý",
      "detail" => "Đơn hàng đang được hệ thống xử lý"
    ],
    "processed_and_ready_to_ship" => [
      "status" => "Đơn hàng sẵn sàng được vận chuyển",
      "detail" => "Đơn hàng đã được chuẩn bị sẵn sàng để vận chuyển"
    ],
  ]
];