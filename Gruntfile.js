module.exports = function (grunt) {

    'use strict';

    require('time-grunt')(grunt);

    require('load-grunt-config')(grunt, {
        loadGruntTasks: {
            pattern: [
                'grunt-*',
                'unpathify'
            ]
        }
    });

    grunt.loadTasks('grunt');

};
