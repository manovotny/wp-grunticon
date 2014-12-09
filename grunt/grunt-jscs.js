module.exports = function (grunt) {

    'use strict';

    var config = require('config');

    grunt.config('jscs', {
        js: {
            options: {
                excludeFiles: [
                    config.paths.source + '/**/' + config.files.browserify + '.*.js'
                ],
                preset: 'crockford',
                requireCamelCaseOrUpperCaseIdentifiers: 'ignoreProperties'
            },
            src: [
                '*.js',
                'config/*.js',
                'grunt/*.js',

                config.paths.source + '/**/*.js'
            ]
        }
    });

};
