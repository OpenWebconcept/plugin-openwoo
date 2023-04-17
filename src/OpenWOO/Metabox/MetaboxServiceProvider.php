<?php declare(strict_types=1);

namespace Yard\OpenWOO\Metabox;

use CMB2;
use Yard\OpenWOO\Foundation\ServiceProvider;

class MetaboxServiceProvider extends ServiceProvider
{
    public const PREFIX = '_owc_';

    public function register()
    {
        $this->plugin->loader->addAction('cmb2_admin_init', $this, 'registerMetaboxes', 10, 0);
    }

    public function registerMetaboxes()
    {
        $configMetaboxes = $this->plugin->config->get('metaboxes');

        if (! is_array($configMetaboxes)) {
            return;
        }

        $configMetaboxes = array_merge($configMetaboxes, apply_filters('yard/openwoo/before-register-metaboxes', $configMetaboxes));

        foreach ($configMetaboxes as $configMetabox) {
            if (! is_array($configMetabox)) {
                continue;
            }

            $this->registerMetabox($configMetabox);
        }
    }


    protected function registerMetabox(array $configMetabox): void
    {
        $fields = $configMetabox['fields'] ?? [];
        unset($configMetabox['fields']); // Fields will be added later on.

        $metabox = \new_cmb2_box($configMetabox);

        if (empty($fields) || ! is_array($fields)) {
            return;
        }

        $this->registerMetaboxFields($metabox, $fields);
    }

    protected function registerMetaboxFields(CMB2 $metabox, array $fields): void
    {
        foreach ($fields as $field) {
            $fieldKeys = array_keys($field);
            
            foreach ($fieldKeys as $fieldKey) {
                if (! is_array($field[$fieldKey])) {
                    continue;
                }

                if (isset($field[$fieldKey]['id'])) {
                    $field[$fieldKey]['id'] = $field[$fieldKey]['id'];
                }

                $metabox->add_field($field[$fieldKey]);
            }
        }
    }

}
