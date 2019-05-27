<?php

namespace App\GraphQL\InputObject;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class AddAdminMeetingInput extends GraphQLType
{
    protected $inputObject = true;

    protected $attributes = [
        'name' => 'AddAdminMeetingInput',
        'description' => 'Сохранение информации о административной встречи'
    ];

    public function fields()
    {
        return [
            'doctorId' => [
                'name' => 'doctorId',
                'description' => 'ID доктора',
                'type' => Type::id(),
                //'rules' => ['required', 'array']
            ],
            'medPredId' => [
                'name' => 'medPredsId',
                'description' => 'Id медицинских представителя',
                'type' => Type::listOf(Type::id()),
                //'rules' => ['required', 'exists:users,id']
            ],
            'date' => [
                'name' => 'date',
                'description' => 'Дата',
                'type' => Type::string(),
                //'rules' => ['min:1', 'max:12']
            ],
            'title' => [
                'name' => 'title',
                'description' => 'Название',
                'type' => Type::string(),
                //'rules' => ['min:2019']
            ],
            'type' => [
                'name' => 'type',
                'description' => 'Тип',
                'type' => Type::int(),
                //'rules' => ['min:0', 'max:5']
            ],
            'equivalent' => [
                'name' => 'equivalent',
                'description' => 'Эквивалент',
                'type' => Type::int(),
                //'rules' => ['min:0', 'max:5']
            ]
        ];
    }
}
