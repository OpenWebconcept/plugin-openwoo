<?php declare(strict_types=1);

namespace Yard\OpenWOO\RestAPI;

use WP_Query;
use WP_REST_Response;

/**
 * @OA\Schema()
 */
class Response extends WP_REST_Response
{
    /**
     * @OA\Property(
     *   property="WOOVerzoeken",
     *   type="array",
     *   @OA\Items(ref="#/components/schemas/OpenWOO"),
     *   @OA\Link(link="OpenWOORepository", ref="#/components/links/OpenWOORepository")
     * )
     */
    public function __construct(array $data, WP_Query $query)
    {
        if (! $query->is_single) {
            $data = \array_merge_recursive(
                $data,
                $this->addPaginator($query),
                $this->getQuery($query)
            );
        }
        parent::__construct($data);
    }

    /**
     * @OA\Property(
     *   property="pagination",
     *   type="array",
     *   @OA\Items(
     *
     *   )
     * )
     */
    protected function addPaginator(WP_Query $query): array
    {
        $page = $query->get('paged');
        $page = (0 === $page) ? 1 : $page;

        return [
            'pagination' => [
                'total'                   => (int) $query->found_posts,
                'limit'                   => (int) $query->get('posts_per_page'),
                'pages'                   => [
                    'total'              => (int) $query->max_num_pages,
                    'current'            => (int) $page,
                ]
            ]
        ];
    }

    /**
     * @OA\Property(
     *   property="query_parameters"
     * )
     */
    protected function getQuery(WP_Query $query): array
    {
        return [
            'query_parameters'        => $query->query
        ];
    }
}
