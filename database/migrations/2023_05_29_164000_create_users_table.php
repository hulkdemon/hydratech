<?php

use App\Models\RolModelo;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_rol')->nullable();
            $table->string('name');
            $table->string('username');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->foreign('id_rol')->references('id_rol')->on('rol');
            $table->timestamps();
        });
            
        // Obtén los registros de roles
        $administradorRol = RolModelo::where('id_rol', 1)->first();
        $cajeroRol = RolModelo::where('id_rol', 2)->first();

            // Crear usuario con rol de Administrador
            User::create([
                'id_rol' => $administradorRol->id_rol,
                'name' => 'Administrador',
                'username' => 'Administrador',
                'email' => 'Administrador@gmail.com',
                'password' => bcrypt('Administrador'),
            ]);
    
            // Crear usuario con rol de Cajero
            User::create([
                'id_rol' => $cajeroRol->id_rol,
                'name' => 'Cajero',
                'username' => 'Cajero',
                'email' => 'Cajero@gmail.com',
                'password' => bcrypt('Cajero'),
            ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
