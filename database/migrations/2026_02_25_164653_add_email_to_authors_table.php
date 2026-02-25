<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('authors', 'email')) {
            Schema::table('authors', function (Blueprint $table) {
                $table->string('email')->nullable()->after('name');
            });
        }
    }

    public function down()
    {
        if (Schema::hasColumn('authors', 'email')) {
            Schema::table('authors', function (Blueprint $table) {
                $table->dropColumn('email');
            });
        }
    }
};
