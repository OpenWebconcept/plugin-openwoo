<?php declare(strict_types=1);

namespace Yard\OpenWOO\ElasticPress;

use ElasticPress\Indexables;
use Yard\OpenWOO\Foundation\ServiceProvider;
use Yard\OpenWOO\Repository\OpenWOORepository;

class ElasticPressServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @throws Exception
     */
    public function register()
    {
        if (! class_exists('\ElasticPress\Elasticsearch')) {
            return;
        }

        Indexables::factory()->register(new OpenWOOIndexable(new OpenWOORepository, $this->plugin->config));

        add_filter('ep_dashboard_indexable_labels', function ($labels) {
            $labels['openwoo'] = [
                'singular' => esc_html__('openwoo-item', 'elasticpress'),
                'plural'   => esc_html__('openwoo-items', 'elasticpress'),
            ];

            return $labels;
        });

        $elasticPress = new ElasticPress($this->plugin->config, new OpenWOORepository);
        $this->plugin->loader->addAction('init', $elasticPress, 'setSettings', 10, 1);
        $this->plugin->loader->addAction('init', $elasticPress, 'setFilters', 10, 1);
    }
}
