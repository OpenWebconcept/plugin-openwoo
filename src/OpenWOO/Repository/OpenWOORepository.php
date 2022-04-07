<?php declare(strict_types=1);

namespace Yard\OpenWOO\Repository;

use Yard\OpenWOO\Models\OpenWOO as OpenWOOModel;

/**
 * @OA\Schema(schema="repository")
 */
class OpenWOORepository extends Base
{
    protected $posttype = 'openwoo-item';

    /** @inheritdoc */
    protected $model = OpenWOOModel::class;

    protected static $globalFields = [];

    /**
     * Add additional query arguments.
     */
    public function query(array $args): self
    {
        $this->queryArgs = array_merge($this->queryArgs, $args);

        return $this;
    }
}
