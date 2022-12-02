import type { AppProps } from 'next/app';
import '../styles/globals.css';

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
            <Component {...pageProps} />
        </ThemeProvider>
    );
}

export default MyApp;
