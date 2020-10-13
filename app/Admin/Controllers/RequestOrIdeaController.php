<?php

namespace App\Admin\Controllers;

use App\RequestOrIdea;

use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;

class RequestOrIdeaController extends Controller
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

            $content->header('Requests or Ideas');
            $content->description('用来管理社区的反馈和想法');

            $content->breadcrumb(
                ['text' => 'Projects', 'url' => ''],
                ['text' => 'Requests or Ideas', 'url' => '/request-or-idea'],
                ['text' => '申请列表']
            );

            $content->body($this->grid());
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

            $content->header('审核Requests or Ideas');
            $content->description('只有状态可以修改，用于审核是否通过。');

            $content->breadcrumb(
                ['text' => 'Projects', 'url' => ''],
                ['text' => 'Requests or Ideas', 'url' => '/request-or-idea'],
                ['text' => '审核申请']
            );

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(RequestOrIdea::class, function (Grid $grid) {

            $grid->disableRowSelector();
            $grid->disableCreateButton();
            $grid->disableFilter();
            $grid->disableExport();

            $grid->id('ID')->sortable();

            $grid->column('name', '提交者');
            $grid->column('email', '提交者邮箱');
            $grid->column('content', '提交内容')->style('max-width:200px;word-break:break-all;');
            $grid->column('status', '状态')->editable('select', [
                'unaudited' => '未审核',
                'reject' => '拒绝',
                'accept' => '批准'
            ])->sortable();

            $grid->column('updated_at', '最后更新')->sortable();

            $grid->actions(function ($actions) {
                $actions->disableView();
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
        return Admin::form(RequestOrIdea::class, function (Form $form) {

            $form->tools(function (Form\Tools $tools) {
                $tools->disableView();
                $tools->disableDelete();
            });

            $form->display('id', 'ID');

            $form->display('name', '提交者');
            $form->display('email', '提交者邮箱');
            $form->display('content', '提交内容');

            $form->select('status', '状态')->options([
                'unaudited' => '未审核',
                'reject' => '拒绝',
                'accept' => '批准'
            ])->default('unaudited');

            $form->display('created_at', '创建时间');
            $form->display('updated_at', '更新时间');

            $form->footer(function ($footer) {
                $footer->disableReset();

            });
        });
    }
}
