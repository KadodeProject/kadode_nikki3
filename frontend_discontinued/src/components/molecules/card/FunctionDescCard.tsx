import 'material-symbols';
import type { NextPage } from 'next';

type Props = {
    description: string;
    icon: string;
    className?: string;
};

const FunctionDescCard: NextPage<Props> = ({ description, icon, className }) => {
    return (
        <div
            className={
                'mt-4 flex flex-col items-center justify-center p-4 border-2 border-kn-purple rounded-2xl ' +
                className
            }
        >
            <span className="material-symbols-outlined md-100 font-weight-100">{icon}</span>
            <p className="mt-2">{description}</p>
        </div>
    );
};

export default FunctionDescCard;
