import type { NextPage } from 'next';
import Image from 'next/image';
import Link from 'next/link';

const Header: NextPage = () => {
    return (
        <header className="sticky top-0 z-50">
            <Link href="/" className="flex justify-center">
                <Image
                    src="/img/logo/kadode_logo_without_bg_with_string.svg"
                    alt="かどで日記ロゴ"
                    className="p-4"
                    width={384}
                    height={96}
                />
            </Link>
        </header>
    );
};

export default Header;
