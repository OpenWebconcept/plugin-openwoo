<?php declare(strict_types=1);

namespace Yard\OpenWOO\Tests\Models;

use Mockery as m;
use WP_Mock;
use Yard\OpenWOO\ElasticPress\ElasticPress;
use Yard\OpenWOO\Foundation\Config;
use Yard\OpenWOO\Foundation\Loader;
use Yard\OpenWOO\Foundation\Plugin;
use Yard\OpenWOO\Models\Item;
use Yard\OpenWOO\Models\OpenWOO;
use Yard\OpenWOO\Repository\OpenWOORepository;
use Yard\OpenWOO\Tests\TestCase;

class OpenWOOTest extends TestCase
{
    protected function setUp(): void
    {
        WP_Mock::setUp();

        $this->config = m::mock(Config::class);
        $this->repository = m::mock(OpenWOORepository::class);

        $this->plugin = m::mock(Plugin::class);
        $this->plugin->config = $this->config;
        $this->plugin->loader = m::mock(Loader::class);

        $this->item = m::mock(Item::class);

        $this->service = new ElasticPress($this->config, $this->repository);
    }

    protected function tearDown(): void
    {
        WP_Mock::tearDown();
    }

    /** @test */
    public function if_class_is_instance_of_OpenWOO_class()
    {
        \WP_Mock::userFunction('get_post_meta', [
            'times'  => 1,
            'return' => [],
        ]);

        $openwoo = new OpenWOO([
            'ID' => 1
        ]);
        $this->assertInstanceOf(OpenWOO::class, $openwoo);
    }
}
