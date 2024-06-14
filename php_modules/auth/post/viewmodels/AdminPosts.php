<?php

namespace App\auth\post\viewmodels;

use SPT\Web\Gui\Form;
use SPT\Web\Gui\Listing;
use SPT\Web\ViewModel;

class AdminPosts extends ViewModel
{
    public static function register()
    {
        return [
            'layout'=>[
                'backend.post.list',
                'backend.post.list.row',
                'backend.post.list.filter'
            ]
        ];
    }

    public function list()
    {
        $filter = $this->filter()['form'];
        $limit  = $filter->getField('limit')->value;
        $sort   = $filter->getField('sort')->value;
        $search = trim($filter->getField('search')->value);
        $page = $this->state('page', 1, 'int', 'get', 'post.page');
        if ($page <= 0) $page = 1;
        $method = $this->request->getMethod();
        if ($method == 'POST')
        {
            $page = 1;
            $this->session->set('post.page', 1);
        }
        
        $where = [];
        $post_manger = $this->permission->can('access_key', 'post_manager');
        if(!$post_manger)
        {
            $where[] = "(created_by LIKE ". $this->user->get('id').")";
        }
        if (!empty($search)) {
            $where[] = "(`title` LIKE '%" . $search . "%') OR (`description` LIKE '%" . $search . "%')";
        }

        $start  = ($page - 1) * $limit;
        $sort = $sort ? $sort : '#__posts.title asc';

        $result = $this->PostEntity->list($start, $limit, $where, $sort);
        $total = $this->PostEntity->getListTotal();
        
        if (!$result) {
            $result = [];
            $total = 0;
        }
        foreach($result as &$item)
        {
            $user = $this->UserEntity->findByPK($item['created_by']);
            $item['created_by'] = $user ? $user['name'] : '';
        }
        $limit = $limit == 0 ? $total : $limit;
        $list   = new Listing($result, $total, $limit, $this->getColumns());
        return [
            'list' => $list,
            'page' => $page,
            'start' => $start,
            'sort' => $sort,
            'user_id' => $this->user->get('id'),
            'url' => $this->router->url(),
            'link_list' => $this->router->url('posts'),
            'title_page' => 'Posts',
            'link_form' => $this->router->url('post'),
            'token' => $this->token->value(),
        ];
    }

    public function getColumns()
    {
        return [
            'num' => '#',
            'name' => 'Name',
            'description' => 'Description',
            'parent' => 'Parent',
            'col_last' => ' ',
        ];
    }

    protected $_filter;
    public function filter()
    {
        if (null === $this->_filter) :
            $data = [
                'search' => $this->state('search', '', '', 'post', 'post.search'),
                'limit' => $this->state('limit', 10, 'int', 'post', 'post.limit'),
                'sort' => $this->state('sort', '', '', 'post', 'post.sort')
            ];
            $filter = new Form($this->getFilterFields(), $data);

            $this->_filter = $filter;
        endif;

        return ['form' => $this->_filter];
    }

    public function getFilterFields()
    {
        return [
            'search' => [
                'text',
                'default' => '',
                'showLabel' => false,
                'formClass' => 'form-control h-full input_common w_full_475',
                'placeholder' => 'Search..'
            ],
            'status' => [
                'option',
                'default' => '1',
                'formClass' => 'form-select',
                'options' => [
                    ['text' => '--', 'value' => ''],
                    ['text' => 'Show', 'value' => '1'],
                    ['text' => 'Hide', 'value' => '0'],
                ],
                'showLabel' => false
            ],
            'limit' => [
                'option',
                'formClass' => 'form-select',
                'default' => 20,
                'options' => [
                    ['text' => '20', 'value' => 20],
                    ['text' => '50', 'value' => 50],
                    ['text' => 'All', 'value' => 0],
                ],
                'showLabel' => false
            ],
            'sort' => [
                'option',
                'formClass' => 'form-select',
                'default' => '#__posts.title asc',
                'options' => [
                    ['text' => 'name ascending', 'value' => '#__posts.title asc'],
                    ['text' => 'name descending', 'value' => '#__posts.title desc'],
                ],
                'showLabel' => false
            ]
        ];
    }

    public function row($layoutData, $viewData)
    {
        $row = $viewData['list']->getRow();
        return [
            'item' => $row,
            'index' => $viewData['list']->getIndex(),
        ];
    }


}
