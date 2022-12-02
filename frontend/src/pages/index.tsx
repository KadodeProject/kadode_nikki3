import Layout from '@/layouts/NotLoggedInLayout';
import type { NextPage } from 'next';
import { useTheme } from 'next-themes';

const IndexPage: NextPage = () => {
    const { theme, setTheme } = useTheme();
    return (
        <Layout>
            <h1 className="text-center text-xl">かどで日記</h1>
            <h1 className="text-center text-xl">with Next.js</h1>
            {/* ↓Hydration failed because the initial UI does not match what was
            rendered on the server. エラーになる。途中で値が変わることが原因 */}
            {/* <p className='bg-kn-blue' suppressHydrationWarning>
                The current theme is:{theme}
            </p> */}
            <button onClick={() => setTheme('light')}>Light Mode</button>
            <button onClick={() => setTheme('dark')}>Dark Mode</button>
        </Layout>
    );
};

export default IndexPage;
