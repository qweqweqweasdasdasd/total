<?php

use Illuminate\Database\Seeder;

class TeacherTableSeeder extends Seeder
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
        for ($i=0; $i < 20; $i++) { 
            Illuminate\Support\Facades\DB::table('teachers')->insert([
                'teacher_name' => $faker->name,
                'teacher_phone' => $faker->phoneNumber,
                'teacher_city' => $faker->city,
                'teacher_address' => $faker->address,
                'teacher_company' => $faker->company,
                'teacher_email' => $faker->email,
                'teacher_pic' => $faker->imageUrl(),
                'teacher_desc' => $faker->catchPhrase
            ]);
        }
    }
}
