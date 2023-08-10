import type { AspidaClient, BasicHeaders } from 'aspida';
import type { Methods as Methods0 } from './auth/_provider@string/callback';
import type { Methods as Methods1 } from './diary';
import type { Methods as Methods2 } from './diary/_date@string';
import type { Methods as Methods3 } from './home';
import type { Methods as Methods4 } from './login/_provider@string';
import type { Methods as Methods5 } from './osirase/all';
import type { Methods as Methods6 } from './osirase/latest';
import type { Methods as Methods7 } from './releaseNote/all';
import type { Methods as Methods8 } from './releaseNote/latest';
import type { Methods as Methods9 } from './statistic';
import type { Methods as Methods10 } from './status';
import type { Methods as Methods11 } from './user/init';

const api = <T>({ baseURL, fetch }: AspidaClient<T>) => {
  const prefix = (baseURL === undefined ? 'https://api.kado.day' : baseURL).replace(/\/$/, '');
  const PATH0 = '/api/v1/auth';
  const PATH1 = '/callback';
  const PATH2 = '/api/v1/diary';
  const PATH3 = '/api/v1/home';
  const PATH4 = '/api/v1/login';
  const PATH5 = '/api/v1/osirase/all';
  const PATH6 = '/api/v1/osirase/latest';
  const PATH7 = '/api/v1/releaseNote/all';
  const PATH8 = '/api/v1/releaseNote/latest';
  const PATH9 = '/api/v1/statistic';
  const PATH10 = '/api/v1/status';
  const PATH11 = '/api/v1/user/init';
  const GET = 'GET';
  const POST = 'POST';
  const DELETE = 'DELETE';
  const PATCH = 'PATCH';

  return {
    auth: {
      _provider: (val1: string) => {
        const prefix1 = `${PATH0}/${val1}`;

        return {
          callback: {
            get: (option?: { config?: T | undefined } | undefined) =>
              fetch<void, BasicHeaders, Methods0['get']['status']>(prefix, `${prefix1}${PATH1}`, GET, option).send(),
            $get: (option?: { config?: T | undefined } | undefined) =>
              fetch<void, BasicHeaders, Methods0['get']['status']>(prefix, `${prefix1}${PATH1}`, GET, option).send().then(r => r.body),
            $path: () => `${prefix}${prefix1}${PATH1}`,
          },
        };
      },
    },
    diary: {
      _date: (val1: string) => {
        const prefix1 = `${PATH2}/${val1}`;

        return {
          /**
           * @returns 成功レスポンス
           */
          get: (option?: { config?: T | undefined } | undefined) =>
            fetch<Methods2['get']['resBody'], BasicHeaders, Methods2['get']['status']>(prefix, prefix1, GET, option).json(),
          /**
           * @returns 成功レスポンス
           */
          $get: (option?: { config?: T | undefined } | undefined) =>
            fetch<Methods2['get']['resBody'], BasicHeaders, Methods2['get']['status']>(prefix, prefix1, GET, option).json().then(r => r.body),
          patch: (option: { body: Methods2['patch']['reqBody'], config?: T | undefined }) =>
            fetch<void, BasicHeaders, Methods2['patch']['status']>(prefix, prefix1, PATCH, option).send(),
          $patch: (option: { body: Methods2['patch']['reqBody'], config?: T | undefined }) =>
            fetch<void, BasicHeaders, Methods2['patch']['status']>(prefix, prefix1, PATCH, option).send().then(r => r.body),
          delete: (option?: { config?: T | undefined } | undefined) =>
            fetch<void, BasicHeaders, Methods2['delete']['status']>(prefix, prefix1, DELETE, option).send(),
          $delete: (option?: { config?: T | undefined } | undefined) =>
            fetch<void, BasicHeaders, Methods2['delete']['status']>(prefix, prefix1, DELETE, option).send().then(r => r.body),
          $path: () => `${prefix}${prefix1}`,
        };
      },
      post: (option: { body: Methods1['post']['reqBody'], config?: T | undefined }) =>
        fetch<void, BasicHeaders, Methods1['post']['status']>(prefix, PATH2, POST, option).send(),
      $post: (option: { body: Methods1['post']['reqBody'], config?: T | undefined }) =>
        fetch<void, BasicHeaders, Methods1['post']['status']>(prefix, PATH2, POST, option).send().then(r => r.body),
      $path: () => `${prefix}${PATH2}`,
    },
    home: {
      /**
       * @returns 成功レスポンス
       */
      get: (option?: { config?: T | undefined } | undefined) =>
        fetch<Methods3['get']['resBody'], BasicHeaders, Methods3['get']['status']>(prefix, PATH3, GET, option).json(),
      /**
       * @returns 成功レスポンス
       */
      $get: (option?: { config?: T | undefined } | undefined) =>
        fetch<Methods3['get']['resBody'], BasicHeaders, Methods3['get']['status']>(prefix, PATH3, GET, option).json().then(r => r.body),
      $path: () => `${prefix}${PATH3}`,
    },
    login: {
      _provider: (val1: string) => {
        const prefix1 = `${PATH4}/${val1}`;

        return {
          /**
           * @returns 成功レスポンス
           */
          get: (option?: { config?: T | undefined } | undefined) =>
            fetch<Methods4['get']['resBody'], BasicHeaders, Methods4['get']['status']>(prefix, prefix1, GET, option).json(),
          /**
           * @returns 成功レスポンス
           */
          $get: (option?: { config?: T | undefined } | undefined) =>
            fetch<Methods4['get']['resBody'], BasicHeaders, Methods4['get']['status']>(prefix, prefix1, GET, option).json().then(r => r.body),
          $path: () => `${prefix}${prefix1}`,
        };
      },
    },
    osirase: {
      all: {
        /**
         * @returns 成功レスポンス
         */
        get: (option?: { config?: T | undefined } | undefined) =>
          fetch<Methods5['get']['resBody'], BasicHeaders, Methods5['get']['status']>(prefix, PATH5, GET, option).json(),
        /**
         * @returns 成功レスポンス
         */
        $get: (option?: { config?: T | undefined } | undefined) =>
          fetch<Methods5['get']['resBody'], BasicHeaders, Methods5['get']['status']>(prefix, PATH5, GET, option).json().then(r => r.body),
        $path: () => `${prefix}${PATH5}`,
      },
      latest: {
        /**
         * @returns 成功レスポンス
         */
        get: (option?: { config?: T | undefined } | undefined) =>
          fetch<Methods6['get']['resBody'], BasicHeaders, Methods6['get']['status']>(prefix, PATH6, GET, option).json(),
        /**
         * @returns 成功レスポンス
         */
        $get: (option?: { config?: T | undefined } | undefined) =>
          fetch<Methods6['get']['resBody'], BasicHeaders, Methods6['get']['status']>(prefix, PATH6, GET, option).json().then(r => r.body),
        $path: () => `${prefix}${PATH6}`,
      },
    },
    releaseNote: {
      all: {
        /**
         * @returns 成功レスポンス
         */
        get: (option?: { config?: T | undefined } | undefined) =>
          fetch<Methods7['get']['resBody'], BasicHeaders, Methods7['get']['status']>(prefix, PATH7, GET, option).json(),
        /**
         * @returns 成功レスポンス
         */
        $get: (option?: { config?: T | undefined } | undefined) =>
          fetch<Methods7['get']['resBody'], BasicHeaders, Methods7['get']['status']>(prefix, PATH7, GET, option).json().then(r => r.body),
        $path: () => `${prefix}${PATH7}`,
      },
      latest: {
        /**
         * @returns 成功レスポンス
         */
        get: (option?: { config?: T | undefined } | undefined) =>
          fetch<Methods8['get']['resBody'], BasicHeaders, Methods8['get']['status']>(prefix, PATH8, GET, option).json(),
        /**
         * @returns 成功レスポンス
         */
        $get: (option?: { config?: T | undefined } | undefined) =>
          fetch<Methods8['get']['resBody'], BasicHeaders, Methods8['get']['status']>(prefix, PATH8, GET, option).json().then(r => r.body),
        $path: () => `${prefix}${PATH8}`,
      },
    },
    statistic: {
      /**
       * @returns 成功レスポンス
       */
      get: (option?: { config?: T | undefined } | undefined) =>
        fetch<Methods9['get']['resBody'], BasicHeaders, Methods9['get']['status']>(prefix, PATH9, GET, option).json(),
      /**
       * @returns 成功レスポンス
       */
      $get: (option?: { config?: T | undefined } | undefined) =>
        fetch<Methods9['get']['resBody'], BasicHeaders, Methods9['get']['status']>(prefix, PATH9, GET, option).json().then(r => r.body),
      $path: () => `${prefix}${PATH9}`,
    },
    status: {
      /**
       * @returns 成功レスポンス
       */
      get: (option?: { config?: T | undefined } | undefined) =>
        fetch<Methods10['get']['resBody'], BasicHeaders, Methods10['get']['status']>(prefix, PATH10, GET, option).json(),
      /**
       * @returns 成功レスポンス
       */
      $get: (option?: { config?: T | undefined } | undefined) =>
        fetch<Methods10['get']['resBody'], BasicHeaders, Methods10['get']['status']>(prefix, PATH10, GET, option).json().then(r => r.body),
      $path: () => `${prefix}${PATH10}`,
    },
    user: {
      init: {
        /**
         * @returns 成功レスポンス
         */
        get: (option?: { config?: T | undefined } | undefined) =>
          fetch<Methods11['get']['resBody'], BasicHeaders, Methods11['get']['status']>(prefix, PATH11, GET, option).json(),
        /**
         * @returns 成功レスポンス
         */
        $get: (option?: { config?: T | undefined } | undefined) =>
          fetch<Methods11['get']['resBody'], BasicHeaders, Methods11['get']['status']>(prefix, PATH11, GET, option).json().then(r => r.body),
        $path: () => `${prefix}${PATH11}`,
      },
    },
  };
};

export type ApiInstance = ReturnType<typeof api>;
export default api;
