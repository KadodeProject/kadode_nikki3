/* eslint-disable */
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
