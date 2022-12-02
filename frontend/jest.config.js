const nextJest = require('next/jest');

const createJestConfig = nextJest({
    dir: './',
});

const customJestConfig = {
    moduleNameMapper: {
        '^@/components/(.*)$': '<rootDir>/src/components/$1',
        '^@/layouts/(.*)$': '<rootDir>/layouts/components/$1',
        '^@/pages/(.*)$': '<rootDir>/src/pages/$1',
    },
    testEnvironment: 'jest-environment-jsdom',
};

module.exports = createJestConfig(customJestConfig);
