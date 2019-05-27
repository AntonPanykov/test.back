<?php

namespace App\GraphQL\Type;

use App\Models\Category;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class CategoryType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Category',
        'description' => 'Категория товара',
        'model' => Category::class,
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'ID',
                'alias' => 'category_id',
            ],
            'title' => [
                'type' => Type::string(),
                'description' => 'Название',
            ],
            'is_public' => [
                'type' => Type::boolean(),
                'description' => 'Доступна для просмотра?'
            ],
            'path' => [
                'type' => Type::string(),
                'description' => 'Родители'
            ],
            'slug' => [
                'type' => Type::string(),
                'description' => 'Идентификатор'
            ],
            'created_at' => [
                'type' => Type::string(),
                'description' => 'Дата создания'
            ],
            'updated_at' => [
                'type' => Type::string(),
                'description' => 'Дата последнего изменения'
            ]
        ];
    }
}
