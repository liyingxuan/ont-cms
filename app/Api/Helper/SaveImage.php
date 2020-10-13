<?php
/**
 * Created by PhpStorm.
 * User: lyx
 * Date: 2018/12/26
 * Time: 10:59
 */

namespace App\Api\Helper;

use Intervention\Image\Facades\Image;

class SaveImage
{
    // 只允许以下后缀名的图片文件上传
    protected $allowed_ext = ["png", "jpg", 'jpeg'];

    /**
     * @param $file
     * @param $folder
     * @param $file_prefix
     * @param bool $max_width
     * @return array|bool
     */
    public function save($file, $folder, $file_prefix, $max_width = false)
    {
        // 获取文件的后缀名，因图片从剪贴板里黏贴时后缀名为空，所以此处确保后缀一直存在
        $extension = strtolower($file->getClientOriginalExtension()) ?: 'png';

        // 如果上传的不是图片将终止操作
        if (!in_array($extension, $this->allowed_ext)) {
            return $extension;
        }

        // 构建存储的文件夹规则，值如：uploads/images/avatars/201804/12/
        // 文件夹切割能让查找效率更高。
        $folder_name = "uploads/images/$folder/" . date("Ym/d", time());

        // 文件具体存储的物理路径，`public_path()` 获取的是 `public` 文件夹的物理路径。
        // 值如：/home/vagrant/Code/larabbs/public/uploads/images/avatars/201709/21/
        $upload_path = public_path() . '/' . $folder_name;

        // 拼接文件名，加前缀是为了增加辨析度，前缀可以是相关数据模型的 ID
        // 值如：1_1493521050_X7mXJ2n3p2.png
        $filename = $file_prefix . '_' . time() . '_' . str_random(10) . '.' . $extension;

        $file->move($upload_path, $filename);

        // 如果限制图片宽度，就进行裁剪
        if ($max_width) {
            Image::make($upload_path . '/' . $filename)->save();
        } else {
            Image::make($upload_path . '/' . $filename)->resize($max_width, $max_width)->save();
        }

        return [
            'url' => "/$folder_name/$filename"
        ];
    }
}