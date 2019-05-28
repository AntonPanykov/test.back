<?php

namespace App\GraphQL\Type;

use App\Models\Product;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class ProductType extends GraphQLType
{
    protected $attributes = [
        'name'          => 'Product',
        'description'   => 'Товар',
        'model'         => Product::class,
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'ID',
                'alias' => 'id',
            ],
            'title' => [
                'type' => Type::string(),
                'description' => 'Название',
            ],
            'description' => [
                'type' => Type::string(),
                'description' => 'Описание'
            ],
            'img' => [
                'type' => Type::string(),
                'description' => 'Ссылка на изображение'
            ],
            'is_img_local' => [
                'type' => Type::boolean(),
                'description' => 'Локальная ссылка?'
            ],
            'category_id' => [
                'type' => Type::id(),
                'description' => 'ID категории'
            ],
            'category' => [
              'type' => \GraphQL::type('category'),
              'description' => 'Категория товара'
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
