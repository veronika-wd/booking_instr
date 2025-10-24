<?php

namespace Src\Controllers;

use ORM;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class HomeController extends Controller
{
    public function index(RequestInterface $request, ResponseInterface $response, array $args)
    {

        if(!isset($args['slug'])) {
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
            $category = ORM::forTable('categories')->where('slug', $args['slug'])->findOne();

            return $this->renderer->render($response, 'index.php', [
                'goods' => \ORM::forTable('goods')
                    ->select('goods.*')
                    ->select('categories.name', 'category_name')
                    ->leftOuterJoin('categories', ['goods.category_id', '=', 'categories.id'])
//                    ->where('category_id', $args['slug'])
                    ->findArray(),
                'categories' => \ORM::for_table('categories')
                    ->select('categories.*')
                    ->whereNull('parent_category')
                    ->find_array(),
                'childCategories' => \ORM::for_table('categories')
                    ->select('categories.*')
                    ->select('p.name', 'parent_name')
                    ->left_outer_join('categories', ['categories.parent_category', '=', 'p.id'], 'p')
                    ->where('parent_category', $category['id'])
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
                ->where('slug', $args['slug'])
            ->findOne(),
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