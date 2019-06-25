<?php

use Illuminate\Database\Seeder;

class CourseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //使用 faker 实现大量数据的模拟
        $faker = \Faker\Factory::create('zh_CN');

        //填充20条数据
        for ($i=0; $i < 15; $i++) { 
            Illuminate\Support\Facades\DB::table('courses')->insert([
                'pro_id' => rand(1,4),
                'course_name' => $faker->company,
                'course_price' => $faker->randomFloat(2,10,100),
                'cover_img' => $faker->imageUrl(),
                'course_desc' => $faker->catchPhrase
            ]);
        }
    }
}
