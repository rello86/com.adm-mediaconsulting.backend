# INSTALLATION

<pre>
composer update
--- copy .env file ----
--- run docker ----
./vendor/bin/sail up
./vendor/bin/sail php artisan migrate
</pre>

# ENV
<pre>
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:YrQ7ETvIQhLNRyfEyAKtuGO++pgPpEAbVb2l7y9MyjI=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=sail
DB_PASSWORD=password

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DRIVER=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=memcached

REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=null
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
</pre>


# COMMAND
<pre>
./vendor/bin/sail php artisan rello86:pp
</pre>


# TEST
<pre>
./vendor/bin/sail php artisan test --env=local
</pre>

# API
<pre>
GET /api/peoples/{perPage}/{orderBy}/{search}
</pre>
- perPage: integer (10)
- orderBy: string (name)
- search: string ('')

<pre>
GET /api/people/{peopleId}
</pre>
- peopleId: integer
