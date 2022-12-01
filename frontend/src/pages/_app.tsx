import BaseLayout from 'layout/BaseLayout';
import { ThemeProvider } from 'next-themes';
import type { AppProps } from 'next/app';
import '../styles/globals.css';

function MyApp({ Component, pageProps }: AppProps) {
    return (
        <ThemeProvider attribute='class' defaultTheme='dark'>
            <BaseLayout>
                <Component {...pageProps} />
            </BaseLayout>
        </ThemeProvider>
    );
}

export default MyApp;
