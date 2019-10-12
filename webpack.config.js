const path = require('path');


module.exports = {
    entry: './resources/js/app.js',
    output: {
        path: __dirname,
        filename: './public/js/app.js'
    },
    rules: [
        {
            test: /\.s[ac]ss$/i,
            use: [
              // Creates `style` nodes from JS strings
              'style-loader',
              // Translates CSS into CommonJS
              'css-loader',
              // Compiles Sass to CSS
              'sass-loader',
            ],
          },
    ],
    mode: 'development'
  };