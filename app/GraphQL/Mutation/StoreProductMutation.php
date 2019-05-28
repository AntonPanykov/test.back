<?php

namespace App\GraphQL\Mutation;

use App\Models\Product;
use GraphQL;
use Rebing\GraphQL\Support\Mutation;

class StoreProductMutation extends Mutation
{
    protected $attributes = [
        'name' => 'AddProduct'
    ];

    public function authorize(array $args)
    {
        // return \Auth::check();
        return true;
    }

    public function type()
    {
        return GraphQL::type('product');
    }

    public function args()
    {
        return [
            'product' => ['type' => GraphQL::type('productInput')]
        ];
    }

    public function resolve($root, $args)
    {

        \DB::beginTransaction();
        try {
            $product = $args['product'];
            if($args['img_file']) {
                $product['img'] = $args['img_file']->store('products','public');
                $product['is_img_local'] = true;
            } else {
                $product['img'] = $args['img_url'];
                $product['is_img_local'] = false;
            }
            $result = Product::create($product);
        } catch (\Exception $e) {
            \DB::rollBack();
            \Log::error(trans('errors.store_product').': '.$e->getMessage());
            throw new \Exception($e->getMessage());
        }
        \DB::commit();

        return $result;
    }
}
