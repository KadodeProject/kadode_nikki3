import type { NextPage } from 'next';
type Props = {
    title?: string;
    description?: string;
};

const Header: NextPage<Props> = ({ title, description }) => {
    return (
        <header>
            <h1 className="text-center text-xl">かどで日記</h1>
        </header>
    );
};

export default Header;
