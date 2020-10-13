<?php

namespace App\Admin\Controllers;

use App\DappInfo;

use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use App\Http\Controllers\Controller;

class DappInfoController extends Controller
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

            $content->header('Dapp信息管理');
            $content->description('用来给dapp.ont.io提供Dapp信息内容的管理。P1为最先的显示优先级，默认P10最低。');

            $content->breadcrumb(
                ['text' => 'Info Manage', 'url' => ''],
                ['text' => 'dAPP Info', 'url' => '/dapp-info'],
                ['text' => 'dAPPs info']
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

            $content->header('Preview');
            $content->description('详情');

            $content->breadcrumb(
                ['text' => 'Info Manage', 'url' => ''],
                ['text' => 'dAPP Info', 'url' => '/dapp-info'],
                ['text' => 'Preview']
            );

            $content->body(Admin::show(DappInfo::findOrFail($id), function (Show $show) {
                $show->panel()->title('');

                $show->panel()->tools(function ($tools) {
                    $tools->disableDelete();
                });

                $show->id('ID');

                $show->title('Project Name');
                $show->url('Project URL')->link();
                $show->img_url('Logo')->image();
                $show->summary('Summary');
                $show->content('Content');

                $show->ont_id('ONT-ID');
                $show->dapp_screen_urls('dAPP Screen')->image();
                $show->telegram('Telegram');
                $show->twitter('Twitter');
                $show->discord('Discord');

                $show->qq('QQ');
                $show->github_url('GitHub');
                $show->contract_hash('Contract Hash');
                $show->abi('Contract ABI');
                $show->byte_code('Contract Byte Code');

                $show->token_name('Token Name');
                $show->token_type('Token Type');
                $show->donate_address('Donate Address');
                $show->type('Category')->using([
                    'dapp' => 'Dapp',
                    'wallet' => 'Wallet',
                    'official' => 'Official',
                    'game' => 'Game',
                    'others' => 'Other'
                ]);
                $show->schedule('Schedule')->using([
                    'coming-soon' => 'Coming Soon',
                    'online' => 'Online',
                    'others' => 'Other'
                ]);

                $show->priority('Priority(显示优先级)')->using([
                    '1' => 'P1',
                    '2' => 'P2',
                    '3' => 'P3',
                    '4' => 'P4',
                    '5' => 'P5',
                    '6' => 'P6',
                    '7' => 'P7',
                    '8' => 'P8',
                    '9' => 'P9',
                    '10' => 'P10'
                ]);
                $show->status('Status')->using([
                    '2' => 'Unreviewed',
                    '1' => 'Enable',
                    '0' => 'Disable'
                ]);

                $show->created_at('Create Time');
                $show->updated_at('Update Time');
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

            $content->header('Edit');
            $content->description('修改市场文章的内容或状态（停用的市场文章将不会再显示）');

            $content->breadcrumb(
                ['text' => 'Info Manage', 'url' => ''],
                ['text' => 'Dapp Info', 'url' => '/dapp-info'],
                ['text' => 'Edit']
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

            $content->header('New');
            $content->description('新建的市场文章(状态：启用)，会通过API直接暴露到调用了接口的列表中。');

            $content->breadcrumb(
                ['text' => 'Info Manage', 'url' => ''],
                ['text' => 'Dapp Info', 'url' => '/dapp-info'],
                ['text' => 'New']
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
        return Admin::grid(DappInfo::class, function (Grid $grid) {

            $grid->model()->orderBy('title');

            $grid->disableRowSelector();
            $grid->disableFilter();
            $grid->disableExport();

            $grid->column('title', 'Project Name')->editable()->style('max-width:200px;word-break:break-all;')->sortable();
            $grid->column('url', 'Project URL')->style('max-width:200px;word-break:break-all;');
            $grid->column('summary', 'Summary')->editable()->style('max-width:200px;word-break:break-all;');
            $grid->column('img_url', 'Logo')->image('', 100, 100);

            $grid->column('type', 'Category')->editable('select', [
                'dapp' => 'Dapp',
                'wallet' => 'Wallet',
                'official' => 'Official',
                'game' => 'Game',
                'others' => 'Other'
            ])->sortable();
            $grid->column('schedule', 'Schedule')->editable('select', [
                'coming-soon' => 'Coming Soon',
                'online' => 'Online',
                'others' => 'Other'
            ])->sortable();
            $grid->column('priority', 'Priority(显示优先级)')->editable('select', [
                '1' => 'P1',
                '2' => 'P2',
                '3' => 'P3',
                '4' => 'P4',
                '5' => 'P5',
                '6' => 'P6',
                '7' => 'P7',
                '8' => 'P8',
                '9' => 'P9',
                '10' => 'P10'
            ])->sortable();
            $grid->column('status', 'Status')->editable('select', [
                '2' => 'Unreviewed',
                '1' => 'Enable',
                '0' => 'Disable'
            ]);

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
        return Admin::form(DappInfo::class, function (Form $form) {

            $form->tools(function (Form\Tools $tools) {
                $tools->disableView();
                $tools->disableDelete();
            });

            $form->display('id', 'ID');

            $form->text('title', 'Project Name');
            $form->text('url', 'Project URL');
            $form->image('img_url', 'Logo')->uniqueName()->move('images/dapp')->help(
                '目前只支持一张图；要求PNG/JPG/JPEG；大小：300*300以上的正方形'
            );
            $form->textarea('summary', 'Summary');
            $form->textarea('content', 'Content');

            $form->text('ont_id', 'ONT-ID');
            $form->image('dapp_screen_urls', 'dAPP Screen')->uniqueName()->move('images/dapp')->help(
                '目前只支持一张图；要求PNG/JPG/JPEG；大小：300*300以上的正方形'
            );
            $form->text('telegram', 'Telegram');
            $form->text('twitter', 'Twitter');
            $form->text('discord', 'Discord');

            $form->text('qq', 'QQ');
            $form->text('github_url', 'GitHub URL');
            $form->textarea('contract_hash', 'Contract Hash')->help('注意：多个hash之间用英文逗号分隔，切记！！');
            $form->textarea('abi', 'Contract ABI');
            $form->textarea('byte_code', 'Contract Byte Code');

            $form->text('token_name', 'Token Name');
            $form->text('token_type', 'Token Type');
            $form->text('donate_address', 'Donate Address');
            $form->select('type', 'Category')->options([
                'dapp' => 'Dapp',
                'wallet' => 'Wallet',
                'official' => 'Official',
                'game' => 'Game',
                'others' => 'Other'
            ])->default('others');
            $form->select('schedule', 'Schedule')->options([
                'coming-soon' => 'Coming Soon',
                'online' => 'Online',
                'others' => 'Other'
            ])->default('others');

            $form->select('priority', 'Priority(显示优先级)')->options([
                '1' => 'P1',
                '2' => 'P2',
                '3' => 'P3',
                '4' => 'P4',
                '5' => 'P5',
                '6' => 'P6',
                '7' => 'P7',
                '8' => 'P8',
                '9' => 'P9',
                '10' => 'P10'
            ])->default('10')->help('P1为最先的显示优先级，默认为P10最低。');
            $form->select('status', 'Status')->options([
                '2' => 'Unreviewed',
                '1' => 'Enable',
                '0' => 'Disable'
            ])->default('1');

            $form->display('created_at', 'Create Time');
            $form->display('updated_at', 'Update Time');

            $form->footer(function ($footer) {
                $footer->disableReset();
            });
        });
    }
}
