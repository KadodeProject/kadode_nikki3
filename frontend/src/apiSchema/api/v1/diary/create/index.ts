/* eslint-disable */
import type * as Types from '../../../../@types';

export type Methods = {
	post: {
		status: 200;

		/** 成功レスポンス */
		resBody: {
			result: string;
		};

		reqBody: Types.DiaryRequestBody;
	};
};
