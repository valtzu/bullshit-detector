using System;
using System.Text;
using System.IO;
using Utils;
using static System.Console;

public static class Program
{
  public static void Main(string[] args)
  {
    var server = new Server { Port = 50000 };

    server.ClientConnected += ClientConnected;

    server.Start();
    server.Wait();
  }

  private static void ClientConnected(object sender, Server.ClientConnectedEventArgs e)
  {
    Console.WriteLine("Client connected");
    using (var stream = e.Client.GetStream())
    {
      using (var reader = new StreamReader(stream, Encoding.UTF8))
      {
        while (!reader.EndOfStream)
        {
          var received = reader.ReadLine();
          Console.WriteLine(received);
        }
      }
    }
    e.Client.Close();
    Console.WriteLine("Client disconnected");
  }
}
