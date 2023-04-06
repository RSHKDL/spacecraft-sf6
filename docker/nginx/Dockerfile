FROM alpine:3.15

LABEL maintainer="Julien Helfer <jhelfer@clever-age.com>" \
      version="1.0.0" \
      description="This image start the nginx container"

# Latest alpine already has a www-data group created by default
RUN adduser -S -G www-data www-data

# install nginx
RUN apk add --update nginx
RUN rm -rf /var/cache/apk/* && rm -rf /tmp/*

# install openssl
RUN apk add --update openssl && \
    rm -rf /var/cache/apk/*

# create folder for certificates
RUN mkdir -p /etc/nginx/certificates

# create the certificates
RUN openssl req -x509 -nodes -days 365 -subj "/C=FR/ST=Bordeaux/O=Spaceships, Inc./CN=example.com" \
    -newkey rsa:2048 -keyout /etc/nginx/certificates/key.pem -out /etc/nginx/certificates/cert.pem

ADD nginx.conf /etc/nginx/
ADD symfony.conf /etc/nginx/conf.d/default.conf
RUN echo "upstream php-upstream { server php:9000; }" > /etc/nginx/conf.d/upstream.conf

EXPOSE 80
EXPOSE 443

# Run nginx at the start of the container
CMD ["nginx"]