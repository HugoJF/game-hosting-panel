<?php

// Login
Breadcrumbs::for('login', function ($trail) {
    $trail->push('Login', route('login'));
});

// Register
Breadcrumbs::for('register', function ($trail) {
    $trail->push('Register', route('register'));
});

// Register
Breadcrumbs::for('password.request', function ($trail) {
    $trail->push('Password reset', route('register'));
});

// Password set
Breadcrumbs::for('panel-accounts.setup', function ($trail, $user) {
    $trail->push('Register', route('panel-accounts.setup', $user));
});

// Search
Breadcrumbs::for('search', function ($trail) {
    $term = request()->query('term');
    $suffix = $term ? " results for \"$term\"" : '';

    $trail->push("Search$suffix", route('search'));
});

// Dashboard
Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push('Dashboard', route('dashboard'));
});

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

// Notifications
Breadcrumbs::for('users.edit', function ($trail, $user) {
    $trail->push('Edit user', route('users.edit', $user));
});

// Notifications
Breadcrumbs::for('notifications.index', function ($trail) {
    $trail->push('Notifications', route('notifications.index'));
});

// Home > Servers
Breadcrumbs::for('servers.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Servers', route('servers.index'));
});

// Home > Servers > Create
Breadcrumbs::for('servers.create', function ($trail) {
    $trail->parent('servers.index');
    $trail->push('Creating server', route('servers.create'));
});

// TODO: update
// Home > Servers > [Server] > Deploying
Breadcrumbs::for('servers.deploying', function ($trail, $server) {
    $trail->parent('servers.show', $server);
    $trail->push('Deploying server', route('servers.deploying', $server));
});

// Home > Servers > [Server] > Create
Breadcrumbs::for('servers.configure', function ($trail, $server) {
    $trail->parent('servers.show', $server);
    $trail->push('Configuring server', route('servers.configure', $server));
});

// Home > Admin > Locations
Breadcrumbs::for('invites.create', function ($trail) {
    $trail->parent('admins.dashboard');
    $trail->push('Create invite', route('admins.dashboard'));
});

// Home > Admin > Announcements
Breadcrumbs::for('admins.announcements.create', function ($trail) {
    $trail->parent('admins.dashboard');
    $trail->push('Announcements', route('admins.dashboard'));
});

// Home > Admin > Announcements > Edit
Breadcrumbs::for('admins.announcements.edit', function ($trail, $annoucement) {
    $trail->parent('admins.announcements.create');
    $trail->push("Editing annoucement $annoucement->id", route('admins.announcements.edit', $annoucement));
});

// Home > Admin > Locations
Breadcrumbs::for('admins.locations', function ($trail) {
    $trail->parent('admins.dashboard');
    $trail->push('Locations', route('admins.dashboard'));
});

// Home > Admin > Locations > Edit
Breadcrumbs::for('admins.locations.edit', function ($trail, $location) {
    $trail->parent('admins.locations');
    $trail->push('Edit', route('admins.locations.edit', $location));
});

Breadcrumbs::for('locations.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Locations', route('locations.index'));
});

// Home > Locations > Location
Breadcrumbs::for('locations.show', function ($trail, $location) {
    $trail->parent('locations.index');
    $trail->push("Viewing $location->short", route('locations.show', $location));
});

// Home > Transaction
Breadcrumbs::for('transactions.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Transactions', route('transactions.index'));
});

// Home > Orders
Breadcrumbs::for('orders.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Orders', route('orders.index'));
});

// Home > Orders
Breadcrumbs::for('orders.create', function ($trail) {
    $trail->parent('orders.index');
    $trail->push('New order', route('orders.create'));
});

// Home > Coupons
Breadcrumbs::for('coupons.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Coupons', route('coupons.index'));
});

// Home > Settings
Breadcrumbs::for('settings', function ($trail) {
    $trail->parent('home');
    $trail->push('Settings', route('settings'));
});

