<?php

namespace App\Http\Controllers\notifications;

use App\Http\Controllers\Controller;
use App\Models\Osirase_genre;
use App\Models\Osirase;
use App\Models\User;
use Illuminate\Http\Request;

class OsiraseController extends Controller
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
        $this->validate($request, Osirase::$rules);

        //中身作成
        $form = [
            "title" => $request->title,
            "genre_id" => $request->osirase_genre_id,
            "description" => $request->description,
            "date" => $request->date,
        ];

        Osirase::create($form);

        //ユーザー通知のフラグをオンにする
        User::where('id', '!=', 0)->update(["is_showed_service_info" => 0]);

        return redirect('administrator/notification');
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
        $this->validate($request, Osirase::$rules);

        $updateContent = [
            "title" => $request->title,
            "genre_id" => $request->osirase_genre_id,
            "description" => $request->description,
            "date" => $request->date,
        ];

        Osirase::where('id', $request->osirase_id)->update($updateContent);
        return redirect('administrator/notification');
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function delete(Request $request)
    {
        Osirase::where('id', $request->osirase_id)->delete();
        return redirect('administrator/notification');
    }
}
