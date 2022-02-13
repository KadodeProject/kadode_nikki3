<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\User_rank;
use Illuminate\Http\Request;

class User_rankController extends Controller
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
        $this->validate($request, User_rank::$rules);

        //中身作成
        $form = [
            "name" => $request->name,
            "description" => $request->description,
        ];

        User_rank::create($form);
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
        $this->validate($request, User_rank::$rules);

        $updateContent = [
            "name" => $request->name,
            "description" => $request->description,
        ];

        User_rank::where('id', $request->user_rank_id)->update($updateContent);
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
        User_rank::where('id', $request->user_rank_id)->delete();
        return redirect('administrator/role_rank');
    }
}