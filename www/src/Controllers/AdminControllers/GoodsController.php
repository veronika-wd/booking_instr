<?php

namespace Src\Controllers\AdminControllers;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Src\Controllers\Controller;

class GoodsController extends Controller
{
    public function adminIndex(RequestInterface $request, ResponseInterface $response, $args)
    {
        return $this->renderer->render($response, 'admin/goods/index.php', [
            'goods' => \ORM::forTable('goods')
                ->select('goods.*')
                ->select('categories.name', 'category_name')
                ->leftOuterJoin('categories', ['goods.category_id', '=', 'categories.id'])
                ->findArray(),
        ]);
    }

    public function create(RequestInterface $request, ResponseInterface $response,$args)
    {
        return $this->renderer->render($response, 'admin/goods/create.php', [
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
            'description' => $request->getParsedBody()['description'],
            'slug' => $this->slugify($request->getParsedBody()['name']),
        ])->save();

        return $response->withHeader('Location', '/goods')->withStatus(302);
    }

    public function edit(RequestInterface $request, ResponseInterface $response, array $args)
    {
        return $this->renderer->render($response, 'admin/goods/edit.php', [
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
            'description' => $request->getParsedBody()['description'],
            'slug' => $this->slugify($request->getParsedBody()['name']),
        ])->save();
        return $response->withHeader('Location', '/goods')->withStatus(302);
    }

    public function delete(RequestInterface $request, ResponseInterface $response, array $args)
    {
        \ORM::forTable('goods')->findOne($args['id'])->delete();
        return $response->withHeader('Location', '/goods')->withStatus(302);
    }
}