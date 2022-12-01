import type { NextPage } from 'next';
import { useTheme } from 'next-themes';
const Home: NextPage = () => {
    const { theme, setTheme } = useTheme();
    return (
        <div>
            <h1 className='text-center text-xl'>かどで日記! with Next.js</h1>
            {/* ↓Hydration failed because the initial UI does not match what was
            rendered on the server. エラーになる。途中で値が変わることが原因 */}
            {/* <p className='bg-kn-blue' suppressHydrationWarning>
                The current theme is:{theme}
            </p> */}
            <button onClick={() => setTheme('light')}>Light Mode</button>
            <button onClick={() => setTheme('dark')}>Dark Mode</button>
        </div>
    );
};

export default Home;
