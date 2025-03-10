<?php declare(strict_types=1);

/**
 * BasePlugin which sets all the serviceproviders.
 */

namespace Yard\OpenWOO\Foundation;

/**
 * BasePlugin which sets all the serviceproviders.
 */
class Plugin
{
    public const NAME = \OWO_SLUG;
    public const VERSION = \OWO_VERSION;

    protected string $rootPath;
    public Config $config;
    public Loader $loader;

    public function __construct(string $rootPath)
    {
        $this->rootPath = $rootPath;
        $this->loader = new Loader;
        $this->config = new Config($this->rootPath . '/config');
        $this->config->setProtectedNodes(['core']);
    }

    /**
     * Boot the plugin.
     *
     * @hook plugins_loaded
     */
    public function boot(): bool
    {
		$this->loadTextDomain();
		$this->config->boot();

        $dependencyChecker = new DependencyChecker(
            new DismissableAdminNotice,
            $this->config->get('dependencies.required'),
            $this->config->get('dependencies.suggested')
        );

        if ($dependencyChecker->hasFailures()) {
            $dependencyChecker->notifyFailed();
            \deactivate_plugins(plugin_basename(OWO_FILE));

            return false;
        }

        if ($dependencyChecker->hasSuggestions()) {
            $dependencyChecker->notifySuggestions();
        }

        $this->registerProviders();

        $this->loader->addAction('init', $this, 'filterPlugin', 4);
        $this->loader->register();

        return true;
    }

	public function loadTextDomain(): void
	{
		load_plugin_textdomain($this->getName(), false, $this->getName() . '/languages/');
	}

	protected function registerProviders(): void
	{
		$this->callServiceProviders('register');

		if (\is_admin()) {
			$this->callServiceProviders('register', 'admin');
			$this->callServiceProviders('boot', 'admin');
		}

		if ('cli' === php_sapi_name()) {
			$this->callServiceProviders('register', 'cli');
			$this->callServiceProviders('boot', 'cli');
		}

		$this->callServiceProviders('boot');
	}

    /**
     * Allows for hooking into the plugin name.
     */
    public function filterPlugin(): void
    {
        \do_action('yard/' . self::NAME . '/plugin', $this);
    }

    /**
     * Call method on service providers.
     *
     * @throws \Exception
     */
    public function callServiceProviders(string $method, string $key = ''): void
    {
        $offset = $key ? "core.providers.{$key}" : 'core.providers';
        $services = $this->config->get($offset);

        foreach ($services as $service) {
            if (is_array($service)) {
                continue;
            }

            $service = new $service($this);

            if (! $service instanceof ServiceProvider) {
                throw new \Exception('Provider must be an instance of ServiceProvider.');
            }

            if (method_exists($service, $method)) {
                $service->$method();
            }
        }
    }

    /**
     * Get the name of the plugin.
     */
    public function getName(): string
    {
        return static::NAME;
    }

    /**
     * Get the version of the plugin.
     */
    public function getVersion(): string
    {
        return static::VERSION;
    }

    /**
     * Return root path of plugin.
     */
    public function getRootPath(): string
    {
        return $this->rootPath;
    }
}
