<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\User_role;
use Illuminate\Http\Request;

class User_roleController extends Controller
{

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function create(Request $request)
    {

        // バリデーション
        $this->validate($request, User_role::$rules);

        //中身作成
        $form = [
            "name" => $request->name,
            "description" => $request->description,
        ];

        User_role::create($form);
        return redirect('administrator/role_rank');
    }


    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */

    public function update(Request $request)
    {

        // バリデーション
        $this->validate($request, User_role::$rules);

        $updateContent = [
            "name" => $request->name,
            "description" => $request->description,
        ];

        User_role::where('id', $request->user_role_id)->update($updateContent);
        return redirect('administrator/role_rank');
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function delete(Request $request)
    {
        User_role::where('id', $request->user_role_id)->delete();
        return redirect('administrator/role_rank');
    }
}