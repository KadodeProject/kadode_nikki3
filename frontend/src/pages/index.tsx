import DescribeH2 from '@/components/atoms/heading/DescribeH2';
import KadodeFunctionalDescription from '@/components/polymers/index/KadodeFunctionalDescription';
import Layout from '@/layouts/NotLoggedInLayout';
import type { NextPage } from 'next';
import Image from 'next/image';

const IndexPage: NextPage = () => {
    return (
        <Layout>
            <div className="flex justify-center">
                <Image
                    alt="かどでロゴ"
                    width={300}
                    height={300}
                    className="animate-pulse"
                    src="/img/logo/kadode_logo_without_bg.svg"
                />
            </div>
            <h1 className="text-center text-xl">かどで日記</h1>
            <h1 className="text-center text-xl">with Next.js</h1>
            <DescribeH2 heading="かどで日記のポイント" sub="軸をぶらしません" />
            <KadodeFunctionalDescription />
        </Layout>
    );
};

export default IndexPage;
