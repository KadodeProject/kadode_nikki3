/* eslint-disable */
import type * as Types from '../../../../@types'

export type Methods = {
  get: {
    status: 200
    /** 成功レスポンス */
    resBody: Types.Diary
  }

  patch: {
    status: 200

    reqBody: {
      id: number
      date: string
      title: string | null
      content: string
    }
  }

  delete: {
    status: 200
  }
}
