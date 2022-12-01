import BaseLayout from 'layout/BaseLayout';
import type { AppProps } from 'next/app';
import '../styles/globals.css';

function MyApp({ Component, pageProps }: AppProps) {
    return (
        <BaseLayout>
            <Component {...pageProps} />
        </BaseLayout>
    );
}

export default MyApp;
