FROM composer AS composer

FROM php:cli
COPY --from=composer /usr/bin/composer /usr/bin/composer
WORKDIR /workspaces/Multilingual-Country-List
