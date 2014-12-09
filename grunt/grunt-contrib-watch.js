module.exports = function (grunt) {

    'use strict';

    var config = require('config');

    grunt.config('watch', {
        css: {
            files: [
                config.paths.source + '/**/*.scss'
            ],
            tasks: [
                'css'
            ]
        },
        js: {
            files: [
                config.paths.source + '/**/*.js',
                '!' + config.paths.source + '/**/' + config.files.browserify + '.*.js'
            ],
            tasks: [
                'js'
            ]
        }
    });

};
