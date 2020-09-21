# Game Hosting Panel
![Tests](https://github.com/HugoJF/game-hosting-panel/workflows/Laravel/badge.svg)
[![codecov](https://codecov.io/gh/HugoJF/game-hosting-panel/branch/master/graph/badge.svg)](https://codecov.io/gh/HugoJF/game-hosting-panel)

Pterodactyl powered game server reselling platform.

## Overview

 - 🚀 **Pterodactyl based**: supports any Nest installed on any Pterodactyl panel);
 
 - ⏳  **Dynamic billing periods**: the user pays only when a server is online, per minute, hour, day, week or month;
 
 - ☑️ **Transparent pricing**: server costs are calculated based on resource allocation;
 
 - 💲 **Balance system**: avoid sending invoices for each server deploy, everything is pre-paid;
 
 - 🚅 **Fast and simple**: deploy and start multiple servers in seconds;
 
 - 🉑 **Supports 2 languages**: english and brazilian portuguese translations already implemented;
 
 - 📝 **Battle tested**: critical parts of code are fully unit-tested and months of live environment use;
 
 - 🤔 **Lots more**: multi-node by design, announcements, discount coupons, configurable server resources, and lots or planned features...
 
## Screenshots

#### Main user dashboard 

<p align="center">
  <img src="https://i.imgur.com/yWo0l9J.png">
</p>

#### Server creation view 

<p align="center">
  <img src="https://i.imgur.com/xfpGo4C.png">
</p>

#### Server view

<p align="center">
  <img src="https://i.imgur.com/ds5Q9hF.png">
</p>

## Requirements
  - PHP 7.4+
  - MySQL/MariaDB
  - Pterodactyl 0.7

## Installation
  - Deploy this Laravel app;
  - If you don't have [CS:GO Pipeline](https://github.com/HugoJF/csgo-pipeline), deploy it;
  - Add a list in your CS:GO Pipeline installation with the key `sessions` (set maximum size to at least 5k items);
  - Setup a cronjob for the scheduler;
  - Add your server address into the `servers` table.
  
## .env file

 - **`RELEASED`** - if `true` users are allowed to register;
 - **`BROADCAST_DRIVER`** - set to `pusher` if you want auto-refresh on server install (and also configure Pusher credentials .env variables);
 - **`QUEUE_CONNECTION`** - always set to `database` or something similar, lots of monitoring jobs are dispatched while creating servers;
 - **`PAYMENT_SYSTEM_URL`** - URL for `payment-system` endpoint (this project is not public);
 - **`PTERODACTYL_URL`** - base URL for Pterodactyl panel (don't end with /). This is used for user redirections when using clicking the `Go to panel` button;
 - **`PTERODACTYL_API_ENDPOINT`** - endpoint used for API communication;
 - **`PTERODACTYL_API_KEY`** - Pterodactyl **application** API key;
 - **`PTERODACTYL_CLIENT_KEY`** - Pterodactyl **user** API key (create one using an admin account, we need this to controle server power and a few other essential things);
 - **`SENTRY_LARAVEL_DSN`** - always a good idea to have Sentry setup;
 
 
 
 
