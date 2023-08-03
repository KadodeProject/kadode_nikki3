/* eslint-disable */
export type GetAllOsiraseResponse = {
	osirase?:
		| {
				id?: string | undefined;
				title?: string | undefined;
				/** 改行含む文字列が入ってくるがエスケープなどはされていない */
				content?: string | undefined;
				created_at?: string | undefined;
				updated_at?: string | undefined;
		  }[]
		| undefined;
};
