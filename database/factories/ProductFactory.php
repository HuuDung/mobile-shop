<?php

use Faker\Generator as Faker;

$factory->define(\App\Product::class, function (Faker $faker) {
    return [
        'category_id' => rand(1,5),
        'name' => $faker->name(),
        'description' => "Hiện nay cuộc sống ngày càng hiện đại và phát triển một cách chóng mặt mà mức sống của con
         người cũng ngày càng tăng cao nhu cầu tiêu dùng cũng khắt khe hơn bởi ai cũng mong muốn lựa chọn dòng sản phẩm
          thật chất lượng thật tốt .Thị trường thì có quá nhiều mặt hàng nhưng phần đông hiện nay khách hàng hướng đến 
          đó chính là dòng gốm sứ bởi tính thẩm mỹ rất cao của nó mà con đa dạng mẫu mã phục vụ không những trong sinh 
          hoạt mà trong trang trí quà tặng.Bạn đang kinh doanh yêu gốm sứ cũng mong muốn sản phẩm gốm sứ đến tay khách
           hàng một cách chất lượng t",
        'cost' => rand(10, 200),
        'quantity' => rand(10, 200),
    ];
});
