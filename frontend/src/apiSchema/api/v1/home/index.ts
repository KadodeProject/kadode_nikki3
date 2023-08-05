/* eslint-disable */
import type * as Types from '../../../@types';

export type Methods = {
	get: {
		status: 200;

		/** 成功レスポンス */
		resBody: {
			unreadNotifications: {
				url: string;
				actionUrl: string;
				bg_color: string;
				title: string;
				date: string;
			}[];
			oldDiaries: Types.Diary[];
			zeroDayAgoDiary: Types.Diary;
			oneDayAgoDiary: Types.Diary;
			twoDayAgoDiary: Types.Diary;
			threeDayAgoDiary: Types.Diary;
			latestDiaries: Types.Diary[];
		};
	};
};
