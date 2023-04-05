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
            <DescribeH3
                heading="自然言語処理"
                sub="かどで日記は自然言語処理を用いた、過去の振り返りやすさ向上をお助けします"
                icon="potted_plant"
            />
            <div className="flex justify-center flex-wrap gap-4">
                <FunctionDescCard
                    className="basis-full md:basis-1/4"
                    description="一覧でさっと確認できます"
                    icon="travel_explore"
                />
                <FunctionDescCard
                    className="basis-full md:basis-1/4"
                    description="整えて書かなくても後で読み返しやすくします"
                    icon="local_laundry_service"
                />
                <FunctionDescCard
                    className="basis-full md:basis-1/4"
                    description="気持ちに身を任せて書いても受け止めます"
                    icon="volunteer_activism"
                />
            </div>
            <DescribeH3
                heading="データ"
                sub="個人開発サービスの不安をできる限り減らします"
                icon="database"
            />
            <div className="flex justify-center flex-wrap gap-4">
                <FunctionDescCard
                    className="basis-full md:basis-1/4"
                    description="豊富な形式で日記エクスポートができます"
                    icon="download"
                />
                <FunctionDescCard
                    className="basis-full md:basis-1/4"
                    description="各種日記サービスからの日記のインポートができます"
                    icon="upload"
                />
                <FunctionDescCard
                    className="basis-full md:basis-1/4"
                    description="データはクラウド上に保持されるためPCからもスマートフォンからも。"
                    icon="cloud"
                />
            </div>
            <DescribeH3 heading="ほかにも" sub="快適な日記をサポートします" icon="key" />
            <div className="flex justify-center flex-wrap gap-4">
                <FunctionDescCard
                    className="basis-full md:basis-1/4"
                    description="通常の認証に加えてパスコードも追加できます"
                    icon="lock"
                />
                <FunctionDescCard
                    className="basis-full md:basis-1/4"
                    description="固有表現の登録で珍しい名前や会社名も認識できます"
                    icon="collections_bookmark"
                />
                <FunctionDescCard
                    className="basis-full md:basis-1/4"
                    description="過去の日記も検索で見つけられます"
                    icon="manage_search"
                />
            </div>
        </>
    );
};

export default KadodeFunctionalDescription;
