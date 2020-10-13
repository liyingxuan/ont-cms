<?php

namespace App\Admin\Controllers;

use App\Bounty;
use App\BountyClaim;

use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use App\Admin\Extensions\ExcelExport\BountyClaimExport;
use App\Http\Controllers\Controller;

class BountyClaimController extends Controller
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

            $content->header('Bounty Claim');
            $content->description('用来管理社区对Bounty任务的申请，前端只会显示【In Progress】和【Done】进程的内容。');

            $content->breadcrumb(
                ['text' => 'Projects', 'url' => ''],
                ['text' => 'Bounty Claim', 'url' => '/bounty-claim'],
                ['text' => '申请列表']
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

            $content->header('Bounty Claim');
            $content->description('详情');

            $content->breadcrumb(
                ['text' => 'Projects', 'url' => ''],
                ['text' => 'Bounty Claim', 'url' => '/bounty-claim'],
                ['text' => 'Claim详情']
            );

            $content->body(Admin::show(BountyClaim::findOrFail($id), function (Show $show) {
                $show->panel()->title('');

                $show->panel()->tools(function ($tools) {
                    $tools->disableDelete();
                });

                $show->id('ID');

                $show->bounty_id('Bounty Name')->as(function ($bounty_id) {
                    return (Bounty::find($bounty_id))->name;
                });
                $show->name('申请人');
                $show->email('申请人邮箱');
                $show->team('团队介绍');
                $show->plan('计划详情');

                $show->github_url('Github地址')->link();
                $show->completion_time('所需天数');
                $show->status('状态')->using([
                    'unaudited' => '未审核',
                    'reject' => '已拒绝',
                    'accept' => '已批准'
                ]);

                $show->divider(); // 分割线
                $show->schedule('进度')->using([
                    'none' => 'None',
                    'in-progress' => 'In Progress',
                    'done' => 'Done',
                    'closed' => 'Closed'
                ]);
                $show->project_url('项目地址')->link();
                $show->team_alias('团队别名');
                $show->bounty_name_alias('项目别名');

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

            $content->header('审核Bounty Claim');
            $content->description('只有状态可以修改，用于审核是否通过。');

            $content->breadcrumb(
                ['text' => 'Projects', 'url' => ''],
                ['text' => 'Bounty Claim', 'url' => '/bounty-claim'],
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
        return Admin::grid(BountyClaim::class, function (Grid $grid) {

            $grid->model()->orderBy('id', 'desc');

            $grid->disableCreateButton();

            $grid->exporter(new BountyClaimExport());

            // 查询过滤器
            $grid->filter(function($filter){
                $filter->disableIdFilter(); // 去掉默认的id过滤器
                $filter->like('bounty.name', '项目名称');
                $filter->like('email', '申请人邮箱');
                $filter->equal('status', '状态')->radio([
                    'unaudited' => '未审核',
                    'reject' => '已拒绝',
                    'accept' => '已批准'
                ]);
                $filter->in('schedule', '进度')->checkbox([
                    'none' => 'None（未开始）',
                    'in-progress' => 'In Progress（进行中）',
                    'done' => 'Done（已完成）',
                    'closed' => 'Closed（未完成关闭）'
                ]);
            });

            $grid->id('ID')->sortable();

            $grid->column('bounty.name', '项目名称')->sortable();

            $grid->column('name', '申请人')->sortable();
            $grid->column('email', '申请人邮箱')->sortable();
            $grid->column('github_url', 'Github地址')->style('max-width:200px;word-break:break-all;');

            $grid->column('status', '状态')->editable('select', [
                'unaudited' => '未审核',
                'reject' => '已拒绝',
                'accept' => '已批准'
            ])->sortable();

            $grid->column('schedule', '进度')->editable('select', [
                'none' => 'None',
                'in-progress' => 'In Progress',
                'done' => 'Done',
                'closed' => 'Closed'
            ])->sortable();
            $grid->column('project_url', '项目地址')->sortable()->style('max-width:200px;word-break:break-all;');
            $grid->column('team_alias', '团队别名')->sortable();
            $grid->column('bounty_name_alias', '项目别名')->sortable();

            $grid->column('created_at', '申请时间')->sortable();

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
        return Admin::form(BountyClaim::class, function (Form $form) {

            $form->tools(function (Form\Tools $tools) {
                $tools->disableDelete();
            });

            $form->display('id', 'ID');

            $form->display('bounty.name', '项目名称');

            $form->display('name', '申请人');
            $form->display('email', '申请人邮箱');
            $form->display('team', '团队介绍');
            $form->display('plan', '计划详情');
            $form->display('github_url', 'Github地址');
            $form->display('completion_time', '所需天数');

            $form->select('status', '状态')->options([
                'unaudited' => '未审核',
                'reject' => '已拒绝',
                'accept' => '已批准'
            ])->default('unaudited');

            $form->divide(); // 分割线

            $form->select('schedule', '进度')->options([
                'none' => 'None（未开始）',
                'in-progress' => 'In Progress（进行中）',
                'done' => 'Done（已完成）',
                'closed' => 'Closed（未完成关闭）'
            ])->default('active')
                ->help('状态：【None】- 未开始、【In Progress】- 任务进行中、【Done】- 任务完成、【Closed】- 没有完成就关闭了，不会在前端显示。');
            $form->text('team_alias', '团队别名');
            $form->text('bounty_name_alias', '项目别名')
                ->help('【团队别名】和【项目别名】主要用于显示在前端，如果没有填写，则显示默认的【项目名称】和【申请人】。');
            $form->text('project_url', '项目地址');

            $form->divide(); // 分割线

            $form->display('created_at', '创建时间');
            $form->display('updated_at', '更新时间');

            $form->footer(function ($footer) {
                $footer->disableReset();

            });
        });
    }
}
