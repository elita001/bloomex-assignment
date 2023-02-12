FROM php:8.2-fpm

# Arguments defined in docker-compose.yml
ARG user
ARG uid

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

#Installing node 12.x
RUN curl -sL https://deb.nodesource.com/setup_19.x| bash -
RUN apt-get install -y nodejs

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Set working directory
WORKDIR /var/www

USER $user

#FROM node:19.6

# Arguments defined in docker-compose.yml
#ARG user


## Set working directory
#WORKDIR /var/www
#
## avoid million NPM install messages
#ENV npm_config_loglevel warn
## allow installing when the main user is root
##ENV npm_config_unsafe_perm true
#
## Node libraries
#RUN node -p process.versions
#
#COPY package*.json .
#RUN npm install && npm audit fix
#RUN npm install vue@next vue-loader@next
#RUN npm i @vitejs/plugin-vue
#COPY . .
#RUN npm run build