const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = {
    entry: {
      'app': ['./resources/js/app.js'], 
      'app': ['./resources/sass/app.scss'],
      'admin/app': ['./resources/js/admin/app.js'],
      'admin/app': ['./resources/sass/admin/app.scss']
    },
    output: {
        path: __dirname,
        filename: 'public/js/[name].js'
    },
    module: {
        rules: [
            {
                test: /\.s[ac]ss$/i,
                use: [
                  // Compiles Sass to CSS
                  
                    {
                      loader: MiniCssExtractPlugin.loader,
                      options: {
                        publicPath(resourcePath, context) {
                          return path.relative(path.dirname(resourcePath), context) + '/../';
                        }
                      }
                    },
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