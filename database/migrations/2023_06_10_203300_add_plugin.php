<?php

use Illuminate\Database\Migrations\Migration;
use Insyht\Larvelous\Models\Plugin;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $plugin = new Plugin();
        $plugin->base = 'iws';
        $plugin->name = 'Shop';
        $plugin->path = 'insyht/larvelous-shop';
        $plugin->namespace = '\Insyht\LarvelousShop';
        $plugin->github_url = 'git@github.com:insyht/larvelous-shop.git';
        $plugin->active = 1;
        $plugin->author = 'insyht';
        $plugin->save();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Plugin::where('path', 'insyht/larvelous-shop')->delete();
    }
};
