<?php

namespace App\Admin\Controllers;

use App\CustodianSubscribe;

use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;

class CustodianSubscribeController extends Controller
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

            $content->header('Subscribe');
            $content->description('用来管理Custodian上有订阅的邮箱信息。');

            $content->breadcrumb(
                ['text' => 'Custodian', 'url' => ''],
                ['text' => 'Subscribe', 'url' => '/custodian/subscribe'],
                ['text' => '订阅列表']
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

            $content->header('处理Jobs');
            $content->description('其中状态、处理内容和处理人可以修改。');

            $content->breadcrumb(
                ['text' => 'Custodian', 'url' => ''],
                ['text' => 'Subscribe', 'url' => '/custodian/subscribe'],
                ['text' => '处理申请']
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
        return Admin::grid(CustodianSubscribe::class, function (Grid $grid) {

            $grid->model()->orderBy('id', 'desc');

            $grid->disableRowSelector();
            $grid->disableCreateButton();
            $grid->disableExport();

            // 查询过滤器
            $grid->filter(function($filter){
                $filter->disableIdFilter(); // 去掉默认的id过滤器
                $filter->like('email', '邮箱地址');
                $filter->like('processing_info', '处理信息');
                $filter->like('processing_person', '处理人');
                $filter->equal('status', '状态')->radio([
                    '0' => '未发送',
                    '1' => '已发送'
                ]);
            });

            $grid->id('ID')->sortable();

            $grid->column('email', '邮箱地址');

            $grid->column('status', '状态')->editable('select', [
                '0' => '未处理',
                '1' => '已处理'
            ])->sortable();

            $grid->column('processing_info', '处理信息')->style('max-width:200px;word-break:break-all;');
            $grid->column('processing_person', '处理人');

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
        return Admin::form(CustodianSubscribe::class, function (Form $form) {

            $form->tools(function (Form\Tools $tools) {
                $tools->disableView();
                $tools->disableDelete();
            });

            $form->display('id', 'ID');

            $form->display('email', '邮箱地址');

            $form->divide(); // 分割线

            $form->select('status', '状态')->options([
                '0' => '未发送',
                '1' => '已发送'
            ])->default('0');
            $form->textarea('processing_info', '处理信息');
            $form->text('processing_person', '处理人');

            $form->divide(); // 分割线

            $form->display('created_at', '创建时间');
            $form->display('updated_at', '更新时间');

            $form->footer(function ($footer) {
                $footer->disableReset();

            });
        });
    }
}
