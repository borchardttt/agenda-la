## Para iniciar o sistema, tenha o docker instalado

`sudo snap install docker`

## Instale o php na sua máquina

`sudo add-apt-repository ppa:ondrej/php
sudo apt update`

`sudo apt install php8.3 php8.3-cli php8.3-fpm php8.3-mysql php8.3-xml php8.3-mbstring php8.3-curl php8.3-zip php8.3-bcmath
`

## Instale MySQL

`sudo apt install mysql-server`

## Clone a aplicação e rode

`composer install`

`sudo docker-compose up -d`

## Acesse a aplicação via:

`http://localhost:8080`

## Banco de dados

`http://localhost:8081`

## Portainer (gerenciar os containers)

`http://localhost:9000`
