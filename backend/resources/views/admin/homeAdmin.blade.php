@extends("layouts.main")
@section("title","管理者ページ")

@section('header')
@parent
@endsection
@section('content')
<div class=" my-8" id="">

    <div class="statistic-content">
        @include('components.statisticHeading',['icon'=>'category','title'=>'リンク集'])

        <p class="text-center my-12 mx-4 text-3xl"><a href="{{route('ShowAdminPackage')}}">パッケージ</a></p>
        <p class="text-center my-12 mx-4 text-3xl"><a href="{{route('ShowAdminNotification')}}">通知管理</a></p>
        <p class="text-center my-12 mx-4 text-3xl"><a href="{{route('ShowAdminRoleRank')}}">ロールとランク</a></p>
        <p class="text-center my-12 mx-4 text-3xl"><a href="{{route('ShowAdminPhpInfo')}}">phpinfo()を見る</a></p>
    </div>
    <div class="statistic-content">
        {{-- 表示 --}}
        <div class="overflow-x-auto">
            <table class="nlp-normal-table mx-auto" border="1">
                <tr>
                    <th>id</th>
                    <th>日記数</th>
                    <th>統計数(月別)</th>
                    <th>日記平均文字数</th>
                    <th>アカウント作成日</th>
                    <th>アカウント更新日</th>
                    <th>メール認証日</th>
                    <th>最新の日記日</th>
                    <th>最古の日記日</th>
                    <th>user_rank_id</th>
                    <th>user_role_id</th>
                    <th>appearance_id</th>
                    <th>ユーザーランクの通知既読</th>
                    <th>アップデート通知の既読</th>
                    <th>お知らせの既読</th>
                </tr>

                @include('components.statisticHeading',['icon'=>'category','title'=>'ユーザー情報'])

                {{-- 登録済みデータ表示 --}}
                @isset($users)

                @foreach($users as $user)
                <tr>
                    <td>
                        {{$user['id']}}
                    </td>
                    <td>
                        {{$user['diary_count']}}
                    </td>
                    <td>
                        {{$user['statistics_per_month_count']}}
                    </td>
                    <td>
                        {{$user['diary_average']}}
                    </td>
                    <td>
                        {{$user['created_at']}}
                    </td>
                    <td>
                        {{$user['updated_at']}}
                    </td>
                    <td>
                        {{$user['email_verified_at']}}
                    </td>
                    <td>
                        {{$user['latest_diary']}}
                    </td>
                    <td>
                        {{$user['oldest_diary']}}
                    </td>
                    <td>
                        {{$user['user_rank_id']}}
                    </td>
                    <td>
                        {{$user['user_role_id']}}
                    </td>
                    <td>
                        {{$user['appearance_id']}}
                    </td>
                    <td>
                        {{$user['is_showed_update_user_rank']}}
                    </td>
                    <td>
                        {{$user['is_showed_update_system_info']}}
                    </td>
                    <td>
                        {{$user['is_showed_service_info']}}
                    </td>


                </tr>
                @endforeach
                @endisset
            </table>
        </div>

    </div>
    <div class="statistic-content">
        @include('components.statisticHeading',['icon'=>'category','title'=>'php情報'])

        <?php //phpinfo(); ?>
    </div>
</div>

@endsection
