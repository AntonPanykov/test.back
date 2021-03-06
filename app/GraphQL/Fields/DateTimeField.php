<?php
namespace App\GraphQL\Field;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Field;

class DateTimeField extends Field
{
    protected $attributes = [
        'description' => 'String representation for Carbon date/time object'
    ];
    public function type()
    {
        return Type::string();
    }
    public function args()
    {
        return [
            'format' => [
                'type' => Type::string(),
                'description' => 'Formatting date based on DateTime::format() specs'
            ]
        ];
    }
    protected function resolve($root, $args)
    {
        $field = $root->{$args->fieldName};
        return isset($args['format'])
            ? $field->format($args['format'])
            : $field->toDateTimeString();
    }
}