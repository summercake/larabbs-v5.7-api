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
        $file = readfile(base_path().'readme.md');
        $data = [
            'type' => type($file),
            'data' => $file,
        ];
        dd($data);
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
