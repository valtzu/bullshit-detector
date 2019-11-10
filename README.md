#### Configuration:
When running docker-compose, you need to set `BULLSHIT_ENDPOINT` environment variable. This is a runtime variable and
does not require rebuild of any image whenever changing its value.
To avoid inputting bullshit endpoint every time running docker-compose, create file named .env with the
following content:

`BULLSHIT_ENDPOINT=<url_to_the_bullshit_endpoint>`


#### Run tests:

`ENV=testing docker-compose up`

#### Run in development mode (hot-reloading for frontend etc):

`ENV=dev docker-compose up`

Frontend will be available at http://localhost:3000/

#### Run in production mode:

`docker-compose up`


#### Deployment
When running in other than localhost environment,
you need to set `BLACKBOX_PUBLIC_ENDPOINT` env variable on command line or in
.env file in the project root. This environment variable will be used at build stage so you need to rebuild image
`web` whenever you change this value.
In production, you should never use docker-compose.override.yml, instead you need to always explicitly define the yml
file, e.g. `docker-compose -f docker-compose.yml up`. Also, you probably want to set up a frontend proxy to apply SSL &
to get rid of port numbers in urls.
