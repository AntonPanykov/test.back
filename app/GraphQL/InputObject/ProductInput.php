<?php

namespace App\GraphQL\InputObject;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use Rebing\GraphQL\Support\UploadType;

class ProductInput extends GraphQLType
{
    protected $inputObject = true;

    protected $attributes = [
        'name' => 'productInput',
        'description' => 'Сохранение/изменение продукта'
    ];

    public function fields()
    {
        return [
            'id' => [
                'name' => 'id',
                'description' => 'ID продукта',
                'type' => Type::id(),
                'rules' => ['required']
            ],
            'title' => [
                'name' => 'title',
                'description' => 'Название продукта',
                'type' => Type::id(),
                'rules' => ['required']
            ],
            'description' => [
                'name' => 'description',
                'description' => 'Описание',
                'type' => Type::string(),
            ],
            'img_url' => [
                'name' => 'img_url',
                'description' => 'Адрес изображения',
                'type' => Type::string(),
                'rules' => ['url', 'required_without:img_file']
            ],
            'img_file' => [
                'name' => 'img_file',
                'description' => 'Файл изображения',
                'type' => UploadType::getInstance(),
                'rules' => ['required_without:img_url', 'image']
            ],
            'category_id' => [
                'name' => 'category_id',
                'description' => 'ID категории',
                'type' => Type::id(),
                'rules' => ['required', 'exists:categories,id']
            ]
        ];
    }
}
