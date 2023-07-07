<?php

declare(strict_types=1);

namespace Yard\OpenWOO\Taxonomy;

use Yard\OpenWOO\Foundation\ServiceProvider;

class TaxonomyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->plugin->loader->addAction('init', $this, 'registerTaxonomies');
        $this->plugin->loader->addAction('openwoo-show-on_add_form_fields', new TaxonomyController, 'addShowOnExplanation');
    }

    public function registerTaxonomies(): void
    {
        $taxonomies = $this->plugin->config->get('taxonomies') ?? [];

        if (empty($taxonomies)) {
            return;
        }

        foreach ($taxonomies as $taxonomyName => $taxonomy) {
            \register_taxonomy($taxonomyName, $taxonomy['object_types'], $taxonomy['args']);
        }
    }
}
