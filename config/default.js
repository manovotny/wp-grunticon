module.exports = (function () {

    'use strict';

    return {
        author: {
            email: 'manovotny@gmail.com',
            name: 'Michael Novotny',
            url: 'http://manovotny.com',
            username: 'manovotny'
        },
        files: {
            browserify: 'bundle'
        },
        paths: {
            curl: 'curl_downloads',
            source: 'src',
            translations: 'lang'
        },
        project: {
            composer: {
                name: 'manovotny/wp-grunticon-loader',
                type: 'library' // Should be `library` or `project`.
            },
            description: 'Enables the use of Grunticon within WordPress.',
            git: 'git://github.com/manovotny/wp-grunticon-loader.git',
            name: 'WP Grunticon Loader',
            slug: 'wp-grunticon-loader',
            type: 'plugin', // Should be `plugin` or `theme`.
            url: 'https://github.com/manovotny/wp-grunticon-loader',
            version: '0.0.0'
        }
    };

}());
