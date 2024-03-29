<?php

namespace Yard\OpenWOO\Settings;

use CMB2;
use Yard\OpenWOO\Foundation\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
{
    const PREFIX = '_owc_';

    public function register()
    {
        $this->plugin->loader->addAction('cmb2_admin_init', $this, 'registerSettingsPages', 10, 0);
    }

    public function registerSettingsPages(): void
    {
        $settingsPages = $this->plugin->config->get('settings_pages');

        if (! is_array($settingsPages)) {
            return;
        }

        foreach ($settingsPages as $page) {
            if (! is_array($page)) {
                continue;
            }

            $this->registerSettingsPage($page);
        }
    }

    protected function registerSettingsPage(array $page): void
    {
        $fields = $page['fields'] ?? [];
        unset($page['fields']); // Fields will be added later on.

        $optionsPage = \new_cmb2_box($page);

        if (empty($fields) || ! is_array($fields)) {
            return;
        }

        $this->registerSettingsPageFields($optionsPage, $fields);
    }

    protected function registerSettingsPageFields(CMB2 $optionsPage, array $fields)
    {
        foreach ($fields as $field) {
            if (! is_array($field)) {
                continue;
            }

            if (isset($field['id'])) {
                $field['id'] = self::PREFIX . $field['id'];
            }

            $optionsPage->add_field($field);
        }
    }
}
