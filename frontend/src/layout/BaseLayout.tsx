import Head from 'next/head';
import Link from 'next/link';
import { ReactNode } from 'react';

type Props = {
    children?: ReactNode;
};

const BaseLayout = ({ children }: Props) => {
    return (
        <div>
            <Head>
                <title>Layout</title>
            </Head>

            <header className=''>
                <Link href='/'>Home</Link>
            </header>

            <div className='content'>{children}</div>
            <footer className=''></footer>
        </div>
    );
};

export default BaseLayout;
