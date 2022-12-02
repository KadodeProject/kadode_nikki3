import Index from '@/pages/index';
import { render } from '@testing-library/react';

describe('Home', () => {
  it('renders a heading', () => {
    const { getByText } = render(<Index />);

    expect(getByText('かどで日記')).toBeTruthy();
  });
});
