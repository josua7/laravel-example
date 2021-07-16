<?php

namespace App;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Illuminate\Support\Facades\Validator;

class MyResponse extends Response
{
    public static function execute(Request $request)
    {
        $extraData = ['_task_datas' => [
            'wf_names' => 'wf'
        ]];

        $allData = array_merge($request->all(), $extraData);

        $validator = Validator::make($allData, [
            'results' => 'required|array',
            'ruca' => 'required',
            '_task_data.wf_name' => 'required'
        ]);

        $errors = [];

        if ($validator->fails()) {
            $errors= $validator->errors()->all();
        }

        echo 'ok';
    }
}
