import NotLoggedInHead from '@/components/polymers/seo/NotLoggedInHead';
import Footer from '@/layouts/Footer';
import Header from '@/layouts/GuestHeader';
import type { NextPage } from 'next';
import type { ReactNode } from 'react';
type Props = {
    children: ReactNode;
    title?: string;
    description?: string;
};

const Layout: NextPage<Props> = ({ children, title, description }) => {
    return (
        <>
            <NotLoggedInHead title={title} description={description} />
            <Header />
            <main>{children}</main>
            <Footer />
        </>
    );
};
export default Layout;
