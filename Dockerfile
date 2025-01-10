FROM bitnami/laravel:11

ENV TZ=America/Sao_Paulo

RUN mkdir /var/www && mkdir /var/www/html

WORKDIR /var/www/html

RUN sudo apt-get update

RUN sudo chown -R bitnami:bitnami /var/www/html && \
	cd /var/www/html && rm -Rf laravel
RUN echo '================================'
RUN echo 'Instalando o Laravel via Composer'
RUN echo '================================'
RUN composer global require laravel/installer&& \
	composer create-project --prefer-dist laravel/laravel:'11.*'

RUN echo '========================='
RUN echo 'Configurando o PostgreSQL'
RUN echo '========================='
RUN echo 'extension=pgsql.so' | sudo tee -a /opt/bitnami/php/lib/php.ini && \
	echo 'extension=pdo_pgsql.so' | sudo tee -a /opt/bitnami/php/lib/php.ini

RUN rm -Rf /app && ln -s /var/www/html /app

RUN sudo apt install git -y

WORKDIR /app