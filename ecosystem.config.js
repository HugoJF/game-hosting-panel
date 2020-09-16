module.exports = {
    apps: [{
        name: 'game-hosting-panel',
        interpreter: '/RunCloud/Packages/php74rc/bin/php',
        script: 'artisan',
        args: 'queue:work',

        // Options reference: https://pm2.keymetrics.io/docs/usage/application-declaration/
        autorestart: true,
        watch: false,
        time: true,
    }],
};
