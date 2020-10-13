<?php
/**
 * Created by PhpStorm.
 * User: lyx
 * Date: 2018/11/29
 * Time: 22:54
 */
namespace App\Admin\Extensions\ExcelExport;

use Encore\Admin\Grid\Exporters\AbstractExporter;
use Maatwebsite\Excel\Facades\Excel;

class BountyClaimExport extends AbstractExporter
{
    public function export()
    {
        // Table Config
        $fileName = 'BountyClaim-' . date('Ymd-H');
        $sheetName = 'Bounty Claim';
        $colsName = [[
            '项目ID', '申请人', '申请人邮箱', '团队介绍', '计划详情',
            'Github地址', '所需天数', '状态', '进度', '项目地址',
            '申请时间'
        ]];
        $rowsItem = [
            'bounty_id',
            'name',
            'email',
            'team',
            'plan',

            'github_url',
            'completion_time',
            'status',
            'schedule',
            'project_url',

            'created_at'
        ];

        Excel::create($fileName, function ($excel) use ($sheetName, $colsName, $rowsItem) {

            $excel->sheet($sheetName, function ($sheet) use ($colsName, $rowsItem) {

                $rows = collect($this->getData())->map(function ($item) use ($rowsItem) {
                    return array_only($item, $rowsItem);
                });

                $sheet->rows($colsName);
                $sheet->rows($rows);

            });

        })->export('xlsx');
    }
}
