import type { NextPage } from 'next';
import Link from 'next/link';

const Header: NextPage = () => {
    return (
        <header>
            <h1 className="text-center text-xl">
                <Link href="/">かどで日記</Link>
            </h1>
        </header>
    );
};

export default Header;
