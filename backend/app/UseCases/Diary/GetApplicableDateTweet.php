<?php

declare(strict_types=1);

namespace App\UseCases\Diary;

use DateTime;
use Abraham\TwitterOAuth\TwitterOAuth;

/**
 * 日記の日と同じ日にツイートされたユーザーのツイートを取得
 *
 */
class GetApplicableDateTweet
{
    /**
     * @return array<{time:DateTime,content:string}>
     */
    public function invoke(string $twitterId, DateTime $data): array
    {
        $connection = new TwitterOAuth(env("TWITTER_CONSUMER_KEY"), env("TWITTER_CONSUMER_SECRET"), env("TWITTER_ACCESS_TOKEN"), env("TWITTER_ACCESS_TOKEN_SECRET"));
        $statuses = $connection->get("search/tweets", ["q" => "twitterapi", "since" => $data->format("Y-m-d") . "_00:00:00_JST", "until" => $data->format("Y-m-d") . "_23:59:59_JST"]);
        dd($data->format("Y-m-d") . "_00:00:00_JST", $statuses);
        return [];
    }
}