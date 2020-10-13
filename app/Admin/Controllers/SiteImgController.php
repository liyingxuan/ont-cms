<?php

namespace App\Admin\Controllers;

use App\SiteImg;

use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use App\Http\Controllers\Controller;
use function PHPSTORM_META\type;

class SiteImgController extends Controller
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

            $content->header('图片管理');
            $content->description('用来管理图片内容的输出，请谨慎设置，将会影响官网内容输出！');

            $content->breadcrumb(
                ['text' => 'Info Manage', 'url' => ''],
                ['text' => 'Sites Images', 'url' => '/site-img'],
                ['text' => '图片管理']
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

            $content->header('图片预览');
            $content->description('详情');

            $content->breadcrumb(
                ['text' => 'Info Manage', 'url' => ''],
                ['text' => 'Sites Images', 'url' => '/site-img'],
                ['text' => '图片预览']
            );

            $content->body(Admin::show(SiteImg::findOrFail($id), function (Show $show) {
                $show->panel()->title('');

                $show->panel()->tools(function ($tools) {
                    $tools->disableDelete();
                });

                $show->id('ID');

                $show->nickname('昵称');
                $show->key('Key');
                $show->img_url('图片')->image();

                $show->language('语言')->using([
                    'en' => 'English',
                    'cn' => '中文'
                ]);
                $show->type('类型')->using([
                    'bounty' => 'Bounty',
                    'official' => 'Official',
                    'news' => '新闻',
                    'wallet' => 'Wallet',
                    'others' => '其他'
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

            $content->header('修改图片信息');
            $content->description('用来管理图片内容的输出，请谨慎设置，将会影响官网内容输出！');

            $content->breadcrumb(
                ['text' => 'Info Manage', 'url' => ''],
                ['text' => 'Sites Images', 'url' => '/site-img'],
                ['text' => '修改图片']
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

            $content->header('新上传图片');
            $content->description('注意key的内容需要使用全小写字母和下划线的组合，不要有数字和空格等特殊符号');

            $content->breadcrumb(
                ['text' => 'Info Manage', 'url' => ''],
                ['text' => 'Sites Text', 'url' => '/site-img'],
                ['text' => '新建图片']
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
        return Admin::grid(SiteImg::class, function (Grid $grid) {

            $grid->disableRowSelector();
            $grid->disableFilter();
            $grid->disableExport();

            $grid->id('ID')->sortable();

            $grid->column('nickname', '昵称')->editable();
            $grid->column('key', 'Key');
            $grid->column('img_url', '图片')->image('', 100, 100);
            $grid->column('img_url', 'Image URL');

            $grid->column('language', '语言')->editable('select', [
                'en' => 'English',
                'cn' => '中文'
            ])->sortable();

            $grid->column('type', '类型')->editable('select', [
                'bounty' => 'Bounty',
                'official' => 'Official',
                'news' => 'News',
                'wallet' => 'Wallet',
                'others' => 'Other'
            ])->sortable();

            $grid->column('status', '状态')->editable('select', [
                '1' => 'Enabled',
                '0' => 'Disabled'
            ])->sortable();

            $grid->column('updated_at', '最后更新')->sortable();

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
        return Admin::form(SiteImg::class, function (Form $form) {

            $form->tools(function (Form\Tools $tools) {
                $tools->disableDelete();
            });

            $form->display('id', 'ID');

            $form->text('nickname', '昵称');
            $form->text('key', 'Key')
                ->help('注意key的内容需要使用全小写字母和下划线的组合，不要有数字和空格等特殊符号');
            $form->image('img_url', '图片')->uniqueName()->move('images/sites');

            $form->select('language', '语言')->options([
                'en' => 'English',
                'cn' => '中文'
            ])->default('cn');

            $form->select('type', '类型')->options([
                'bounty' => 'Bounty',
                'official' => 'Official',
                'news' => '新闻',
                'wallet' => 'Wallet',
                'others' => '其他'
            ])->default('others');

            $form->select('status', '状态')->options([
                '1' => '启用',
                '0' => '禁用'
            ])->default('1');

            $form->display('created_at', '创建时间');
            $form->display('updated_at', '更新时间');

            $form->footer(function ($footer) {
                $footer->disableReset();
            });
        });
    }
}
