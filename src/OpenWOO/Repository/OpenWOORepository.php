<?php declare(strict_types=1);

namespace Yard\OpenWOO\Repository;

use Yard\OpenWOO\Models\OpenWOO as OpenWOOModel;

/**
 * @OA\Schema(schema="repository")
 */
class OpenWOORepository extends Base
{
    protected string $posttype = 'openwoo-item';
    protected string $model = OpenWOOModel::class;
    protected static $globalFields = [];

    /**
     * Add additional query arguments.
     */
    public function query(array $args): self
    {
        $this->queryArgs = array_merge($this->queryArgs, $args);

        return $this;
    }

    /**
     * Add parameters to tax_query used for filtering items on selected blog (ID) slugs.
     */
    public static function addShowOnParameter(string $blogSlug): array
    {
        return [
            'tax_query' => [
                [
                    'taxonomy' => 'openwoo-show-on',
                    'terms'    => sanitize_text_field($blogSlug),
                    'field'    => 'slug',
                    'operator' => 'IN'
                ]
            ]
        ];
    }
}
