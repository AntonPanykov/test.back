<?php

namespace App\GraphQL\Mutation;

use App\Models\Project;
use App\Models\ProjectUser;
use App\Services\Projects\SelectedProject;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;

class SelectProjectMutation extends Mutation
{
    protected $attributes = [
        'name' => 'SelectProject'
    ];

    public function type()
    {
        return GraphQL::type('project');
    }

    public function args()
    {
        return [
            'projectId' => [
                'name' => 'projectId',
                'type' => Type::NonNull(Type::id()),
                'privacy'       => function(array $args)
                    {
                        return ProjectUser::where('project_id', $args['projectId'])->where('user_id', \Auth::id())->count();
                    }
            ]
        ];
    }

    public function rules(array $args = [])
    {
        return [
            'projectId' => ['required', 'exists:projects,id']
        ];
    }

    public function resolve($root, $args)
    {
        SelectedProject::getInstance()->store($args['projectId']);
        return Project::find($args['projectId']);
    }
}