import Head from 'next/head';
import Link from 'next/link';
import { ReactNode } from 'react';

type Props = {
    children?: ReactNode;
};

const BaseLayout = ({ children }: Props) => {
    return (
        <>
            <Head>
                <title>Layout</title>
            </Head>

            <header className=''>
                <Link href='/'>Home</Link>
            </header>

            <div className=''>{children}</div>
            <footer className=''></footer>
        </>
    );
};

export default BaseLayout;
