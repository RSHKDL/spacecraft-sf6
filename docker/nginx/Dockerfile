FROM alpine:3.15

LABEL maintainer="Julien Helfer <jhelfer@clever-age.com>" \
      version="1.0.0" \
      description="This image start the nginx container"

# Latest alpine already has a www-data group created by default
RUN adduser -S -G www-data www-data

RUN apk add --update nginx
RUN rm -rf /var/cache/apk/* && rm -rf /tmp/*

ADD nginx.conf /etc/nginx/
ADD symfony.conf /etc/nginx/conf.d/default.conf
RUN echo "upstream php-upstream { server php:9000; }" > /etc/nginx/conf.d/upstream.conf

EXPOSE 80

# Run nginx at the start of the container
CMD ["nginx"]