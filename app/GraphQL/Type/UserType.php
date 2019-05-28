<?php

namespace App\GraphQL\Type;

use App\Models\User;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class UserType extends GraphQLType
{
    protected $attributes = [
        'name'          => 'User',
        'description'   => 'Пользователь',
        'model'         => User::class,
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'ID',
                'alias' => 'user_id',
            ],
            'email' => [
                'type' => Type::string(),
                'description' => 'Email',
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'Имя'
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

    protected function resolveEmailField($root, $args)
    {
        return strtolower($root->email);
    }
}
