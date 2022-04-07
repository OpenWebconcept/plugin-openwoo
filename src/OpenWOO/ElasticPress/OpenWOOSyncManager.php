<?php declare(strict_types=1);

namespace Yard\OpenWOO\ElasticPress;

use ElasticPress\Indexable\Post\SyncManager;

class OpenWOOSyncManager extends SyncManager
{
    /**
     * Indexable slug
     *
     * @since  3.0
     *
     * @var    string
     */
    public $indexable_slug = 'openwoo-item';
}
