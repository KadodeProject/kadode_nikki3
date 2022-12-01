import { Html, Head, Main, NextScript } from 'next/document';

const MyDocument = () => {
    return (
        <Html lang='ja-JP'>
            <Head>
                <meta name='application-name' content='かどで日記' />
                <meta name='description' content='' />
            </Head>
            <body>
                <Main />
                <NextScript />
            </body>
        </Html>
    );
};

export default MyDocument;
