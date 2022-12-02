import type { AppProps } from 'next/app';
import '../styles/globals.css';

//フォント読み込み 13.0.6時点では日本語フォントが非対応であったため断念、動作はするのでコメントアウトしておく
/** @todo @next/fontが日本語対応したらコメントアウト外す */
// import { Kiwi_Maru, Zen_Kurenaido } from '@next/font/google';

// const KiwiMaruRegular = Kiwi_Maru({
//     weight: '400',
//     subsets: ['japanese'],
//     variable: '--font-kiwi-maru',
// });
// const ZenKurenaidoRegular = Zen_Kurenaido({
//     weight: '400',
//     subsets: ['japanese'],
//     variable: '--font-zen-kurenaido',
// });

// ダークモード対応
import { ThemeProvider } from 'next-themes';

// 読み込み動作対応
import Router from 'next/router';
import NProgress from 'nprogress';
import 'nprogress/nprogress.css';
Router.events.on('routeChangeStart', () => NProgress.start());
Router.events.on('routeChangeComplete', () => NProgress.done());
Router.events.on('routeChangeError', () => NProgress.done());

function MyApp({ Component, pageProps }: AppProps) {
  return (
    <ThemeProvider attribute="class" defaultTheme="dark">
      {/* <div className={`${KiwiMaruRegular.variable} ${ZenKurenaidoRegular.variable}`}> */}
      <Component {...pageProps} />
      {/* </div> */}
    </ThemeProvider>
  );
}

export default MyApp;
