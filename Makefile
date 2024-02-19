compose_up:
	docker-compose up -d
compose_build:
	docker-compose up -d --build
compose_down:
	docker-compose down
compose_remove:
	docker-compose down -v
compose_bash:
	docker exec -it php82-container bash