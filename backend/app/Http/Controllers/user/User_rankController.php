<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Releasenote_genre;
use App\Models\Releasenote;
use Illuminate\Http\Request;

class User_rankController extends Controller
{

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function create(Request $request){

        // バリデーション
        $this->validate($request,Releasenote::$rules);

        //中身作成
        $form=[
            "title"=>$request->title,
            "genre_id"=>$request->osirase_genre_id,
            "description"=>$request->description,
            "date"=>$request->date,
        ];

        Releasenote::create($form);
        return redirect('administrator/role_rank');
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function read(){
        $releasenotes=Releasenote::orderBy('date', 'desc')->get(['title','date','genre_id','description']);
        $releasenoteGenres=Releasenote_genre::get(['id','name']);
        foreach($releasenotes as $releasenote){
            $releasenote->genre=$releasenoteGenres[$releasenote->genre_id-1]->name;
        }
        return view('diaryNoLogIn/releaseNote',['releasenotes' => $releasenotes,]);
    }


    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */

    public function update(Request $request){


        // 日付のバリデーション→既に存在する日付ならエラー返す
        // バリデーション
        // $this->validate($request,NlpPackageGenre::$rules);

        $updateContent=[
            "title"=>$request->title,
            "genre_id"=>$request->osirase_genre_id,
            "description"=>$request->description,
            "date"=>$request->date,
        ];

        Releasenote::where('id',$request->osirase_id)->update($updateContent);
        return redirect('administrator/role_rank');
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function delete(Request $request){
        Releasenote::where('id',$request->osirase_id)->delete();
        return redirect('administrator/role_rank');
    }
}