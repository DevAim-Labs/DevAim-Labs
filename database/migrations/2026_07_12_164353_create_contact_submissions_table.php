<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contact_submissions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->text('message');
            $table->string('ip_address', 45)->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamps();
        });

        // Reachable through Supabase's PostgREST API by default (anon/authenticated
        // get full grants on new public tables) — RLS with no policies denies that,
        // Laravel's own connection (table owner) is unaffected.
        if (DB::connection()->getDriverName() === 'pgsql') {
            DB::statement('ALTER TABLE public.contact_submissions ENABLE ROW LEVEL SECURITY');
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_submissions');
    }
};
