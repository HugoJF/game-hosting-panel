module.exports = {
    apps: [{
        name: 'game-hosting-panel-staging',
        interpreter: 'php',
        script: 'artisan',
        args: 'queue:work',

        // Options reference: https://pm2.keymetrics.io/docs/usage/application-declaration/
        watch: false,
        time: true,
    }],
};
