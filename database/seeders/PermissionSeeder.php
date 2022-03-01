<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Carbon\Carbon;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Room;
use App\Models\Session;
use App\Models\Slot;
use App\Models\Register;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;


class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            [
                'name' => 'Add Role',
                'guard_name' => 'web',
            ],
            [
                'name' => 'View Role',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Edit Role',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Delete Role',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Add User',
                'guard_name' => 'web',
            ],
            [
                'name' => 'View User',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Edit User',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Delete User',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Add Register',
                'guard_name' => 'web',
            ],
            [
                'name' => 'View Register',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Edit Register',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Delete Register',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Add Teacher',
                'guard_name' => 'web',
            ],
            [
                'name' => 'View Teacher',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Edit Teacher',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Delete Teacher',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Add Room',
                'guard_name' => 'web',
            ],
            [
                'name' => 'View Room',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Edit Room',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Delete Room',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Assign Teacher',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Add Session',
                'guard_name' => 'web',
            ],
            [
                'name' => 'View Session',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Edit Session',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Delete Session',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Add/Edit Slot',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Allocate Session',
                'guard_name' => 'web',
            ],
        ]);

        $super_admin = Role::create(['name' => 'Super Admin',
                                        'description' => 'This Role has Complete Authority, Not Modifiable',    
        ]);
        User::find(1)->assignRole($super_admin);

        $admin = Role::create(['name' => 'Admin',
                            'description' => 'This is the role with custom permissions',        
        ]);

        $admin->syncPermissions([   'View Register',
                                    'Add Register',
                                    'Edit Register',
                                    'Delete Register',
                                    'View Teacher',
                                    'Add Teacher',
                                    'Edit Teacher',
                                    'Delete Teacher',
                                    'View Room', 
                                    'Add Room',
                                    'Edit Room', 
                                    'Delete Room',
                                    'Assign Teacher', 
                                    'View Session', 
                                    'Add Session',
                                    'Edit Session', 
                                    'Delete Session',
                                    'Add/Edit Slot', 
                                    'Allocate Session',
        ]);
        
        $faker = Faker::create();
    	foreach (range(1,10) as $index) {
            $user = User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => Hash::make('password123'),
            ]);

            $user->assignRole($admin);
        }

        foreach (range(1,10) as $index) {
            Teacher::create([
                'name' => $faker->name($gender = 'female'),
            ]);
        }

        foreach (range(1,10) as $index) {
            Room::create([
                'name' => $faker->words(3, true),
                'capacity'=> $faker->randomDigit(),
            ]);
        }

        foreach (range(1,10) as $index) {
            Register::create([
                'child_name' => $faker->firstName,
                'child_date_of_birth' => Carbon::instance($faker->dateTimeBetween('-10 years','-1 years')),
                'family1_name' => $faker->name,
            ]);
        }

        foreach (range(1,5) as $index) {
            Session::create([
                'name' => $faker->words(1, true),
            ]);
            
            foreach (range(1,$faker->randomDigit()) as $index1) {
                Slot::create([
                    'day' => $faker->dayOfWeek(),
                    'start' => $faker->time(),
                    'end' => $faker->time(),
                    'session_id' => $index,
                ]);
            }
        }
    }
}
