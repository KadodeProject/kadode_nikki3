import DescribeH2 from '@/components/atoms/heading/DescribeH2';
import KadodeConcept from '@/components/polymers/index/KadodeConcept';
import KadodeFunctionalDescription from '@/components/polymers/index/KadodeFunctionalDescription';
import KadodeIntro from '@/components/polymers/index/KadodeIntro';
import KadodePoint from '@/components/polymers/index/KadodePoint';
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
            <KadodeIntro />
            <DescribeH2 heading="かどで日記のポイント" sub="軸をぶらしません" />
            <KadodePoint />
            <DescribeH2
                heading="かどで日記の特徴"
                sub="気分に身を任せて書いても、振り返しやすさを維持します"
            />
            <KadodeFunctionalDescription />
            <DescribeH2 heading="かどで日記のコンセプト" />
            <KadodeConcept />
        </Layout>
    );
};

export default IndexPage;
