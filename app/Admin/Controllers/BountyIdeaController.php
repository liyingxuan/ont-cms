<?php

namespace App\Admin\Controllers;

use App\BountyIdea;

use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;

class BountyIdeaController extends Controller
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

            $content->header('Bounty Ideas');
            $content->description('用来管理社区的bounty ideas');

            $content->breadcrumb(
                ['text' => 'Projects', 'url' => ''],
                ['text' => 'Bounty Ideas', 'url' => '/bounty-idea'],
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

            $content->header('审核Bounty Ideas');
            $content->description('只有状态可以修改，用于审核是否通过。');

            $content->breadcrumb(
                ['text' => 'Projects', 'url' => ''],
                ['text' => 'Bounty Ideas', 'url' => '/bounty-idea'],
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
        return Admin::grid(BountyIdea::class, function (Grid $grid) {

            $grid->disableRowSelector();
            $grid->disableCreateButton();
            $grid->disableFilter();
            $grid->disableExport();

            $grid->id('ID')->sortable();

            $grid->column('name', '提交者');
            $grid->column('email', '提交者邮箱');
            $grid->column('programming_lang', '编程语言');
            $grid->column('budget_requested', '申请预算');
            $grid->column('completion_time', '完成时间');

            $grid->column('summary', '概要')->style('max-width:200px;word-break:break-all;');

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
        return Admin::form(BountyIdea::class, function (Form $form) {

            $form->tools(function (Form\Tools $tools) {
                $tools->disableView();
                $tools->disableDelete();
            });

            $form->display('id', 'ID');

            $form->display('name', '提交者');
            $form->display('email', '提交者邮箱');
            $form->display('programming_lang', '编程语言');
            $form->display('budget_requested', '申请预算');
            $form->display('completion_time', '完成时间');

            $form->display('summary', '概要');
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
