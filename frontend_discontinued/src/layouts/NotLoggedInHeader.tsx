import type { NextPage } from 'next';
import { useTheme } from 'next-themes';
import Image from 'next/image';
import Link from 'next/link';

const Header: NextPage = () => {
    const { theme, setTheme } = useTheme();
    return (
        <header className="sticky top-0 z-50 flex justify-center">
            <Link href="/" className="flex justify-center">
                <Image
                    src="/img/logo/kadode_logo_without_bg_with_string.svg"
                    alt="かどで日記ロゴ"
                    className="p-4"
                    width={384}
                    height={96}
                />
            </Link>
            <div>
                {theme === 'light' ? (
                    <button onClick={() => setTheme('dark')}>🌕</button>
                ) : (
                    <button onClick={() => setTheme('light')}>☀</button>
                )}
            </div>
        </header>
    );
};

export default Header;
