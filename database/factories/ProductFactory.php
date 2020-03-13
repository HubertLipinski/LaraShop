<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;

$factory->define(Product::class, function (Faker $faker) {

    $images = [
        'https://i.picsum.photos/id/273/1080/1024.jpg',
        'https://loremflickr.com/cache/resized/65535_49501045872_adca9e4ec6_h_1080_1024_nofilter.jpg',
        'https://i.picsum.photos/id/487/640/480.jpg',
        'https://loremflickr.com/cache/resized/65535_49087469068_0ebda2ba4f_z_640_360_nofilter.jpg',
        'https://www.placecage.com/640/360',
        'https://fakeimg.pl/640x360',
        'https://fakeimg.pl/1080x1024',
        'https://i.picsum.photos/id/26/1080/1024.jpg',
        'https://i.picsum.photos/id/316/1080/1024.jpg',
        'https://i.picsum.photos/id/1078/1080/1024.jpg',
        'https://i.picsum.photos/id/1080/1080/1024.jpg',
        'https://i.picsum.photos/id/1032/1080/1024.jpg',
    ];

    $items = Arr::random($images, random_int(1,5));

    return [
        'user_id' => 1,
        'name' => $faker->sentence(6, true),
        'price' => $faker->numberBetween(10, 150),
        'description' => $faker->paragraph(10),
        'thumbnail' => json_encode($items),
    ];
});
