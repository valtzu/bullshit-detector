# build image
FROM node:12 AS build

RUN apt-get update && apt-get install sudo -y

RUN mkdir -p /home/node/app
WORKDIR /home/node/app
RUN yarn global add @vue/cli
COPY package.json yarn.lock ./
RUN yarn install
COPY . .
ARG BLACKBOX_API_ENDPOINT
ENV VUE_APP_API_ENDPOINT=$BLACKBOX_API_ENDPOINT
RUN yarn run build
ENTRYPOINT ["docker-entrypoint.sh"]

# dev image
FROM build AS dev
CMD yarn run serve

# testing image
FROM dev AS testing
CMD yarn run lint

# production image
FROM nginx:latest AS production
WORKDIR /usr/share/nginx/html
COPY --from=build --chown=nginx /home/node/app/dist .
