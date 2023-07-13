# Imagen base de Node.js
FROM node:14.17.0-alpine

# Directorio de trabajo dentro del contenedor
WORKDIR /app

# Copiar los archivos del front-end al contenedor
COPY . .

# Instalar dependencias del front-end utilizando Yarn
RUN yarn install

# Compilar los assets del front-end
RUN yarn build

# Exponer el puerto 8080 para el front-end
EXPOSE 8080

# Comando para ejecutar el servidor de desarrollo de Vue.js
CMD ["yarn", "serve"]
