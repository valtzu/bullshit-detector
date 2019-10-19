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
RUN dotnet publish -c Release -o Release && dotnet publish -c Debug -o Debug


# test application -- see: dotnet-docker-unit-testing.md
FROM build AS testing
WORKDIR /app/tests
COPY tests/. .
ENTRYPOINT ["dotnet", "test", "--logger:trx"]


# debug application
FROM mcr.microsoft.com/dotnet/core/runtime:3.0 AS dev
WORKDIR /app
COPY --from=build /app/src/Debug ./
ENTRYPOINT ["dotnet", "app.dll"]


FROM mcr.microsoft.com/dotnet/core/runtime:3.0 AS production
WORKDIR /app
COPY --from=build /app/src/Release ./
ENTRYPOINT ["dotnet", "app.dll"]
