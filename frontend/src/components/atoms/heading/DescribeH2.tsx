import type { NextPage } from 'next';

type Props = {
    heading: string;
    sub?: string;
};

const DescribeH2: NextPage<Props> = ({ heading, sub }) => {
    return (
        <div className="flex justify-center items-center flex-col mt-4">
            <h2 className="text-3xl md:text-4xl border-b-2 border-kn-purple pb-2 inline-block drop-shadow">
                {heading}
            </h2>
            {sub === null ? '' : <h3 className="mt-2 text-sm ">{sub}</h3>}
        </div>
    );
};

export default DescribeH2;
