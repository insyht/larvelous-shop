<?php

namespace Insyht\LarvelousShop\Console;

use Illuminate\Console\Command;

class InstallPlugin extends Command
{
    protected $hidden = true;
    protected $signature = 'insyht-larvelous-shop:install';
    protected $description = 'Install the Larvelous Shop plugin';

    public function handle()
    {
        $this->info('Installing Larvelous Shop plugin...');

        $this->info('Publishing configuration...');
        $this->publishConfiguration(true);
        // todo also execute the other stuff from the ShopServiceProvider like migrations. Don't forget to add them to the unit test!

        $this->info('Installed Larvelous Shop plugin');
    }

    protected function publishConfiguration($forcePublish = false)
    {
        $params = [
            '--provider' => "Insyht\LarvelousShop\ShopServiceProvider",
            '--tag' => "config"
        ];

        if ($forcePublish === true) {
            $params['--force'] = true;
        }

        $this->call('vendor:publish', $params);
    }
}
