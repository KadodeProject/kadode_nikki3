import type { AspidaClient, BasicHeaders } from 'aspida';
import type { Methods as Methods0 } from './_provider@string/callback';

const api = <T>({ baseURL, fetch }: AspidaClient<T>) => {
  const prefix = (baseURL === undefined ? 'https://api.kado.day' : baseURL).replace(/\/$/, '');
  const PATH0 = '/api/v1/auth';
  const PATH1 = '/callback';
  const GET = 'GET';

  return {
    _provider: (val0: string) => {
      const prefix0 = `${PATH0}/${val0}`;

      return {
        callback: {
          get: (option?: { config?: T | undefined } | undefined) =>
            fetch<void, BasicHeaders, Methods0['get']['status']>(prefix, `${prefix0}${PATH1}`, GET, option).send(),
          $get: (option?: { config?: T | undefined } | undefined) =>
            fetch<void, BasicHeaders, Methods0['get']['status']>(prefix, `${prefix0}${PATH1}`, GET, option).send().then(r => r.body),
          $path: () => `${prefix}${prefix0}${PATH1}`,
        },
      };
    },
  };
};

export type ApiInstance = ReturnType<typeof api>;
export default api;
