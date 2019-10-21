const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = {
    entry: {
      'app': ['./resources/js/app.js', './resources/sass/app.scss'],
      'admin/app': ['./resources/js/admin/app.js', './resources/sass/admin/app.scss']
      
    },
    output: {
        path: path.resolve(__dirname, ''),
        filename: './public/js/[name].js'
    },
    module: {
        rules: [
            {
                test: /\.(?:s[ac]ss)$/i,
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
            path: path.resolve(__dirname),
            filename: './public/css/[name].css'
          }),
    ]
  };