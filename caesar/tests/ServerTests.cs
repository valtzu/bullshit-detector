using System;
using System.Threading.Tasks;
using System.Net;
using System.IO;
using System.Net.Sockets;
using Xunit;
using Utils;

namespace Tests
{
  public class ServerTests
  {
    private const int PORT = 3333;

    [Fact]
    public void Serve()
    {
      var server = new Server { Port = PORT };
      bool[] clientSucceeded = new bool[3];

      server.ClientConnected += (sender, e) => {
        Console.WriteLine("Client connected!");

        using (var stream = e.Client.GetStream())
        {
          using (var reader = new StreamReader(stream))
          {
            var clientId = int.Parse(reader.ReadLine());
            clientSucceeded[clientId] = true;
          }
        }
        e.Client.Close();
      };

      server.Start();

      Task.WaitAll(
        Task.Run(() => this.CreateClient(0)),
        Task.Run(() => this.CreateClient(1)),
        Task.Run(() => this.CreateClient(2))
      );

      server.Stop();
      server.Wait();

      Assert.True(clientSucceeded[0], $"Client 0 should have succeeded");
      Assert.True(clientSucceeded[1], $"Client 1 should have succeeded");
      Assert.True(clientSucceeded[2], $"Client 2 should have succeeded");
    }

    private void CreateClient(int id)
    {
      using (var client = new TcpClient("127.0.0.1", PORT))
      {
        using (var stream = client.GetStream())
        {
          using (var writer = new StreamWriter(stream))
          {
            writer.WriteLine(id.ToString());
          }
        }
      }
    }
  }
}
