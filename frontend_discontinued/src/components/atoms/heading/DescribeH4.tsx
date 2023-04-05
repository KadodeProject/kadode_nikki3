import 'material-symbols';
import type { NextPage } from 'next';

type Props = {
    heading: string;
    icon: string;
};

const DescribeH4: NextPage<Props> = ({ heading, icon }) => {
    return (
        <div className="my-2 flex flex-col items-center justify-center">
            <div className="flex items-center justify-center">
                <span className="material-symbols-outlined">{icon}</span>
                <h4 className="ml-2 pb-2 text-xl ">{heading}</h4>
            </div>
        </div>
    );
};

export default DescribeH4;
