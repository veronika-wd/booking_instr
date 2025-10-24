<?php

namespace Src\Controllers;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class HomeController extends Controller
{
    public function index(RequestInterface $request, ResponseInterface $response, array $args)
    {
        if(!isset($args['category_id'])) {
            return $this->renderer->render($response, 'index.php', [
                'goods' => \ORM::forTable('goods')
                    ->select('goods.*')
                    ->select('categories.name', 'category_name')
                    ->leftOuterJoin('categories', ['goods.category_id', '=', 'categories.id'])
                    ->findArray(),
                'categories' => \ORM::for_table('categories')
                    ->select('categories.*')
                    ->whereNull('parent_category')
                    ->find_array(),
            ]);
        } else{
            return $this->renderer->render($response, 'index.php', [
                'goods' => \ORM::forTable('goods')
                    ->select('goods.*')
                    ->select('categories.name', 'category_name')
                    ->leftOuterJoin('categories', ['goods.category_id', '=', 'categories.id'])
                    ->where('category_id', $args['category_id'])
                    ->findArray(),
                'categories' => \ORM::for_table('categories')
                    ->select('categories.*')
                    ->whereNull('parent_category')
                    ->find_array(),
                'childCategories' => \ORM::for_table('categories')
                    ->select('categories.id')
                    ->select('categories.name')
                    ->select('categories.parent_category')
                    ->select('p.name', 'parent_name')
                    ->left_outer_join('categories', ['categories.parent_category', '=', 'p.id'], 'p')
                    ->where('parent_category',$args['category_id'])
                    ->find_array(),
            ]);
        }
    }

    public function show(RequestInterface $request, ResponseInterface $response, array $args)
    {
        return $this->renderer->render($response, 'show.php', [
            'good' => \ORM::forTable('goods')
                ->select('goods.*')
                ->select('categories.name', 'category_name')
                ->leftOuterJoin('categories', ['goods.category_id', '=', 'categories.id'])
                ->findOne($args['id'])
        ]);
    }

    public function catalog(RequestInterface $request, ResponseInterface $response, $args)
    {
        return $this->renderer->render($response, 'catalog.php', [
            'parentCategories' => \ORM::for_table('categories')
                ->select('categories.*')
                ->whereNull('parent_category')
                ->find_array(),
            'categories' => \ORM::for_table('categories')->find_array(),
        ]);
    }
}