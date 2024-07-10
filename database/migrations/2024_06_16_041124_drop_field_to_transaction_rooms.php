<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('transaction_rooms', function (Blueprint $table) {
            // Drop the foreign key constraint if it exists
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $keys = $sm->listTableForeignKeys('transaction_rooms');
            foreach ($keys as $key) {
                if ($key->getName() == 'transaction_rooms_id_travel_agent_foreign') {
                    $table->dropForeign(['id_travel_agent']);
                }
            }

            // Drop the column
            if (Schema::hasColumn('transaction_rooms', 'id_travel_agent')) {
                $table->dropColumn('id_travel_agent');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaction_rooms', function (Blueprint $table) {
            //
        });
    }
};
