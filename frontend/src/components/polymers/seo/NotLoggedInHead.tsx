import type { NextPage } from 'next';
import Head from 'next/head';
type Props = {
    title?: string;
    description?: string;
};

const NotLoggedInHead: NextPage<Props> = ({ title, description }) => {
    const formedTitle = title ? `${title} | かどで日記` : 'かどで日記';
    const formedDescription = description ?? 'かどで日記は振り返りを楽しむ日記管理サービスです';
    return (
        <Head>
            <meta httpEquiv="content-language" content="ja" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <meta httpEquiv="X-UA-Compatible" content="ie=edge" />

            <meta name="description" content={formedDescription} />
            <title>{formedTitle}</title>
            {/* ogp */}
            <meta property="og:title" content={formedTitle} />
            <meta property="og:description" content={formedDescription} />
            <meta property="og:type" content="website" />
            <meta property="og:url" content="https://diary.kado.day/" />
            <meta property="og:image" content="https://diary.kado.day/img/ogp.png" />
            {/* <meta property="fb:app_id"      content="" /> */}
            <meta name="twitter:card" content="summary" />
            <meta name="twitter:site" content="@usuyuki26" />
            <meta name="twitter:creator" content="@usuyuki26" />

            <link
                rel="apple-touch-icon"
                type="image/png"
                href="/img/favicon/apple-touch-icon-180x180.png"
            />
            <link rel="icon" type="image/png" href="/img/favicon/icon-192x192.png" />
        </Head>
    );
};

export default NotLoggedInHead;
