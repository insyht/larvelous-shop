<?php

require_once __DIR__ . '/../../../app/plugin_bootstrapper.php';

use App\Models\Plugin;

$plugin = new Plugin();
$plugin->base = 'iws';
$plugin->name = 'Shop';
$plugin->path = 'insyht/larvelous-shop';
$plugin->github_url = 'git@github.com:insyht/larvelous-shop.git';
$plugin->active = 1;
$plugin->author = 'insyht';
$plugin->save();
