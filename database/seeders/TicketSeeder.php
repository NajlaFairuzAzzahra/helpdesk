<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ticket;
use App\Models\User;

class TicketSeeder extends Seeder
{
    public function run()
    {
        $user = User::first(); // Assuming at least one user exists

        Ticket::create([
            'user_id' => $user->id,
            'type' => 'Software',
            'status' => 'Open',
            'system' => 'SAP',
            'sub_system' => 'Material Management (MM)',
            'wo_type' => 'Modification',
            'scope' => 'System upgrade for material management',
            'description' => 'Detailed description of the issue',
        ]);
    }
}
