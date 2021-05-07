const VueLoaderPlugin = require('vue-loader/lib/plugin')

module.exports = {
    entry: {
        vue: './resources/js/front/vue.js',
    },
    output: {
        path: `${__dirname}/public/js`,
        filename: '[name].js',
    },
    watch: true,
    mode: "production",
    devtool: "source-map",
    module: {
        rules: [
             
            {
                test: /\.(png|jpg)$/,
                loader: `file-loader?name=../images/[name].[ext]`,
            },
                
            {
                test: /\.vue$/,
                loader: 'vue-loader'
            },
            {
                test: /\.m?js$/,
                exclude: /(node_modules|bower_components)/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: ['@babel/preset-env']
                    }
                }
            },
            {
                test: /\.scss$/,
                use: [
                    
                    'vue-style-loader',
                    'css-loader',
                    'sass-loader',
                 
                ]
            },
            {
                test: /\.css$/,
                use: [
                    'vue-style-loader',
                    'css-loader',
                ]
            },
            {
                resolve: {
                    alias: {
                        'vue$': 'vue/dist/vue.esm.js'
                    },
                    extensions: ['*', '.js', '.vue', '.json']
                },
            }
        ]
    },
    plugins: [
        new VueLoaderPlugin()
    ]
}
