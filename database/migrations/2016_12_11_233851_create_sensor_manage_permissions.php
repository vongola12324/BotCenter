<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Permission;
use App\Role;

class CreateSensorManagePermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $permSensorManage = Permission::create([
            'name'         => 'sensor.manage',
            'display_name' => '管理感測器',
            'description'  => '新增、修改、刪除感測器',
        ]);

        $admin = Role::where('name', 'admin')->first();
        $admin->attachPermission($permSensorManage);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Permission::where('name', 'sensor.manage')->delete();
    }
}
