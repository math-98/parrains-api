<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'parrains');

// Project repository
set('repository', 'git@github.com:math-98/parrains.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', false);

// Shared files/dirs between deploys
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server
add('writable_dirs', []);
set('allow_anonymous_stats', false);

// Hosts
inventory('hosts.yml');

// Tasks
task('yarn:install', 'yarn');
task('yarn:assets', 'yarn run prod');
task('artisan:optimize', function() {}); //Not needed anymore

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Install NPM dependecies after Composer
after('deploy:vendors', 'yarn:install');

// Compile assets after installed NPM
after('yarn:install', 'yarn:assets');

// Migrate database before symlink new release.
before('deploy:symlink', 'artisan:migrate');
