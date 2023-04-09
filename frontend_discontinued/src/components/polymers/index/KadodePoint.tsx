import type { NextPage } from 'next';

import DescribeH4 from '@/components/atoms/heading/DescribeH4';
const KadodePoint: NextPage = () => {
    return (
        <div className="flex justify-center">
            <div className="flex flex-col items-start">
                <DescribeH4 heading="とにかく素早く書けるように軽量でシンプルです" icon="speed" />
                <DescribeH4
                    heading="日記に集中できるようにします。感情を選ぶ必要もなく、ただ書くだけです"
                    icon="loyalty"
                />
                <DescribeH4
                    heading="本サービスに依存させません。いつでもエクスポートできます。"
                    icon="redeem"
                />
                <DescribeH4
                    heading="公開機能は存在しません。間違っても書いた日記がそのまま他者には見られません。"
                    icon="password"
                />
            </div>
        </div>
    );
};

export default KadodePoint;
