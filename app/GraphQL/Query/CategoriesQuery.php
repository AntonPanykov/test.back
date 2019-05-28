<?php

namespace App\GraphQL\Query;

use App\Models\Category;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;

class CategoriesQuery extends Query
{
    protected $attributes = [
        'name' => 'Categories query'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('category'));
    }

    public function args()
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::ID()
            ],
            'parentPath' => [
                'name' => 'parentPath',
                'type' => Type::string()
            ],
            'title' => [
                'name' => 'title',
                'type' => Type::string()
            ]
        ];
    }

    public function resolve($root, $args)
    {
        if (isset($args['id'])) {
            return Category::where('id' , $args['id'])->get();
        }

        // Получить потомков
        if (isset($args['parentPath'])) {
            return Category::whereRaw("path <@ '" . $args['parentPath'] . "'")->get();
        }

        if (isset($args['title'])) {
            return Category::where('title', $args['title'])->get();
        }

        return Category::all();
    }
}