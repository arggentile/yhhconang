.PHONY: init-dev

DOCKER_COMPOSE ?= docker-compose
MAKE ?= make
JOB_NAME ?= ll

up:
	$(DOCKER_COMPOSE) up -d

down:
	$(DOCKER_COMPOSE) down

bash:
	${DOCKER_COMPOSE} exec apache bash

init-dev:
	#
	# Running composer installation in development environment
	# This may take a while on your first install...
	#
	$(MAKE) composer-install
	# $(DOCKER_COMPOSE) exec postgres psql -U mpmig -d horas_extras -a -f /docker-entrypoint-initdb.d/init.sql
	$(DOCKER_COMPOSE)  exec apache php yii migrate --interactive=0
	$(DOCKER_COMPOSE)  exec apache chgrp -R www-data *
	$(DOCKER_COMPOSE)  exec apache chmod 777 views/ -R
	$(DOCKER_COMPOSE)  exec apache chmod 777 modules/ -R
	$(DOCKER_COMPOSE)  exec apache chmod 777 web/assets
	$(DOCKER_COMPOSE)  exec apache chmod 777 runtime/ -R

# no utilizado
migrate: #lanza las migraciones
	$(DOCKER_COMPOSE) exec apache php yii migrate --interactive=0
#	$(DOCKER_COMPOSE) exec apache php yii migrate --migrationPath=@yii/rbac/migrations --interactive=0

composer-install:
	$(DOCKER_COMPOSE) run --rm apache composer install

usurios-alta:
	$(DOCKER_COMPOSE) exec apache php yii user/create agentile@jusrionegro.gov.ar agentile 123456 administador
	$(DOCKER_COMPOSE) exec apache php yii user/create gchico@jusrionegro.gov.ar gchivo 123456 administador
	$(DOCKER_COMPOSE) exec apache php yii user/create dmartinezdiaz@jusrionegro.gov.ar dmartinezdiaz 123456 administador
	$(DOCKER_COMPOSE) exec apache php yii user/create mboisselier@jusrionegro.gov.ar mboisselier 123456 administador
	$(DOCKER_COMPOSE) exec apache php yii user/create shernandorena@jusrionegro.gov.ar shernandorena 123456 administador

sincronizar-tablas-shara:
	$(MAKE) sincronizar-empleados
	$(MAKE) sincronizar-organismos
	$(MAKE) sincronizar-edificios
	$(MAKE) sincronizar-localidades

sincronizar-empleados:
	${DOCKER_COMPOSE} exec apache php yii sincronizacion-empleados/sincronizar

sincronizar-organismos:
	${DOCKER_COMPOSE} exec apache php yii sincronizacion-organismos/sincronizar

sincronizar-edificios:
	${DOCKER_COMPOSE} exec apache php yii sincronizacion-edificios/sincronizar

sincronizar-localidades:
	${DOCKER_COMPOSE} exec apache php yii sincronizacion-localidades/sincronizar

fload:	 ##@development load fixtures
	#
	# Cargando fixtures
	#
	$(DOCKER_COMPOSE) run --rm  apache yii fixture/load '*' --interactive=0

funload: ##@development unload fixtures
	#
	# Descargando fixtures
	#
	$(DOCKER_COMPOSE) run --rm  apache yii fixture/unload '*' --interactive=0
