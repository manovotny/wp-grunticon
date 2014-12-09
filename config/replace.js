module.exports = (function () {

    'use strict';

    return {
        author: {
            email: 'author@email.com',
            name: 'AUTHOR_NAME',
            url: 'http://author-url.com',
            username: 'AUTHOR_USERNAME'
        },
        project: {
            composer: {
                name: 'PROJECT_COMPOSER_NAME',
                type: 'PROJECT_COMPOSER_TYPE'
            },
            description: 'PROJECT_DESCRIPTION',
            git: 'PROJECT_GIT',
            name: 'PROJECT_NAME',
            slug: 'PROJECT_SLUG',
            url: 'http://project-url.com',
            version: '0.0.0'
        },
        translations: {
            domain: 'TRANSLATIONS_DOMAIN',
            path: 'TRANSLATIONS_PATH'
        }
    };

}());
