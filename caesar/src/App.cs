using System;
using System.Text;
using System.IO;
using Utils;
using static System.Console;

public class App
{
  private Caesar caesar;
  private Server server;

  public App(int port)
  {
    this.caesar = new Caesar {
      Alphabet = "abcdefghijklmnopqrstuvwxyzåäö",
      Shift = 0
    };

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

    using (var stream = e.Client.GetStream())
    using (var reader = new StreamReader(stream, Encoding.UTF8))
    using (var writer = new StreamWriter(stream, Encoding.UTF8)) {
      while (!reader.EndOfStream) {
        var received = reader.ReadLine();

        for (this.caesar.Shift = 0; this.caesar.Shift < this.caesar.Alphabet.Length; this.caesar.Shift++)
          writer.WriteLine(this.caesar.Decipher(received));

        writer.Flush();
      }
    }

    e.Client.Close();

    Console.WriteLine("Client disconnected");
  }
}