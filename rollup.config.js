import serve from 'rollup-plugin-serve';
import livereload from 'rollup-plugin-livereload';
import { terser } from 'rollup-plugin-terser';

const { PRODUCTION } = process.env;

const plugins = () => {
  return [
    PRODUCTION && terser(),
    !PRODUCTION && serve({ contentBase: 'docs' }),
    !PRODUCTION && livereload(),
  ];
};

export default [
  {
    input: 'sources/script.js',
    output: {
      file: 'docs/wakelock.min.js',
    },
    plugins: plugins(),
  }
];