// Home > Coupons > Viewing coupon
Breadcrumbs::for('coupons.show', function ($trail, $coupon) {
    $trail->parent('coupons.index');
    $trail->push('Viewing coupon', route('coupons.show', $coupon));
});

// Home > Coupons > Viewing coupon
Breadcrumbs::for('coupons.create', function ($trail) {
    $trail->parent('coupons.index');
    $trail->push('Creating coupon', route('coupons.create'));
});

// Home > API Keys
Breadcrumbs::for('api-keys.index', function ($trail) {
    $trail->parent('home');
    $trail->push('API Keys', route('api-keys.index'));
});

// Home > API Keys > Create new API key
Breadcrumbs::for('api-keys.create', function ($trail) {
    $trail->parent('api-keys.index');
    $trail->push('Create new API key', route('api-keys.create'));
});

// Home > API Keys > Editing API key
Breadcrumbs::for('api-keys.edit', function ($trail, $key) {
    $trail->parent('api-keys.index');
    $trail->push('Editing API key', route('api-keys.edit', $key));
});

// Home > Administrative
Breadcrumbs::for('admins.dashboard', function ($trail) {
    $trail->parent('home');
    $trail->push('Admin dashboard', route('admins.dashboard'));
});

// Home > Administrative > Coupons
Breadcrumbs::for('admins.coupons', function ($trail) {
    $trail->parent('admins.dashboard');
    $trail->push('Coupons', route('admins.coupons'));
});

// Home > Administrative > Nodes
Breadcrumbs::for('admins.nodes', function ($trail) {
    $trail->parent('admins.dashboard');
    $trail->push('Nodes', route('admins.dashboard'));
});

// Home > Administrative > Nodes > Edit
Breadcrumbs::for('admins.nodes.edit', function ($trail, $node) {
    $trail->parent('admins.nodes');
    $trail->push('Nodes', route('admins.nodes.edit', $node));
});

// Home > Coupons > [Edit]
Breadcrumbs::for('coupons.edit', function ($trail, $coupon) {
    $trail->parent('coupons.index');
    $trail->push('Editing coupon', route('coupons.edit', $coupon));
});

// Home > Servers > [Server]
Breadcrumbs::for('servers.show', function ($trail, $server) {
    $trail->parent('servers.index');
    $trail->push($server->name, route('servers.show', $server));
});

// Home > Servers > [Server] > Deploys > Index
Breadcrumbs::for('servers.deploys', function ($trail, $server) {
    $trail->parent('servers.show', $server);
    $trail->push('Deploys', route('servers.deploys', $server));
});

// Home > Servers > [Server] > Deploys > Index
Breadcrumbs::for('servers.transactions', function ($trail, $server) {
    $trail->parent('servers.show', $server);
    $trail->push('Transactions', route('servers.transactions', $server));
});

// Home > Servers > [Server] > Deploy
Breadcrumbs::for('deploys.create', function ($trail, $server) {
    $trail->parent('servers.show', $server);
    $trail->push($server->name, route('deploys.create', $server));
});

// Home > Servers > [Server] > Configure
Breadcrumbs::for('deploys.configure', function ($trail, $server) {
    $trail->parent('servers.show', $server);
    $trail->push($server->name, route('deploys.configure', $server));
});

// Home > Deploys > Edit
Breadcrumbs::for('deploys.edit', function ($trail, $deploy) {
    $trail->parent('servers.show', $deploy->server);
    $trail->push('Editing deploy', route('deploys.edit', $deploy));
});

// Admin Dashboard > Games
Breadcrumbs::for('admins.games', function ($trail) {
    $trail->parent('admins.dashboard');
    $trail->push("Games", route('admins.dashboard'));
});

// Admin Dashboard > Games > Edit
Breadcrumbs::for('admins.games.edit', function ($trail, $game) {
    $trail->parent('admins.games', $game);
    $trail->push("Editing $game->name", route('admins.games.edit', $game));
});
