using System;
using System.Text;
using System.IO;
using Utils;
using static System.Console;

public class App
{
  private Server server;

  public App(int port)
  {
    this.server = new Server { Port = port };
    this.server.ClientConnected += this.ClientConnected;
  }

  public void Run()
  {
    server.Start();
    server.Wait();
  }

  private void ClientConnected(object sender, Server.ClientConnectedEventArgs e)
  {
    Console.WriteLine("Client connected");
    var caesar = new Caesar {
      Alphabet = "abcdefghijklmnopqrstuvwxyzåäö",
      Shift = 0
    };

    using (var stream = e.Client.GetStream())
    using (var reader = new StreamReader(stream, Encoding.UTF8))
    using (var writer = new StreamWriter(stream, Encoding.UTF8)) {
      while (!reader.EndOfStream) {
        var received = reader.ReadLine();

        for (caesar.Shift = 0; caesar.Shift < caesar.Alphabet.Length; caesar.Shift++)
          writer.WriteLine(caesar.Decipher(received));

        writer.WriteLine();
        writer.Flush();
      }
    }

    e.Client.Close();

    Console.WriteLine("Client disconnected");
  }
}