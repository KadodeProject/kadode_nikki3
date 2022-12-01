import { Head, Html, Main, NextScript } from 'next/document';

const MyDocument = () => {
    return (
        <Html lang='ja-JP'>
            <Head>
                <meta name='application-name' content='かどで日記' />
                <meta name='description' content='' />
            </Head>
            <body className='bg-white text-black'>
                <Main />
                <NextScript />
            </body>
        </Html>
    );
};

export default MyDocument;
