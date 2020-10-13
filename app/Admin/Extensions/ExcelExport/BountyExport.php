<?php
/**
 * Created by PhpStorm.
 * User: lyx
 * Date: 2018/11/29
 * Time: 23:13
 */
namespace App\Admin\Extensions\ExcelExport;

use Encore\Admin\Grid\Exporters\AbstractExporter;
use Maatwebsite\Excel\Facades\Excel;

class BountyExport extends AbstractExporter
{
    public function export()
    {
        // Table Config
        $fileName = 'Bounty-' . date('Ymd-H');
        $sheetName = 'Bounty';
        $colsName = [['项目名称', '摘要', '内容', '奖金', '负责人', '状态', '创建时间']];
        $rowsItem = ['name', 'summary', 'content', 'bonus', 'leader', 'status', 'created_at'];

        Excel::create($fileName, function($excel) use($sheetName, $colsName, $rowsItem) {

            $excel->sheet($sheetName, function($sheet) use($colsName, $rowsItem) {

                $rows = collect($this->getData())->map(function ($item) use($rowsItem) {
                    return array_only($item, $rowsItem);
                });

                $sheet->rows($colsName);
                $sheet->rows($rows);

            });

        })->export('xlsx');
    }
}
