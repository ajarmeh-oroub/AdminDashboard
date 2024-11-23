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
        schema::create("stores", function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("address");
            $table->integer("phone");
            $table->string("email")->unique();
            $table->string("password");
            $table->foreignId("owner_id")->constrained("users")->onDelete("cascade");
            $table->string("description");
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->boolean('active')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
