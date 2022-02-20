<?php

namespace Database\Seeders;

use App\Models\TypeOfUser;
use Illuminate\Database\Seeder;

class TypeOfUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $manager = new TypeOfUser();
        $manager->type_name = 'Rukovodilac';
        $manager->save();

        $user = new TypeOfUser();
        $user->type_name = 'Izvrsilac';
        $user->save();
    }
}
