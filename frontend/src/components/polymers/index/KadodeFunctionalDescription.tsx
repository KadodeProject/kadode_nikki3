import DescribeH3 from '@/components/atoms/heading/DescribeH3';
import FunctionDescCard from '@/components/molecules/card/FunctionDescCard';
import type { NextPage } from 'next';
const KadodeFunctionalDescription: NextPage = () => {
    return (
        <>
            <DescribeH3
                heading="読みやすさ"
                sub="かどで日記は読みやすくするための工夫に取り組んでいます"
                icon="search"
            />
            <div className="flex justify-center flex-wrap gap-4">
                <FunctionDescCard
                    className="basis-full md:basis-1/4"
                    description="1年前の同日など古い日記も思い出せます"
                    icon="folder_open"
                />
                <FunctionDescCard
                    className="basis-full md:basis-1/4"
                    description="直近の日記や月ごとの日記など一覧で表示できます"
                    icon="folder_open"
                />
                <FunctionDescCard
                    className="basis-full md:basis-1/4"
                    description="フォントが選べます"
                    icon="text_fields"
                />
                <FunctionDescCard
                    className="basis-full md:basis-1/4"
                    description="ダークモードもライトモードも選べます"
                    icon="dark_mode"
                />
                <FunctionDescCard
                    className="basis-full md:basis-1/4"
                    description="文字の自動ハイライトで見やすさを向上させます"
                    icon="auto_fix"
                />
                <FunctionDescCard
                    className="basis-full md:basis-1/4"
                    description="文字だけのシンプルな日記です"
                    icon="edit"
                />
            </div>
        </>
    );
};

export default KadodeFunctionalDescription;
