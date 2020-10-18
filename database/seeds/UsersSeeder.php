<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Admin role
        $adminRole = new Role();
        $adminRole->name = "admin"; 
        $adminRole->display_name = "Admin";
        $adminRole->save();

        // Create Member role
        $pengadaanRole = new Role();
        $pengadaanRole->name = "pengadaan";
        $pengadaanRole->display_name = "Pengadaan";
        $pengadaanRole->save();

        $unitKerjaRole = new Role();
        $unitKerjaRole->name = "unit k3";
        $unitKerjaRole->display_name = "Unit K3";
        $unitKerjaRole->save();
 
        // Create Admin sample
        $admin = new User();
        $admin->name = 'Admin';
        $admin->email = 'admin@jseaperuri';
        
        $admin->password = bcrypt('admin123');
        $admin->avatar = "admin_avatar.jpg";
        $admin->is_verified = 1;
        $admin->save();
        $admin->attachRole($adminRole);

        // Create Sample member
        $pengadaan = new User();
        $pengadaan->name = 'Pengadaan';
        $pengadaan->email = 'pengadaan@jseaperuri'; 
        $pengadaan->password = bcrypt('pengadaan123');
        $pengadaan->avatar = "operator_avatar.png";
        $pengadaan->is_verified = 1;
        $pengadaan->save();
        $pengadaan->attachRole($pengadaanRole);

        $uk = new User();
        $uk->name = 'Unit K3';
        $uk->email = 'unitk3@jseaperuri';
        
        $uk->password = bcrypt('unitk3123');
        $uk->avatar = "operator_avatar.png";
        $uk->is_verified = 1;
        $uk->save();
        $uk->attachRole($unitKerjaRole);
 

      
    }
}
