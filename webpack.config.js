const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = {
    entry: ['./resources/js/app.js', './resources/sass/app.scss'],
    output: {
        path: __dirname,
        filename: './public/js/app.js'
    },
    module: {
        rules: [
            {
                test: /\.s[ac]ss$/i,
                use: [
                  // Compiles Sass to CSS
                  
                    MiniCssExtractPlugin.loader,
                    'css-loader',
                    'sass-loader'
                ],
              },
        ],
    },
    mode: 'development',
    plugins: [
        new MiniCssExtractPlugin({
            // Options similar to the same options in webpackOptions.output
            // both options are optional
            filename: './public/css/[name].css'
          }),
    ]
  };