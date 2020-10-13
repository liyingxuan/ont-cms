<?php

namespace App\Admin\Controllers;

use App\Bounty;

use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use App\Admin\Extensions\ExcelExport\BountyExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BountyController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @param Request $request
     * @return Content
     */
    public function index(Request $request)
    {
        $status = $this->getStatus($request->path());

        return Admin::content(function (Content $content) use ($status) {

            $content->header('Bounty');
            $content->description('用来管理提供给社区分发的任务列表，前端只会显示【Active】状态的内容。');

            $content->breadcrumb(
                ['text' => 'Bounty', 'url' => ''],
                ['text' => ucfirst($status), 'url' => '/bounty/' . $status],
                ['text' => '任务列表']
            );

            $content->body($this->grid($status));
        });
    }

    /**
     * Show detail.
     *
     * @param $id
     * @param Request $request
     * @return Content
     */
    public function show($id, Request $request)
    {
        $status = $this->getStatus($request->path());

        return Admin::content(function (Content $content) use ($id, $status) {

            $content->header('Bounty项目');
            $content->description('详情');

            $content->breadcrumb(
                ['text' => 'Bounty', 'url' => ''],
                ['text' => 'Active', 'url' => '/bounty/' . $status],
                ['text' => '任务详情']
            );

            $content->body(Admin::show(Bounty::findOrFail($id), function (Show $show) {
                $show->panel()->title('');

                $show->panel()->tools(function ($tools) {
                    $tools->disableDelete();
                });

                $show->id('ID');

                $show->type('类型');
                $show->name('项目名称');
                $show->img_url('图片链接')->image();
                $show->summary('项目描述');
                $show->content('项目内容');

                $show->bonus('项目奖励');
                $show->leader('项目负责人');
                $show->status('状态')->using([
                    'active' => 'Active',
                    'done' => 'Done',
                    'closed' => 'Closed'
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
     * @param Request $request
     * @return Content
     */
    public function edit($id, Request $request)
    {
        $status = $this->getStatus($request->path());
        $status = str_replace('edit', '', $status);

        return Admin::content(function (Content $content) use ($id, $status) {

            $content->header('修改Bounty');
            $content->description('修改Bounty项目的内容或状态');

            $content->breadcrumb(
                ['text' => 'Bounty', 'url' => ''],
                ['text' => 'Active', 'url' => '/bounty/' . $status],
                ['text' => '修改Bounty']
            );

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @param Request $request
     * @return Content
     */
    public function create(Request $request)
    {
        $status = $this->getStatus($request->path());
        $status = str_replace('create', '', $status);

        return Admin::content(function (Content $content) use ($status) {

            $content->header('新建Bounty');
            $content->description('新建的Bounty事件，会通过API直接暴露到调用了接口的列表中。');

            $content->breadcrumb(
                ['text' => 'Bounty', 'url' => ''],
                ['text' => 'Active', 'url' => '/bounty/' . $status],
                ['text' => '新建Bounty']
            );

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @param $status
     * @return Grid
     */
    protected function grid($status)
    {
        return Admin::grid(Bounty::class, function (Grid $grid) use ($status) {
            // 添加默认查询条件
            $grid->model()->where('status', '=', $status);

            $grid->exporter(new BountyExport());

            // 查询过滤器
            $grid->filter(function($filter){
                $filter->disableIdFilter(); // 去掉默认的id过滤器
                $filter->like('name', '项目名称');
            });

            $grid->id('ID')->sortable();

//            $grid->column('type', '类型')->editable('select', [
//                'Others' => '其他'
//            ]);
            $grid->column('name', '项目名称')->editable()->sortable();
            $grid->column('img_url', '展示图')->image('', 100, 100);
            $grid->column('summary', '摘要')->style('max-width:200px;word-break:break-all;');

            $grid->column('bonus', '奖金')->editable()->sortable();
            $grid->column('leader', '负责人')->editable()->sortable();

            $grid->column('status', '状态')->editable('select', [
                'active' => 'Active',
                'done' => 'Done',
                'closed' => 'Closed'
            ])->sortable();

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
        return Admin::form(Bounty::class, function (Form $form) {

            $form->tools(function (Form\Tools $tools) {
                $tools->disableView();
                $tools->disableDelete();
            });

            $form->display('id', 'ID');

//            $form->select('type', '类型')->options([
//                'others' => '其他'
//            ])->default('others');
            $form->text('name', '项目名称');
            $form->image('img_url', '展示图')->uniqueName()->move('images/bounty');
            $form->textarea('summary', '摘要');
            $form->editor('content', '内容');

            $form->text('bonus', '奖金');
            $form->text('leader', '负责人');

            $form->select('status', '状态')->options([
                'active' => 'Active（召集中）',
                'done' => 'Done（已完成）',
                'closed' => 'Closed（未完成关闭）'
            ])->default('active')
                ->help('状态：【Active】- 召集中、【Done】- 已完成、【Closed】- 没有人接受或其他原因没有完成就关闭了，不会在前端显示。');

            $form->display('created_at', '创建时间');
            $form->display('updated_at', '更新时间');
        });
    }

    /**
     * 通过路径判断要什么类型。
     *
     * @param $path
     * @return null|string|string[]
     */
    protected function getStatus($path)
    {
        $path = str_replace('admin/bounty', '', $path);
        $path = str_replace('/', '', $path);
        $status = trim($path);
        $status = preg_replace('|[0-9]+|', '', $status);

        return $status;
    }
}
