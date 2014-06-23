set :application, "challenge"
set :domain,      "challenge.wevad.com"
set :deploy_to,   "/home/dev/#{application}"
set :app_path,    "app"
set :var_path,    "var"

set :scm,         :git

set :repository,  "git://git@github.com:roverwolf/invoke-challenge.git"
#set :deploy_via,  :capifony_copy_local
set :deploy_via,  :copy
#set :use_composer_tmp, true

set :model_manager, "doctrine"

role :web,        domain                         # Your HTTP server, Apache/etc
role :app,        domain, :primary => true       # This may be the same as your `Web` server

set  :user,           "dev"
set  :use_sudo,       false

set  :keep_releases,  3
after "deploy", "deploy:cleanup"

set :shared_files,      [app_path + "/config/parameters.yml"]
set :shared_children,   [var_path + "/logs"]
set :writable_dirs,     [var_path + "cache", var_path + "/logs"]


set :use_composer, true
set :copy_vendors, true
set :composer_options, "--no-dev --verbose --prefer-source --optimize-autoloader"
ssh_options[:forward_agent] = true
set :branch, "master"
#set :interactive_mode, false
set :dump_assetic_assets, true
set :update_assets_version, true

#set :permission_method, :acl

# Do not remove app_dev.php on deploy
set :clear_controllers, false

# Be more verbose by uncommenting the following line
logger.level = Logger::MAX_LEVEL
