<?php

namespace App\Admin\Controllers;

use App\CustodianJob;

use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;

class CustodianJobController extends Controller
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

            $content->header('Jobs');
            $content->description('用来管理Custodian上有加入意向的留言信息。');

            $content->breadcrumb(
                ['text' => 'Custodian', 'url' => ''],
                ['text' => 'Jobs', 'url' => '/custodian/jobs'],
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

            $content->header('处理Jobs');
            $content->description('其中状态、处理内容和处理人可以修改。');

            $content->breadcrumb(
                ['text' => 'Custodian', 'url' => ''],
                ['text' => 'Jobs', 'url' => '/custodian/jobs'],
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
        return Admin::grid(CustodianJob::class, function (Grid $grid) {

            $grid->model()->orderBy('id', 'desc');

            $grid->disableRowSelector();
            $grid->disableCreateButton();
            $grid->disableExport();

            // 查询过滤器
            $grid->filter(function($filter){
                $filter->disableIdFilter(); // 去掉默认的id过滤器
                $filter->like('email', '邮箱地址');
                $filter->like('message', '留言');
                $filter->like('processing_info', '处理信息');
                $filter->like('processing_person', '处理人');
                $filter->equal('status', '状态')->radio([
                    '0' => '未处理',
                    '1' => '已处理'
                ]);
            });

            $grid->id('ID')->sortable();

            $grid->column('name', '联系人名');
            $grid->column('email', '邮箱地址');
            $grid->column('phone', '联系方式');
            $grid->column('message', '留言')->style('max-width:200px;word-break:break-all;');
            $grid->column('linkedin_url', '领英URL')->style('max-width:200px;word-break:break-all;');

            $grid->column('resume_url', '简历URL')->style('max-width:200px;word-break:break-all;');

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
        return Admin::form(CustodianJob::class, function (Form $form) {

            $form->tools(function (Form\Tools $tools) {
                $tools->disableView();
                $tools->disableDelete();
            });

            $form->display('id', 'ID');

            $form->display('name', '联系人名');
            $form->display('email', '邮箱地址');
            $form->display('phone', '联系方式');
            $form->display('message', '留言');
            $form->display('linkedin_url', '领英URL');

            $form->display('resume_url', '简历URL');

            $form->divide(); // 分割线

            $form->select('status', '状态')->options([
                '0' => '未处理',
                '1' => '已处理'
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
