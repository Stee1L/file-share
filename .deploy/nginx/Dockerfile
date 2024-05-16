FROM nginx:1.23-alpine

COPY ./.deploy/nginx/conf.d/default.conf /etc/nginx/conf.d/default.conf
COPY ./src /project

CMD ["nginx", "-g", "daemon off;"]