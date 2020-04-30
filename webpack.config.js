const path = require('path');
const ExtractTextPlugin = require('extract-text-webpack-plugin');


module.exports = {
    entry: './resources/js/app.js',
    output: {
        filename: 'js/app.js',
        path: path.resolve(__dirname, 'public/'),
        publicPath: './public/'
    },
    module: {
        rules: [
            {
                test: /\.scss$/,
                use: ExtractTextPlugin.extract({
                    fallback: 'style-loader',
                    use: ['css-loader', 'sass-loader']
                })
            }
        ],

    },
    plugins: [
        new ExtractTextPlugin('css/style.css')
    ]
};


