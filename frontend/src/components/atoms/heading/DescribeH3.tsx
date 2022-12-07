import 'material-symbols';
import type { NextPage } from 'next';

type Props = {
    heading: string;
    sub: string;
    icon: string;
};

const DescribeH3: NextPage<Props> = ({ heading, sub, icon }) => {
    return (
        <div className="mt-4 flex flex-col items-center justify-center">
            <div className="flex items-center justify-center">
                <span className="material-symbols-outlined">{icon}</span>
                <h3 className="pb-2 text-2xl md:text-3xl ">{heading}</h3>
            </div>
            <p className="mt-2 text-sm ">{sub}</p>
        </div>
    );
};

export default DescribeH3;
