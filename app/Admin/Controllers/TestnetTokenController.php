<?php

namespace App\Admin\Controllers;

use App\TestnetToken;

use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;

class TestnetTokenController extends Controller
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

            $content->header('Test Net Token');
            $content->description('用来管理社区对测试网Token的申请');

            $content->breadcrumb(
                ['text' => 'Projects', 'url' => ''],
                ['text' => 'Test Net Token', 'url' => '/test-net-token'],
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

            $content->header('审核Test Net Token');
            $content->description('只有状态可以修改，用于审核是否通过。');

            $content->breadcrumb(
                ['text' => 'Projects', 'url' => ''],
                ['text' => 'Test Net Token', 'url' => '/test-net-token'],
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
        return Admin::grid(TestnetToken::class, function (Grid $grid) {

            $grid->disableRowSelector();
            $grid->disableCreateButton();
            $grid->disableFilter();
            $grid->disableExport();

            $grid->id('ID')->sortable();

            $grid->column('name', '申请人');
            $grid->column('phone', '申请人电话');
            $grid->column('email', '申请人邮箱');
            $grid->column('ont', 'ONT数量');
            $grid->column('ong', 'ONG数量');

            $grid->column('address', '地址');
            $grid->column('project_url', '项目链接');
            $grid->column('plan', '项目计划介绍')->style('max-width:200px;word-break:break-all;');
            $grid->column('team', '项目团队简介')->style('max-width:200px;word-break:break-all;');

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
        return Admin::form(TestnetToken::class, function (Form $form) {

            $form->tools(function (Form\Tools $tools) {
                $tools->disableView();
                $tools->disableDelete();
            });

            $form->display('id', 'ID');

            $form->display('name', '申请人');
            $form->display('phone', '申请人电话');
            $form->display('email', '申请人邮箱');
            $form->display('ont', 'ONT数量');
            $form->display('ong', 'ONG数量');

            $form->display('address', '地址');
            $form->display('project_url', '项目链接');
            $form->display('plan', '项目计划介绍');
            $form->display('team', '项目团队简介');

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
