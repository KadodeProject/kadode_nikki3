import type { NextPage } from 'next';
const KadodeIntro: NextPage = () => {
    return (
        <div className="mb-4 mt-4">
            <h2 className="text-center text-3xl my-4 kiwi-maru">かどで日記</h2>
            <div className="flex justify-center md:w-1/2 px-4 mx-auto flex-col kiwi-maru">
                <p className="text-center mt-2">
                    かどで日記では日記の作成・管理だけでなく、
                    <br className="md:hidden" />
                    日記の分析もできます。
                </p>
                <p className="text-center mb-2">振り返りも楽しめる日記Webアプリです。</p>
                <p className="text-center my-2">
                    おかげさまで2022年6月14日をもって、
                    <br className="md:hidden" />
                    リリース1周年を迎えました🎉
                </p>
            </div>
        </div>
    );
};

export default KadodeIntro;
