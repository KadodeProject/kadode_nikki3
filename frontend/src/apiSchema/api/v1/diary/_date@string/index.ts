/* eslint-disable */
import type * as Types from '../../../../@types'

export type Methods = {
  get: {
    status: 200

    /** 成功レスポンス */
    resBody: {
      result: string
    }
  }

  patch: {
    status: 200
    reqBody: Types.DiaryRequestBody
  }

  delete: {
    status: 200
  }
}
