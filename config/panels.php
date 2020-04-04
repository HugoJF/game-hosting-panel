<?php

return [
	/*
	|--------------------------------------------------------------------------
	| Panel configuration
	|--------------------------------------------------------------------------
	|
	| Each panel type is defined by a unique indentifier (the key), together with
	| every settings that is needed for APIs and drivers to work.
	|
	*/

	'ogp' => [
		'name'              => 'Open Game Panel',
		'token'             => env('OGP_API_TOKEN'),
		'database_table'    => env('OGP_DATABASE_TABLE', 'ogpdb'),
		'database_host'     => env('OGP_DATABASE_HOST', 'ogpdb'),
		'database_port'     => env('OGP_DATABASE_PORT', 3306),
		'database_user'     => env('OGP_DATABASE_USER', 'homestead'),
		'database_password' => env('OGP_DATABASE_PASSWORD', 'secret'),

		/*
		|--------------------------------------------------------------------------
		| Panel modules
		|--------------------------------------------------------------------------
		|
		| Panel modules that provide extra funcionality or panel specific funcions.
		|
		*/
		'modules'           => [
			\App\Modules\Ogp_AddonsModule::class,
		],

		/*
		|--------------------------------------------------------------------------
		| Node settings
		|--------------------------------------------------------------------------
		|
		| Settings that each node should have to work correctly, each setting
		| is defined by a unique key followed by form instructions. Settings are
		| passed in the Node creation form.
		|
		*/

		'settings' => [
			'remote_server_id'   => [
				'type' => 'number',
			],
			'ws_screenlogs_host' => [
				'type' => 'text',
			],
		],

		/*
		|--------------------------------------------------------------------------
		| Panel-specific game settings
		|--------------------------------------------------------------------------
		|
		| Here are defined settings that each individual server needs according
		| to the game that is installed.
		|
		*/

		'games' => [

			/*
			 * Wildcard game - rules here are applied globally to the panel servers
			 */
			'*'        => [
				/*
				 * Configurations - settings that are only needed on server creation
				 */
				'configuration' => [
					'home_id'      => [
						'name'    => 'Home ID',
						'visible' => false,
					],
					'ftp_password' => [
						'name' => 'FTP Password',
						'type' => 'text',
					],
				],

				/*
				 * Parameters - settings that are need only on server deployment
				 */
				'parameters'    => [
					//
				],
			],
			'csgo'     => [
				'driver'        => \App\GameDriver\Ogp_CsgoDriver::class,
				'settings'      => [
					'home_cfg_id'     => 52,    // can be found in `ogp_config_homes` in the OGP database
					'mod_cfg_id'      => 60,    // can be found in `ogp_config_mods`  in the OGP database
					'starting_port'   => 28000,
					'slots'           => 32,    // Start with max allowed slots since we can't change the limit easily later
					'affinity'        => 'NA',
					'nice'            => 0,
					'port_increments' => 2,
				],
				'configuration' => [
					'rcon_password' => [
						'name' => 'RCON Password',
						'type' => 'text',
					],
				],
				'parameters'    => [
					'+sv_setsteamaccount' => [
						'type' => 'text',
					],
					'+game_type'          => [
						'type'    => 'select',
						'options' => [
							'choices'     => [
								0 => 0,
								1 => 1,
								4 => 4,
								6 => 6,
							],
							'empty_value' => '=== Select game_type ===',
						],
					],
					'+game_mode'          => [
						'type'    => 'select',
						'options' => [
							'choices'     => [
								0 => 0,
								1 => 1,
								2 => 2,
							],
							'empty_value' => '=== Select game_mode ===',
						],
					],
				],
			],
			'terraria' => [
				'driver'   => \App\GameDriver\Ogp_GenericDriver::class,
				'settings' => [
				],
			],
		],
	],
];
