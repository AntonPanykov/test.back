<?php

namespace App\GraphQL\Query;

use App\Models\Category;
use App\Models\Product;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class ProductsQuery extends Query
{
    protected $attributes = [
        'name' => 'Products query'
    ];

    public function type()
    {
        return GraphQL::paginate('product');
    }

    public function args()
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::ID()
            ],
            'categoryId' => [
                'name' => 'categoryId',
                'type' => Type::id()
            ],
            'page' => [
                'name' => 'page',
                'type' => Type::int()
            ]
        ];
    }

    public function resolve($root, $args,  SelectFields $fields)
    {

        $query = Product::query();

        if (isset($args['id'])) {
            $query->where('id' , $args['id']);
        }

        if (isset($args['categoryId'])) {
            $category = Category::findOrFail($args['categoryId']);
            $categories =  Category::whereRaw("path <@ '" . $category->path . "'")->get();
            $query->whereIn('category_id' , $categories->pluck('id')->toArray());
        }


        return $query->select($fields->getSelect())->paginate($args['limit'] ?? 4, ['*'], 'page', $args['page'] ?? 1);
    }
}