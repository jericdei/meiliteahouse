start:
    docker compose up -d
stop:
    docker compose down
restart: stop && start
rebuild:
    docker compose up -d --build --force-recreate --remove-orphans
destroy:
    docker compose down -v
logs CONTAINER:
    docker compose logs {{CONTAINER}}
sh:
    docker compose exec php bash
php *COMMAND:
    docker compose exec -u 1000 web php {{COMMAND}}
artisan *COMMAND:
    docker compose exec -u 1000 web php artisan {{COMMAND}}
composer *COMMAND:
    docker compose exec -u 1000 web composer {{COMMAND}}
mysql *COMMAND:
    docker compose exec database mysql -uuser -ppassword {{COMMAND}}
node *COMMAND:
    docker compose exec -u 1000 web node {{COMMAND}}
npm *COMMAND:
    docker compose exec -u 1000 web npm {{COMMAND}}
yarn *COMMAND:
    docker compose exec -u 1000 web yarn {{COMMAND}}
dev:
    docker compose exec -u 1000 web npm run dev
build:
    docker compose exec -u 1000 web npm run build
pint:
    docker compose exec -u 1000 web ./vendor/bin/pint
open:
    open "http://meiliteahouse.localhost"
