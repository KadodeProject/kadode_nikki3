import type { AspidaClient, BasicHeaders } from 'aspida';
import type { Methods as Methods0 } from './v1/auth/_provider@string/callback';
import type { Methods as Methods1 } from './v1/diary';
import type { Methods as Methods2 } from './v1/diary/_date@string';
import type { Methods as Methods3 } from './v1/home';
import type { Methods as Methods4 } from './v1/login/_provider@string';
import type { Methods as Methods5 } from './v1/osirase/all';
import type { Methods as Methods6 } from './v1/osirase/latest';
import type { Methods as Methods7 } from './v1/releaseNote/all';
import type { Methods as Methods8 } from './v1/releaseNote/latest';
import type { Methods as Methods9 } from './v1/status';
import type { Methods as Methods10 } from './v1/user/init';

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
  const PATH9 = '/api/v1/status';
  const PATH10 = '/api/v1/user/init';
  const GET = 'GET';
  const POST = 'POST';
  const DELETE = 'DELETE';
  const PATCH = 'PATCH';

  return {
    v1: {
      auth: {
        _provider: (val2: string) => {
          const prefix2 = `${PATH0}/${val2}`;

          return {
            callback: {
              get: (option?: { config?: T | undefined } | undefined) =>
                fetch<void, BasicHeaders, Methods0['get']['status']>(prefix, `${prefix2}${PATH1}`, GET, option).send(),
              $get: (option?: { config?: T | undefined } | undefined) =>
                fetch<void, BasicHeaders, Methods0['get']['status']>(prefix, `${prefix2}${PATH1}`, GET, option).send().then(r => r.body),
              $path: () => `${prefix}${prefix2}${PATH1}`,
            },
          };
        },
      },
      diary: {
        _date: (val2: string) => {
          const prefix2 = `${PATH2}/${val2}`;

          return {
            /**
             * @returns 成功レスポンス
             */
            get: (option?: { config?: T | undefined } | undefined) =>
              fetch<Methods2['get']['resBody'], BasicHeaders, Methods2['get']['status']>(prefix, prefix2, GET, option).json(),
            /**
             * @returns 成功レスポンス
             */
            $get: (option?: { config?: T | undefined } | undefined) =>
              fetch<Methods2['get']['resBody'], BasicHeaders, Methods2['get']['status']>(prefix, prefix2, GET, option).json().then(r => r.body),
            patch: (option: { body: Methods2['patch']['reqBody'], config?: T | undefined }) =>
              fetch<void, BasicHeaders, Methods2['patch']['status']>(prefix, prefix2, PATCH, option).send(),
            $patch: (option: { body: Methods2['patch']['reqBody'], config?: T | undefined }) =>
              fetch<void, BasicHeaders, Methods2['patch']['status']>(prefix, prefix2, PATCH, option).send().then(r => r.body),
            delete: (option?: { config?: T | undefined } | undefined) =>
              fetch<void, BasicHeaders, Methods2['delete']['status']>(prefix, prefix2, DELETE, option).send(),
            $delete: (option?: { config?: T | undefined } | undefined) =>
              fetch<void, BasicHeaders, Methods2['delete']['status']>(prefix, prefix2, DELETE, option).send().then(r => r.body),
            $path: () => `${prefix}${prefix2}`,
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
        _provider: (val2: string) => {
          const prefix2 = `${PATH4}/${val2}`;

          return {
            /**
             * @returns 成功レスポンス
             */
            get: (option?: { config?: T | undefined } | undefined) =>
              fetch<Methods4['get']['resBody'], BasicHeaders, Methods4['get']['status']>(prefix, prefix2, GET, option).json(),
            /**
             * @returns 成功レスポンス
             */
            $get: (option?: { config?: T | undefined } | undefined) =>
              fetch<Methods4['get']['resBody'], BasicHeaders, Methods4['get']['status']>(prefix, prefix2, GET, option).json().then(r => r.body),
            $path: () => `${prefix}${prefix2}`,
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
      status: {
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
      user: {
        init: {
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
      },
    },
  };
};

export type ApiInstance = ReturnType<typeof api>;
export default api;
