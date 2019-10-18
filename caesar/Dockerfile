# Source: https://github.com/dotnet/dotnet-docker/blob/master/samples/dotnetapp/Dockerfile
FROM mcr.microsoft.com/dotnet/core/sdk:3.0 AS build
WORKDIR /app

# copy csproj and restore as distinct layers
COPY src/*.csproj ./src/
COPY utils/*.csproj ./utils/
WORKDIR /app/src
RUN dotnet restore

# copy and publish app and libraries
WORKDIR /app/
COPY src/. ./src/
COPY utils/. ./utils/
WORKDIR /app/src
RUN dotnet publish -c Release -o out


# test application -- see: dotnet-docker-unit-testing.md
FROM build AS test
WORKDIR /app/tests
COPY tests/. .
ENTRYPOINT ["dotnet", "test", "--logger:trx"]


FROM mcr.microsoft.com/dotnet/core/runtime:3.0 AS runtime
WORKDIR /app
COPY --from=build /app/src/out ./
ENTRYPOINT ["dotnet", "app.dll"]
