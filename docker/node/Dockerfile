FROM node:17-alpine

LABEL maintainer="Julien Helfer <jhelfer@clever-age.com>" \
      version="1.0.0" \
      description="This image start the node container"

# Install some packages we need using Alpine Linux package management
RUN apk add --update \
    make \
    curl

WORKDIR /var/www/symfony

EXPOSE 3000

# A container needs a foreground process to stay alive
CMD ["tail", "-f", "/dev/null"]