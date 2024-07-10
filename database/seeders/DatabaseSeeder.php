<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Room;
use App\Models\User;
use App\Models\Breakfast;
use App\Models\Floor;
use App\Models\Guest;
use App\Models\RoomType;
use App\Models\Accupation;
use App\Models\StatusRoom;
use App\Models\TravelAgent;
use App\Models\PriceRateType;
use App\Models\AdditionalItem;
use App\Models\TransactionRoom;
use Illuminate\Database\Seeder;
use App\Models\SourceTravelAgent;
use App\Models\DetilRoomAmanities;
use App\Models\TransactionSewaRoom;
use App\Models\DetilTransactionRoomItem;
use App\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        StatusRoom::create([
            'name' => 'Terisi',
            'main_status' => '1',
        ]);
        StatusRoom::create([
            'name' => 'Ready',
            'main_status' => '2',
        ]);
        StatusRoom::create([
            'name' => 'Sedang di bersihkan',
            'main_status' => '3',
        ]);
        StatusRoom::create([
            'name' => 'Kosong',
            'main_status' => '4',
        ]);

        Floor::create([
            'name' => 'Lantai 1',
            'alias' => 'LT1',
            'description' => 'Lantai 2'
        ]);


        Floor::create([
            'name' => 'Lantai 2',
            'alias' => 'LT2',
            'description' => 'Lantai 2'
        ]);

        Floor::create([
            'name' => 'Lantai 3',
            'alias' => 'LT3',
            'description' => 'Lantai 3'
        ]);

        RoomType::create([
            'name' => 'Reguler',
            'base_adult' => '2',
            'base_child' => '2'
        ]);

        RoomType::create([
            'name' => 'VIP',
            'base_adult' => '1',
            'base_child' => '0'
        ]);
        

        TravelAgent::create([
            'name' => 'Aplikasi',
        ]);

        Accupation::create([
            'name' => 'Programmer'
        ]);

        $data =['1', '2', '3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21'];
        $jsonData = json_encode($data);

        Role::create([
            'name' => 'Super Admin',
            'premission' => $jsonData
        ]);

        Role::create([
            'name' => 'Guest'
        ]);

        Role::create([
            'name' => 'OB'
        ]);


        User::create([
            'full_name' => 'HandlerOne',
            'email' => 'HandlerOne@gmail.com',
            'password' => bcrypt('12345'),
            'user_type' => 'admin',
            'role_id' => 1,
        ]);

        User::create([
            'full_name' => 'HandlerOne',
            'email' => 'aldinkaisar45222@gmail.com',
            'password' => bcrypt('12345'),
            'user_type' => 'OB',
            'role_id' => 3,
        ]);
        
        Breakfast::create([
            'name' => 'Not include breakfast',
            'total_price' => '0',
        ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
