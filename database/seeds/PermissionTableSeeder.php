<?php

use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //使用 faker 实现大量数据的模拟
        $faker = \Faker\Factory::create();  //'zh_CN'

        //填充权限
        Illuminate\Support\Facades\DB::select("
        INSERT INTO `permissions` VALUES ('1', '管理员管理', '', '', '0', '1', '1', '1', '2019-06-19 12:45:54', null);
        INSERT INTO `permissions` VALUES ('2', '管理员列表', '/admin/manager', 'manager-index', '1', '1', '1', '2', '2019-06-19 12:49:57', null);
        INSERT INTO `permissions` VALUES ('3', '创建管理员store', '/admin/manager', 'manager-store', '2', '1', '1', '3', '2019-06-19 12:50:37', null);
        INSERT INTO `permissions` VALUES ('4', '管理员创建create', '/admin/manager/create', 'manager-create', '2', '1', '1', '3', '2019-06-19 12:51:10', null);
        INSERT INTO `permissions` VALUES ('5', '管理员更新', '/admin/manager/{manager}', 'manager-update', '2', '1', '1', '3', '2019-06-19 12:51:48', null);
        INSERT INTO `permissions` VALUES ('6', '管理删除', '/admin/manager/{manager}', 'manager-destroy', '2', '1', '1', '3', '2019-06-19 12:52:38', null);
        INSERT INTO `permissions` VALUES ('7', '管理员编辑edit', '/admin/manager/{manager}/edit', 'manager-edit', '2', '1', '1', '3', '2019-06-19 12:53:11', null);
        INSERT INTO `permissions` VALUES ('8', '密码修改do', '/admin/password', 'manager-dopassword', '2', '1', '1', '3', '2019-06-19 12:54:17', null);
        INSERT INTO `permissions` VALUES ('9', '密码修改view', '/admin/password', 'manager-password', '2', '1', '1', '3', '2019-06-19 12:54:54', null);
        INSERT INTO `permissions` VALUES ('10', '权限列表', '/admin/permission', 'permission-index', '1', '1', '1', '2', '2019-06-19 12:56:11', null);
        INSERT INTO `permissions` VALUES ('11', '权限创建store', '/admin/permission', 'permission-store', '10', '1', '1', '3', '2019-06-19 12:56:42', null);
        INSERT INTO `permissions` VALUES ('12', '权限创建create', '/admin/permission/create', 'permission-create', '10', '1', '1', '3', '2019-06-19 12:57:18', null);
        INSERT INTO `permissions` VALUES ('13', '权限更新', '/admin/permission/{permission}', 'permission-update', '10', '1', '1', '3', '2019-06-19 12:57:47', null);
        INSERT INTO `permissions` VALUES ('14', '权限删除', '/admin/permission/{permission}', 'permission-destroy', '10', '1', '1', '3', '2019-06-19 12:58:14', null);
        INSERT INTO `permissions` VALUES ('15', '权限编辑view', 'admin/permission/{permission}/edit', 'permission-edit', '10', '1', '1', '3', '2019-06-19 12:58:56', null);
        INSERT INTO `permissions` VALUES ('16', 'reset', '/admin/reset', 'manager-reset', '2', '1', '1', '3', '2019-06-19 12:59:28', null);
        INSERT INTO `permissions` VALUES ('17', '角色列表', '/admin/role', 'role-index', '1', '1', '1', '2', '2019-06-19 12:59:51', '2019-06-19 13:01:43');
        INSERT INTO `permissions` VALUES ('18', '角色创建store', 'admin/role', 'role-store', '17', '1', '1', '3', '2019-06-19 13:00:42', '2019-06-19 13:01:56');
        INSERT INTO `permissions` VALUES ('19', '角色创建create', '/admin/role/create', 'role-create', '17', '1', '1', '3', '2019-06-19 13:01:35', '2019-06-19 13:02:02');
        INSERT INTO `permissions` VALUES ('20', '角色分配权限', '/admin/role/permission/{role?}', 'role-allocation', '17', '1', '1', '3', '2019-06-19 13:03:01', null);
        INSERT INTO `permissions` VALUES ('21', '角色删除', '/admin/role/{role}', 'role-destroy', '17', '1', '1', '3', '2019-06-19 13:03:40', null);
        INSERT INTO `permissions` VALUES ('22', '角色更新', '/admin/role/{role}', 'role-update', '17', '1', '1', '3', '2019-06-19 13:04:08', null);
        INSERT INTO `permissions` VALUES ('23', '角色编辑edit', '/admin/role/{role}/edit', 'role-edit', '17', '1', '1', '3', '2019-06-19 13:04:44', null);
        INSERT INTO `permissions` VALUES ('24', '功能权限', '', '', '0', '1', '2', '1', '2019-06-19 13:05:28', '2019-06-19 13:05:36');
        INSERT INTO `permissions` VALUES ('25', '图片上传', '/admin/upload/image', 'upload-image', '24', '1', '2', '2', '2019-06-19 13:06:19', null);
        INSERT INTO `permissions` VALUES ('26', '视频上传', '/admin/upload/video', 'upload-video', '24', '1', '2', '2', '2019-06-19 13:06:50', null);
        INSERT INTO `permissions` VALUES ('27', '管理分配角色', '/ admin/allocation/{manager?}', 'manager-allocation', '2', '1', '1', '3', '2019-06-19 13:10:10', null);
        ");
        
    }
}
