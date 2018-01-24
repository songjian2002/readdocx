<?php
/**
 * Created by PhpStorm.
 * User: songjian
 * Date: 2018/1/24
 * Time: 下午2:26
 */

namespace aanro\lib;


class ReadDocx
{

    public function __construct()
    {

    }

    public function read($documenFiletName,$pyExeFile)
    {

        //$documenFiletName = '/Users/songjian/Documents/demo.docx';

        //$pyExeFile = "/Users/songjian/Code/xiaoshuo-plus/chess.py";

        $result = shell_exec("python3.6 $pyExeFile $documenFiletName");
        $article = json_decode($result, true);

        $arr = [];
        $num = -1;

        foreach ($article as $key => $value) {
            if ($key == 'book_name') {
                $arr['book_name'] = $value;
            }
            if (strstr($key, 'section_heading')) {
                $num += 1;
                $arr[$num]['section_heading'] = $value;
                continue;
            }
            if (strstr($key, 'content')) {
                if (isset($arr[$num]['content'])) {
                    $arr[$num]['content'] .= $value;
                } else {
                    $arr[$num]['content'] = $value;
                }
            }
        }
        var_dump($arr);exit;
        return $arr;
    }
}