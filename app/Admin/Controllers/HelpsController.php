<?php

namespace App\Admin\Controllers;

use App\Help;

use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use App\Http\Controllers\Controller;

class HelpsController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('帮助');
            $content->description('用来给提供展示帮助/公告等信息');

            $content->breadcrumb(
                ['text' => 'Articles', 'url' => ''],
                ['text' => 'Help', 'url' => '/helps'],
                ['text' => '文章列表']
            );

            $content->body($this->grid());
        });
    }

    /**
     * Show detail.
     *
     * @param $id
     * @return Content
     */
    public function show($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('帮助文章');
            $content->description('详情');

            $content->breadcrumb(
                ['text' => 'Articles', 'url' => ''],
                ['text' => 'Help', 'url' => '/helps'],
                ['text' => '文章信息']
            );

            $content->body(Admin::show(Help::findOrFail($id), function (Show $show) {
                $show->panel()->title('');

                $show->panel()->tools(function ($tools) {
                    $tools->disableDelete();
                });

                $show->id('ID');

                $show->title('标题');
                $show->content('内容');
                $show->language('语言')->using([
                    'en' => 'English',
                    'cn' => '中文'
                ]);
                $show->type('类型')->using([
                    'Identity' => '身份',
                    'Wallet' => '钱包',
                    'Others' => '其他'
                ]);
                $show->status('状态')->using([
                    '1' => '启用',
                    '0' => '禁用'
                ]);

                $show->created_at('创建时间');
                $show->updated_at('最后修改时间');
            }));
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('修改帮助');
            $content->description('修改帮助的内容或状态（停用的帮助将不会再显示）');

            $content->breadcrumb(
                ['text' => 'Articles', 'url' => ''],
                ['text' => 'Help', 'url' => '/helps'],
                ['text' => '修改帮助']
            );

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('新建帮助');
            $content->description('新建的帮助(状态：启用)，会通过API直接暴露到调用了接口的列表中。');

            $content->breadcrumb(
                ['text' => 'Articles', 'url' => ''],
                ['text' => 'Help', 'url' => '/helps'],
                ['text' => '新建帮助']
            );

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Help::class, function (Grid $grid) {
            $grid->disableRowSelector();
            $grid->disableFilter();
            $grid->disableExport();

            $grid->id('ID')->sortable();

            $grid->column('title', '标题')->editable()->style('max-width:200px;word-break:break-all;');
            $grid->column('language', '语言')->editable('select', [
                'en' => 'English',
                'cn' => '中文'
            ]);
            $grid->column('type', '类型')->editable('select', [
                'Identity' => '身份',
                'Wallet' => '钱包',
                'Others' => '其他'
            ]);
            $grid->column('status', '状态')->editable('select', [
                '1' => '启用',
                '0' => '禁用'
            ]);

            $grid->column('updated_at', '最后更新');

            $grid->actions(function ($actions) {
                $actions->disableDelete();
            });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Help::class, function (Form $form) {
            $form->tools(function (Form\Tools $tools) {
                $tools->disableView();
                $tools->disableDelete();
            });

            $form->display('id', 'ID');

            $form->text('title', '标题');
            $form->editor('content', '内容');
            $form->select('language', '语言')->options([
                'en' => 'English',
                'cn' => '中文'
            ])->default('en');
            $form->select('type', '类型')->options([
                'Identity' => '身份',
                'Wallet' => '钱包',
                'Others' => '其他'
            ])->default('Others');
            $form->select('status', '状态')->options([
                '1' => '启用',
                '0' => '禁用'
            ])->default('1');

            $form->display('created_at', '创建时间');
            $form->display('updated_at', '更新时间');
        });
    }
}
