<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Illuminate\Support\Facades\DB::select("INSERT INTO `roles` VALUES ('1', '超级管理员', '超级管理员最高权限,牛逼', '2019-06-19 13:07:27', null)");
    }
}
