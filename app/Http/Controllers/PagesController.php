<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function PHPSTORM_META\type;

class PagesController extends Controller
{
    public function root()
    {

        return view('pages.root');
    }

    public function test()
    {
        $file = fopen(base_path().'/readme.md', 'r+');
        $text = 'This is appended content';
        fwrite($file, $text);
        $file = fread($file, filesize(base_path().'/readme.md'));
        dd($file);
        fclose($file);
    }

    public function permissionDenied()
    {
        // 如果当前用户有权限访问后台，直接跳转访问
        if (config('administrator.permission')()) {
            return redirect(url(config('administrator.uri')), 302);
        }

        // 否则使用视图
        return view('pages.permission_denied');
    }
}
