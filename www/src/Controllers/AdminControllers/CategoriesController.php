<?php

namespace Src\Controllers\AdminControllers;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Src\Controllers\Controller;

class CategoriesController extends Controller
{
    public function index(RequestInterface $request, ResponseInterface $response, $args)
    {
        return $this->renderer->render($response, 'admin/categories/index.php', [
            'categories' => \ORM::for_table('categories')
                ->select('categories.id')
                ->select('categories.name')
                ->select('categories.parent_category')
                ->select('p.name', 'parent_name')
                ->left_outer_join('categories', ['categories.parent_category', '=', 'p.id'], 'p')
                ->orderByAsc('categories.parent_category')
                ->find_array(),
            ]);
    }

    public function create(RequestInterface $request, ResponseInterface $response,$args)
    {
        return $this->renderer->render($response, 'admin/categories/create.php', [
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
        \ORM::for_table('categories')->create([
            'name' => $request->getParsedBody()['name'],
            'parent_category' => !$request->getParsedBody()['parent'] ? null : $request->getParsedBody()['parent'],
        ])->save();

        return $response->withHeader('Location', '/categories')->withStatus(302);
    }

    public function edit(RequestInterface $request, ResponseInterface $response, array $args)
    {
        return $this->renderer->render($response, 'admin/categories/edit.php', [
            'categorySelected' => \ORM::for_table('categories')->find_one($args['id']),
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
        \ORM::forTable('categories')->where('id', $args['id'])->findOne()->set([
            'name' => $request->getParsedBody()['name'],
            'parent_category' => !$request->getParsedBody()['parent'] ? null : $request->getParsedBody()['parent'],
        ])->save();
        return $response->withHeader('Location', '/categories')->withStatus(302);
    }

    public function delete(RequestInterface $request, ResponseInterface $response, array $args)
    {
        \ORM::forTable('categories')->findOne($args['id'])->delete();
        return $response->withHeader('Location', '/categories')->withStatus(302);
    }
}