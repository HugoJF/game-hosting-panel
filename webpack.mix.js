const section = process.env.section || 'app';

require(`${__dirname}/webpack.${section}.js`);
