# Create image based on the official openjdk 8-jre-alpine image from the dockerhub
FROM openjdk:8-jre-alpine

# Install wkhtmltopdf
RUN apk add --no-cache wkhtmltopdf

ENTRYPOINT ["wkhtmltopdf"]