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
    public function create(Request $request){

        // バリデーション
        $this->validate($request,Osirase::$rules);

        //中身作成
        $form=[
            "title"=>$request->title,
            "genre_id"=>$request->osirase_genre_id,
            "description"=>$request->description,
            "date"=>$request->date,
        ];

        Osirase::create($form);

        //ユーザー通知のフラグをオンにする
        User::where('id','!=','null')->update(["is_showed_service_info"=>1]);

        return redirect('administrator/notification');
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function read(){
        $osirases=Osirase::orderBy('date', 'desc')->get(['title','date','genre_id','description']);
        $osiraseGenres=Osirase_genre::get(['id','name']);
        foreach($osirases as $osirase){
            $osirase->genre=$osiraseGenres[$osirase->genre_id-1]->name;
        }

        return view('diaryNoLogIn/news',['osirases' => $osirases,]);
    }


    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */

    public function update(Request $request){


        // バリデーション
        $this->validate($request,Osirase::$rules);

        $updateContent=[
            "title"=>$request->title,
            "genre_id"=>$request->osirase_genre_id,
            "description"=>$request->description,
            "date"=>$request->date,
        ];

        Osirase::where('id',$request->osirase_id)->update($updateContent);
        return redirect('administrator/notification');
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function delete(Request $request){
        Osirase::where('id',$request->osirase_id)->delete();
        return redirect('administrator/notification');
    }
}