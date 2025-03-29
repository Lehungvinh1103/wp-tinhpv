const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');

// Define entry points
const entry = {
  admin: './src/admin/index.js',
  public: './src/public/index.js',
  vendor: './src/shared/vendor.js'
};

module.exports = {
  entry,
  output: {
    path: path.resolve(__dirname, 'build'),
    filename: '[name].js',
    publicPath: '/wp-content/plugins/wordpress-react-core/build/'
  },
  // Generate source maps for better debugging
  devtool: process.env.NODE_ENV === 'production' ? false : 'source-map',
  // Optimization settings
  optimization: {
    splitChunks: {
      cacheGroups: {
        commons: {
          test: /[\\/]node_modules[\\/]/,
          name: 'vendors',
          chunks: 'all'
        }
      }
    }
  },
  // Module rules for different file types
  module: {
    rules: [
      // JavaScript and JSX
      {
        test: /\.(js|jsx)$/,
        exclude: /node_modules/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: ['@babel/preset-env', '@babel/preset-react'],
            plugins: [
              '@babel/plugin-proposal-class-properties',
              '@babel/plugin-transform-runtime'
            ]
          }
        }
      },
      // CSS and SCSS
      {
        test: /\.(css|scss)$/,
        use: [
          MiniCssExtractPlugin.loader,
          'css-loader',
          'postcss-loader',
          'sass-loader'
        ]
      },
      // Images
      {
        test: /\.(png|jpg|gif|svg)$/,
        use: [
          {
            loader: 'file-loader',
            options: {
              name: 'images/[name].[ext]'
            }
          }
        ]
      },
      // Fonts
      {
        test: /\.(woff|woff2|eot|ttf|otf)$/,
        use: [
          {
            loader: 'file-loader',
            options: {
              name: 'fonts/[name].[ext]'
            }
          }
        ]
      }
    ]
  },
  // Resolve file extensions
  resolve: {
    extensions: ['.js', '.jsx', '.json'],
    alias: {
      '@admin': path.resolve(__dirname, 'src/admin'),
      '@public': path.resolve(__dirname, 'src/public'),
      '@shared': path.resolve(__dirname, 'src/shared')
    }
  },
  // Plugins
  plugins: [
    new CleanWebpackPlugin(),
    new MiniCssExtractPlugin({
      filename: '[name].css'
    })
  ],
  // External libraries that will be provided by WordPress
  externals: {
    react: 'React',
    'react-dom': 'ReactDOM',
    axios: 'axios',
    antd: 'antd'
  }
};