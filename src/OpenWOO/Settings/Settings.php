<?php

namespace Yard\OpenWOO\Settings;

class Settings
{
    /**
     * Settings defined on settings page
     */
    protected array $settings;

    public function __construct(array $settings)
    {
        $this->settings = $settings;
    }

    public function getFileServerURL(): string
    {
        return $this->settings['_owc_openwoo_setting_file_server_url'] ?? '';
    }

    public static function make(): self
    {
        $defaultSettings = [
            '_owc_openwoo_setting_file_server_url' => '',
        ];

        return new static(wp_parse_args(\get_option('_owc_openwoo_base_settings'), $defaultSettings));
    }
}
