<?php

namespace Deployer;
use function Deployer\{host, task, run, set, get, add, before, after, upload, writeln};
use Exception;

require 'vendor/deployer/deployer/recipe/symfony4.php';

set('shared_dirs', ['src/var/log', 'src/var/sessions']);
set('shared_files', ['src/.env']);
set('writable_dirs', ['src/var']);
set('bin/composer', 'composer');

set('bin/console', function () {
    return parse('{{bin/php}} {{release_path}}/src/bin/console --no-interaction');
});

set('repository', 'https://github.com/nofutur3/project_rsp.git');

//set('release_path', 'src/');
host('rsp')
    ->stage('production')
    ->roles('app')
    ->set('deploy_path', '/srv/web');

task('deploy:vendors', function () {
    if (!commandExist('unzip')) {
        writeln('<comment>To speed up composer installation setup "unzip" command with PHP zip extension https://goo.gl/sxzFcD</comment>');
    }
    run('cd {{release_path}}/src && {{bin/composer}} {{composer_options}}');
});

task('deploy:writable', function () {

});

task('deploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:vendors',
    'deploy:writable',
    'database:migrate',
    'deploy:cache:clear',
    'deploy:cache:warmup',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
    'reload:php-fpm',
]);

task('reload:php-fpm', function() {
   run('sudo systemctl reload php7.2-fpm');
});
