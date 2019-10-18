using System;
using System.Threading.Tasks;
using System.Net;
using System.Net.Sockets;
using Xunit;
using Utils;

namespace Tests
{
  public class ServerTests
  {
    private const int PORT = 3333;
    private static volatile int finishedCount = 0;

    [Fact]
    public void Serve()
    {
      Task.WaitAll(StartServer(), Task.Run(CreateClient), Task.Run(CreateClient), Task.Run(CreateClient));
      Assert.True(finishedCount == 3, $"Expected 3 but got {finishedCount}");
    }

    private void CreateClient()
    {
      using (var client = new TcpClient("127.0.0.1", PORT))
      {
        using (var stream = client.GetStream())
        {
          Console.WriteLine("Propably connected");
        }
      }
    }

    private Task StartServer()
    {
      var server = new Server { Port = PORT };

      server.ClientConnected += ClientConnected;

      Console.WriteLine($"Starting server at {server.Port}");
      return server.Run();
    }

    private static void ClientConnected(object sender, Server.ClientConnectedEventArgs e)
    {
      Console.WriteLine("Client connected!");
      e.Client.Close();
      finishedCount++;
    }
  }
}
