<?php

namespace Src\Controllers;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class GoodsController extends Controller
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
                    ->select('categories.id')
                    ->select('categories.name')
                    ->select('categories.parent_category')
                    ->select('p.name', 'parent_name')
                    ->left_outer_join('categories', ['categories.parent_category', '=', 'p.id'], 'p')
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

    public function adminIndex(RequestInterface $request, ResponseInterface $response, $args)
    {
        return $this->renderer->render($response, 'goods/index.php', [
            'goods' => \ORM::forTable('goods')
                ->select('goods.*')
                ->select('categories.name', 'category_name')
                ->leftOuterJoin('categories', ['goods.category_id', '=', 'categories.id'])
                ->findArray(),
        ]);
    }

    public function create(RequestInterface $request, ResponseInterface $response,$args)
    {
        return $this->renderer->render($response, 'goods/create.php', [
            'categories' => \ORM::for_table('categories')
                ->select('categories.id')
                ->select('categories.name')
                ->select('categories.parent_category')
                ->select('p.name', 'parent_name')
                ->left_outer_join('categories', ['categories.parent_category', '=', 'p.id'], 'p')
                ->find_array(),
        ]);
    }

    public function store(RequestInterface $request, ResponseInterface $response, $args)
    {
        \ORM::for_table('goods')->create([
            'name' => $request->getParsedBody()['name'],
            'category_id' => $request->getParsedBody()['category'] ,
        ])->save();

        return $response->withHeader('Location', '/goods')->withStatus(302);
    }

    public function edit(RequestInterface $request, ResponseInterface $response, array $args)
    {
        return $this->renderer->render($response, 'goods/edit.php', [
            'good' => \ORM::for_table('goods')->find_one($args['id']),
            'categories' => \ORM::for_table('categories')
                ->select('categories.id')
                ->select('categories.name')
                ->select('categories.parent_category')
                ->select('p.name', 'parent_name')
                ->left_outer_join('categories', ['categories.parent_category', '=', 'p.id'], 'p')
                ->find_array(),
        ]);
    }

    public function update(RequestInterface $request, ResponseInterface $response, array $args)
    {
        \ORM::forTable('goods')->where('id', $args['id'])->findOne()->set([
            'name' => $request->getParsedBody()['name'],
            'category_id' => $request->getParsedBody()['category'],
        ])->save();
        return $response->withHeader('Location', '/goods')->withStatus(302);
    }

    public function delete(RequestInterface $request, ResponseInterface $response, array $args)
    {
        \ORM::forTable('goods')->findOne($args['id'])->delete();
        return $response->withHeader('Location', '/goods')->withStatus(302);
    }
}